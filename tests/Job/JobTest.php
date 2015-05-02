<?php
/**
 * This file is part of Disque PHP client.
 *
 * @copyright    2015 - Marco Vito Moscaritolo <marco@mavimo.org>
 * @license      https://github.com/mavimo/disque-client-php/blob/master/LICENSE.md
 * @link         https://github.com/mavimo/disque-client-php
 */
namespace Mavimo\Tests\Disque\Job;

use Mavimo\Disque\Job\Job;

class JobTest extends \PHPUnit_Framework_TestCase
{
    public function testIdsSplitting()
    {
        $job = new Job('test', 'DI0f0c644fd3ccb51c2cedbd47fcb6f312646c993c05a0SQ');

        $this->assertEquals('0f0c644f', $job->getNodeId());
        $this->assertEquals('d3ccb51c2cedbd47fcb6f312646c993c', $job->getRandomId());
        $this->assertEquals('05a0', $job->getTtl());
    }
}
