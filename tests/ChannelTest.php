<?php

namespace Pushmix\WebNotification\Test;

use Mockery;
use Orchestra\Testbench\TestCase;
use Pushmix\WebNotification\PushmixClient;
use Pushmix\WebNotification\PushmixChannel;
use Illuminate\Notifications\AnonymousNotifiable;
use Pushmix\WebNotification\Exceptions\CouldNotSendNotification;

class ChannelTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    protected function getEnvironmentSetUp($app)
    {
        //setup db config if needed
        $app['config']->set('pushmix.subscription_id', 'SUBSCRIPTION_ID');
        $app['config']->set('pushmix.api_url', 'https://www.pushmix.co.uk/api/notify');
    }

    public function tearDown()
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test */
    public function it_can_send()
    {
        $client = new PushmixClient();
        $channel = new PushmixChannel($client);
        $notifiable = (new AnonymousNotifiable)->route('Pushmix', 'all');
        $response = $channel->send($notifiable, new OrderShipped());
        $this->assertSame(200, $response->getStatusCode());
    }

    /***/

    /** @test */
    public function it_can_throw_exception()
    {
        $this->expectException(CouldNotSendNotification::class);
        \Config::set('pushmix.api_url', 'https://www.pushmix.co.uk/api/fail');
        $client = new PushmixClient();
        $channel = new PushmixChannel($client);
        $notifiable = (new AnonymousNotifiable)->route('Pushmix', 'all');
        $channel->send($notifiable, new OrderShipped());
    }

    /***/

    /** @test */
    public function it_can_route_notification()
    {
        $client = new PushmixClient();
        \Config::set('pushmix.api_url', 'https://www.pushmix.co.uk/api/ping');
        $channel = new PushmixChannel($client);
        $notifiable = (new AnonymousNotifiable)->route('Not_Pushmix', 'all');
        $channel->send($notifiable, new OrderShipped());
        $this->assertTrue(true);
    }

    /***/
}
