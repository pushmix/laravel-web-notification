<?php

namespace Pushmix\WebNotification;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Pushmix\WebNotification\Message;
use Pushmix\WebNotification\PushmixChannel;
use Pushmix\WebNotification\PushmixClient;
use Pushmix\WebNotification\Exceptions\InvalidConfiguration;


class PushmixServiceProvider extends ServiceProvider {

  /**
   * Indicates if loading of the provider is deferred.
   *
   * @var bool
   */
    protected $defer = true;


    /**
     * register service container bindings
     */
    public function register() {

        $this->app->singleton('pushmix',function () {
            return new PushmixClient();
        });
    }
    /***/

    /**
     * booting
     */
	public function boot() {

    // Pusblish assets
		$this->publishes([

			__DIR__.'/config/pushmix.php' => config_path('pushmix.php'),
            __DIR__.'/views' => resource_path('views/vendor/pushmix'),
            __DIR__.'/js' => public_path(),

		], 'pushmix');

    // Clear Config Cache
    Artisan::call('config:clear');


    $this->app->when(PushmixChannel::class)
        ->needs(PushmixClient::class)
        ->give(function () {

            if (is_null(config('pushmix.subscription_id', null))) {

                throw InvalidConfiguration::configurationNotSet();
            }

            return new PushmixClient();
    });

	}
    /***/



    /**
     * providers
     *
     * @return     array  ( description_of_the_return_value )
     */
    public function provides() {
        return ['pushmix'];
    }
    /***/
}
