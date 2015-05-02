<?php
/**
 * This file is part of Disque PHP client.
 *
 * @copyright    2015 - Marco Vito Moscaritolo <marco@mavimo.org>
 * @license      https://github.com/mavimo/disque-client-php/blob/master/LICENSE.md
 * @link         https://github.com/mavimo/disque-client-php
 */
namespace Mavimo\Tests\Disque\Queue;

use Mavimo\Disque\Queue\Queue;

class QueueTest extends \PHPUnit_Framework_TestCase
{
    public function testQueueHaveName()
    {
        $queue = new Queue('test');

        $this->assertEquals('test', $queue->getName());
    }
}
