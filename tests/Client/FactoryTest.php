<?php
/**
 * This file is part of Disque PHP client.
 *
 * @copyright    2015 - Marco Vito Moscaritolo <marco@mavimo.org>
 * @license      https://github.com/mavimo/disque-client-php/blob/master/LICENSE.md
 * @link         https://github.com/mavimo/disque-client-php
 */
namespace Mavimo\Tests\Disque\Client;

use Mavimo\Disque\Client\Factory;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    protected $factory;

    protected function setUp()
    {
        $this->factory = new Factory();
    }

    public function testFactoryReturnClientWithDefaultValue()
    {
        $client = $this->factory->create();

        $this->isInstanceOf('Mavimo\Disque\Client\Client', $client);
    }

    public function testFactoryReturnClientWithHost()
    {
        $client = $this->factory->create('localhost');

        $this->isInstanceOf('Mavimo\Disque\Client\Client', $client);
    }

    public function testFactoryReturnClientWithPort()
    {
        $client = $this->factory->create('127.0.0.1', 1000);

        $this->isInstanceOf('Mavimo\Disque\Client\Client', $client);
    }
}
