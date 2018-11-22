## ![Pushmix](https://www.pushmix.co.uk/media/favicons/favicon-32x32.png) Web Push Notifications for Laravel

## About

This package integrates Pushmix service with Laravel applications providing following features:

* Subscription opt-in prompt in your templates 
* Send web push notifications from Laravel application



## Requirements
* [PHP cURL](http://php.net/manual/en/curl.installation.php)
* [Pushmix](https://www.pushmix.co.uk) Subscription ID
* Website must be served via `HTTPS://` or `localhost` to display opt-in prompt

You will need a Subscription ID to use it. The Subscription ID is FREE and can be obtained from [pushmix.co.uk](https://www.pushmix.co.uk).

## Installation

Create subscription at [Pushmix](https://www.pushmix.co.uk), copy your `subscription_id` and paste into `.env` file.
```bash
PUSHMIX_SUBSCRIPTION_ID=ADD_YOUR_PUSHMIX_ID
```

The preferred method of installation is via Composer. Run the following command to install the package to your project's `composer.json`:

```bash
composer require pushmix/laravel-web-notification
```

Publish package assets and you good to go.
```bash
php artisan vendor:publish --provider="Pushmix\WebNotification\PushmixServiceProvider"
```

## Displaying Opt-In Prompt

To display opt-in prompt you will need to include the block of JavaScript into your template using Blade `@include` directive. 

Alternatively, you can copy and paste the content of `vendor.pushmix.optin` into template. 

Preview in the web browser to ensure that opt-in prompt is triggered. Please note that web browser must be compatible with Push API, otherwise opt-in prompt will not be displayed.

```bash
    <body>
        ...

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>
        </div>

        <!-- Including Opt-In Prompt in Blade template-->

        @include('vendor.pushmix.optin')

    </body>
    ...
```



## Sending Message
Sending web push notifications to your subscribers is simple. First, add the reference to `Pushmix` class, then create an array with four required parameters.

* `topic` - defines audience you would like to target, see bellow Subscription Topics section
* `title` - notification title, keep it short
* `body`  - notification body content, keep it short
* `default_url`  - valid URL, used when user clicks the notification

Other parameters are optional. 

To send web push notifications to your subscribers use `push` method with an array of notification parameters
```php
    Pushmix::push( $msg_data )
```
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

The full example of the `push` method with all available parameters.

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
        'topic'             => 'all', // or topic id from Pushmix::getTopics() call
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
        'action_url_two'	=> 'https://www.pushmix.co.uk/docs',

    	];

 
 		Pushmix::push( $msg_data);

    	return view('thank-you');
        

    }
    /***/
}
```

## Subscription Topics

If you haven't specified additional topics in your subscription in the Pushmix dashboard than you don't need to read this. 

Please note: you can always edit your subscription and add/or remove topics. If you have recently added new topics to your subscription you will need to call this method in order to obtain your topics ID.

Ability to send web push notifications to all subscribers is great, but sometimes you only need to target those users who have expressed their interest by opting to one of your topics. 

Once you have created topics in Pushmix dashboard you can segment your audience and send web push notifications to specific topic subscribers.
First, you will need to obtain topic id by calling `Pushmix::getTopics()` 
This call will return an array of topics including name and id.
An empty array will be returned if you haven't created any topics. 

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pushmix;

class PushmixController extends Controller
{

    public function index()
    {
        
        // retrive your subscription topics
        $my_topics = Pushmix::getTopics();

        
        //content of $my_topics

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
         

         $msg_data = [
        // Required Parameters
        'topic'             => '17', // subscribers of Service Updates topic only
        'title'             => 'New Feature',
        'body'              => 'Use Pushmix within your Laravel application, see details',
        'default_url'       => 'https://www.pushmix.co.uk/docs/laravel-package',
         ];

        Pushmix::push( $msg_data);

        return view('thank-you');
        

    }
    /***/
}
```

## Issues
If you come across any issues please report them [here](https://github.com/pushmix/laravel-web-notification/issues).

## Security Vulnerabilities
If you discover a security vulnerability please send an e-mail to support@pushmix.co.uk. 

## License
The Web Push Notifications for Laravel package is licensed under the MIT License
