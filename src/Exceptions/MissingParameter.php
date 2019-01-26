<?php

namespace Pushmix\WebNotification\Exceptions;

class MissingParameter extends \Exception
{
    public static function error( $parameter )
    {
        return new static('Parameter `'.$parameter.'` is required.');
    }
}
