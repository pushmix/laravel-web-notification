<?php

namespace Pushmix\WebNotification\Test;

use Mockery;
use Orchestra\Testbench\TestCase;

class ViewTest extends TestCase
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
        $this->assertIsReadable(dirname(__FILE__).'/../src/views/optin.blade.php');
        $config = include dirname(__FILE__).'/../src/views/optin.blade.php';
    }

    /***/
}
