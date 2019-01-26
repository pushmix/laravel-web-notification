<?php

namespace Pushmix\WebNotification\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function error($response)
    {
        return new static($response->getMessage().' - error code: '.$response->getCode());
    }
}
