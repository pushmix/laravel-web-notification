<?php

namespace Pushmix\WebNotification\Exceptions;

class InvalidConfiguration extends \Exception
{
    public static function configurationNotSet()
    {
        return new static('Missing parameters: `"subscription_id"` or `"api_url"` check config file `config/pushmix.php`');
    }
}
