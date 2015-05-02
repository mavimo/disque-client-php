<?php
/**
 * This file is part of Disque PHP client.
 *
 * @copyright    2015 - Marco Vito Moscaritolo <marco@mavimo.org>
 * @license      https://github.com/mavimo/disque-client-php/blob/master/LICENSE.md
 * @link         https://github.com/mavimo/disque-client-php
 */

namespace Mavimo\Disque\Client;

final class Socket implements SocketInterface
{
    /**
     * @var string
     */
    protected $address;

    /**
     * @var string
     */
    protected $port;

    /**
     * @var resource
     */
    protected $socket;

    /**
     * Create a new Socket.
     *
     * @param string $address
     * @param int    $port
     */
    public function __construct($address, $port)
    {
        $this->address = $address;
        $this->port = $port;
    }

    /**
     * {@inherit}
     */
    public function sendCommand(array $commands)
    {
        // Translate commands in the protocol required to disque
        $commands = array_map(function ($item) {
            return sprintf("$%s\r\n%s\r\n", strlen($item), $item);
        }, $commands);

        // Prepend the number of commands
        array_unshift($commands, sprintf("*%s\r\n", count($commands)));

        // Send the command using socket
        fwrite($this->getSocket(), implode($commands));

        // Get the response
        return $this->parseResponse();
    }

    private function getSocket()
    {
        if (!is_null($this->socket)) {
            return $this->socket;
        }

        $server = sprintf('%s:%s', $this->address, $this->port);
        $this->socket = stream_socket_client($server);

        return $this->socket;
    }

    private function parseResponse()
    {
        $line   = fgets($this->getSocket());
        $type   = substr($line, 0, 1);
        $result = substr($line, 1, strlen($line) - 3);

        // Error message
        if ($type === '-') {
            throw new Exception($result);
        }

        // Bulk reply without content
        if ($type === '$' && $result === -1) {
            return;
        }

        // Bulk reply with content
        if ($type === '$') {
            $line = fread($this->getSocket(), $result + 2);
            return substr($line, 0, strlen($line) - 2);
        }

        // Multi-bulk reply
        if ($type === '*') {
            $count = (int) $result;
            for ($i = 0, $result = array(); $i < $count; $i++) {
                $result[] = $this->parseResponse();
            }
        }

        return $result;
    }
}
