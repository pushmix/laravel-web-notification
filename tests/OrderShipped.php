<?php

namespace Pushmix\WebNotification\Test;

use Illuminate\Notifications\Notification;
use Pushmix\WebNotification\PushmixChannel;
use Pushmix\WebNotification\PushmixMessage;

class OrderShipped extends Notification
{
    public function via($notifiable)
    {
        return [PushmixChannel::class];
    }

    public function toPushmix($to)
    {
        //dd($to);
        return (new PushmixMessage($to))
        ->title('Order Shipped')
        ->body('Your Order 123456 has been dispatched.')
        ->url('https://www.pushmix.co.uk');
    }
}
