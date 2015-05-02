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

class ClientTest extends \PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        $this->client = new Client('asd', 1234);
    }

    public function testSkip()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
}
