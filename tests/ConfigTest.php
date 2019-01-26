<?php

namespace Pushmix\WebNotification\Test;

use Mockery;
use Orchestra\Testbench\TestCase;

class ConfigTest extends TestCase
{
    protected $client;

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test */
    public function it_can_read_subscription_id()
    {
        $this->assertIsReadable(dirname(__FILE__).'/../src/config/pushmix.php');
        $config = include dirname(__FILE__).'/../src/config/pushmix.php';
        $this->assertCount(2, $config);
        $this->assertArrayHasKey('subscription_id', $config);
        $this->assertArrayHasKey('api_url', $config);
    }

    /***/
}
