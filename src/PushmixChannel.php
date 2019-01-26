<?php

namespace Pushmix\WebNotification;

use Pushmix\WebNotification\PushmixClient;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Notifications\Notification;
use GuzzleHttp\Exception\RequestException;
use Pushmix\WebNotification\Exceptions\CouldNotSendNotification;

class PushmixChannel
{
    /** @var PushmixClient */
    protected $pusmixClient;

    public function __construct(PushmixClient $pusmixClient)
    {
        $this->pusmixClient = $pusmixClient;
    }

    /**
     * Send Notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Pushmix\WebNotification\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('Pushmix') ) {
            return;
        }

        $parameters = $notification->toPushmix($to)->toArray();

        // initialize subscription key and api url
        $this->pusmixClient->initKey()->initApiUrl();

        // Call with parameters
        try{
            return $this->pusmixClient->sendNotification($parameters);

        } catch (RequestException $e) {

          throw CouldNotSendNotification::error($e);
      }

    }
    /***/


}
