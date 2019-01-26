<?php

namespace Pushmix\WebNotification\Test;

use Mockery;
use GuzzleHttp\Psr7\Response;
use Orchestra\Testbench\TestCase;
use Pushmix\WebNotification\PushmixServiceProvider;
use Pushmix\WebNotification\PushmixClient;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;




class ServiceProviderTest extends TestCase
{
  protected $app;
  protected $service;
  protected $prophet;

    public function setUp()
    {
        parent::setUp();

        $this->app      = new Application();
        $this->service  = new PushmixServiceProvider($this->app);


    }



    public function tearDown()
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test */
    public function it_can_register(){

       $this->service->register();

       $this->assertInstanceOf(PushmixClient::class, $this->app->make('pushmix'));

    }
    /***/


    /** @test */
    public function it_can_return_provides(){

       $providers = $this->service->provides();
       $this->assertInternalType('array',$providers);
       $this->assertEquals(1,count($providers));
       $this->assertSame('pushmix',$providers[0]);

    }
    /***/




}
