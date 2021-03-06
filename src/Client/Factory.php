<?php
/**
 * This file is part of Disque PHP client.
 *
 * @copyright    2015 - Marco Vito Moscaritolo <marco@mavimo.org>
 * @license      https://github.com/mavimo/disque-client-php/blob/master/LICENSE.md
 * @link         https://github.com/mavimo/disque-client-php
 */

namespace Mavimo\Disque\Client;

use Mavimo\Disque\Client\Client;
use Mavimo\Disque\Client\Socket;

class Factory
{
    public function create($address = '127.0.0.1', $port = 7711)
    {
        $socket = new Socket($address, $port);

        return new Client($socket);
    }
}
