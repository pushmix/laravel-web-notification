<?php

namespace Pushmix\WebNotification;

use \Illuminate\Support\Facades\Facade;

class PushmixFacade extends Facade {

	/**
	 * Gets the facade accessor.
	 *
	 * @return     string  The facade accessor.
	 */
    protected static function getFacadeAccessor() {

        return 'pushmix';
    }
    /***/
}