<?php

namespace Pushmix\WebNotification;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Pushmix\WebNotification\Message;


class PushmixServiceProvider extends ServiceProvider {

    protected $defer = true;

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

	}
    /***/

    /**
     * register service container bindings
     */
    public function register() {
        
        $this->app->singleton('pushmix',function () {
            return new Message;
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