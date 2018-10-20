# Laravel package for simpliefied integration with Pishmix web push notification service.

## About

This package integrates Pushmix service with Laravel applications allowing inclusion of web notification opt in prompt to any template and sending notification messages using API from Controller.


## Installation

The preferred method of installation is via Composer. Run the following command to install the package to your project's `composer.json`:

```bash
composer require pushmix/laravel-web-notification:dev-master
```

Create subscription at [Pushmix](https://www.pushmix.co.uk), copy your `subscription_id` and paste into `.env` file.
```bash
PUSHMIX_SUBSCRIPTION_ID=MY_SUBSCRIPTION_ID
```

Publish package assets and you good to go.
```bash
php artisan vendor:publish --provider="Pushmix\WebNotification\PushmixServiceProvider"
```

## Display Opt In Prompt
Display opt in prompt to your website visitor by including few lines of JavaScript into your view.
```bash
```

## Retrieving Topics

Response from `Pushmix::getTopics()` or an empty array

```bash
array:2 [
  0 => {
    "id": 17
    "topic_name": "Service Updates"
  }
  1 => {
    "id": 18
    "topic_name": "Pushmix News"
  }
]
```

## Sending Message

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pushmix;

class PushmixController extends Controller
{

    public function index()
    {

    	$msg_data = [

    	// Required Parameters
        'topic'             => 'all', // or topic id from Pushmix::getTopics()
        'title'             => 'Hello',
        'body'              => 'Welcome to Pushmix!',
        'default_url'       => 'https://www.pushmix.co.uk',


        // Optional Parameters

        // Notification Life Span
        'time_to_live'      => '3600', // 1 hour

        // MEsage Priority
        'priority'          => 'high', // or normal    
                                       	
        // Notification Icon
        'icon' 		=> 'https://www.pushmix.co.uk/media/favicons/apple-touch-icon.png',

        // Notification Badge Icon
        'badge'		=> 'https://www.pushmix.co.uk/media/favicons/pm_badge_v2.png',

       	 // Large Image
        'image'		=> 'https://www.pushmix.co.uk/media/photos/photo16.jpg',

        // Action Button title
        'action_title_one'	=> 'Features',
        // Action URL - required with action_url_one
        'action_url_one'	=> 'https://www.pushmix.co.uk/features',

        // Action Button title
        'action_title_two'	=> 'Documentation',
        // Action URL - required with action_url_two
        'action_url_two'	=> 'https://pushmix.github.io/web-notification',

    	];

 
 		Pushmix::push( $msg_data);

    	return view('tnankyou');
        

    }
    /***/
}
```



Responses from `Pushmix::push( $msg_data )` 

Success Response

```bash
{
  "succes": true
}
```

Error Response

```bash
{
  "error": "Error message"
}
```