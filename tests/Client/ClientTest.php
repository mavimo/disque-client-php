<?php
/**
 * This file is part of Disque PHP client.
 *
 * @copyright    2015 - Marco Vito Moscaritolo <marco@mavimo.org>
 * @license      https://github.com/mavimo/disque-client-php/blob/master/LICENSE.md
 * @link         https://github.com/mavimo/disque-client-php
 */
namespace Mavimo\Tests\Disque\Client;

use Mavimo\Disque\Client\Client;
use Mavimo\Disque\Client\SocketInterface;
use Mavimo\Disque\Job\Job;
use Mavimo\Disque\Queue\Queue;

use Prophecy\Argument;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testJobIdUpdateAfterPush()
    {
        $jobIds = 'DI0f0c644fd3ccb51c2cedbd47fcb6f312646c993c05a0SQ';
        $socket = $this->prophesize('Mavimo\Disque\Client\SocketInterface');
        $socket->sendCommand(Argument::any())->willReturn($jobIds);

        $client = new Client($socket->reveal());
        $job = new Job('test');
        $queue = new Queue('test');

        $client->push($queue, $job);

        $this->assertEquals($jobIds, $job->getIds());
    }
}
