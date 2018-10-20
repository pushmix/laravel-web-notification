<?php

namespace Pushmix\WebNotification;

use \Illuminate\Support\Facades\Facade;

class PushmixFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'pushmix';
    }
}