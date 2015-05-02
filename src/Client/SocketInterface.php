<?php
/**
 * This file is part of Disque PHP client.
 *
 * @copyright    2015 - Marco Vito Moscaritolo <marco@mavimo.org>
 * @license      https://github.com/mavimo/disque-client-php/blob/master/LICENSE.md
 * @link         https://github.com/mavimo/disque-client-php
 */
namespace Mavimo\Disque\Client;

interface SocketInterface
{
    /**
     * Allow to send command through socket connection.
     *
     * @param  array $commands  List of command to send
     * @return string           The response after command execution
     */
    public function sendCommand(array $commands);
}
