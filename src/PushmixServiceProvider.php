<?php

namespace Pushmix\WebNotification;

use Illuminate\Support\ServiceProvider;

class PushmixServiceProvider extends ServiceProvider {

    protected $defer = true;

	public function boot() {

        \Log::info('here');
		$this->publishes([
			__DIR__.'/../config/pushmix.php' => config_path('pushmix.php'),
		], 'pushmix');
	}

    public function register() {
        
    }

    public function provides() {
        return ['pushmix'];
    }
}