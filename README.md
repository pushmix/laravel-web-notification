## ![Pushmix](https://www.pushmix.co.uk/media/favicons/favicon-32x32.png) Pushmix Notifications Driver for Laravel 5.7.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pushmix/laravel-web-notification.svg)](https://packagist.org/packages/pushmix/laravel-web-notification)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE.md)
[![StyleCI](https://github.styleci.io/repos/153896598/shield?branch=master)](https://github.styleci.io/repos/153896598)
[![Build Status](https://img.shields.io/travis/pushmix/laravel-web-notification/master.svg)](https://travis-ci.org/lpushmix/laravel-web-notification)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pushmix/laravel-web-notification/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pushmix/laravel-web-notification/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/pushmix/laravel-web-notification/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/pushmix/laravel-web-notification/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/pushmix/laravel-web-notification/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)


## About

This package makes it easy to send [Pushmix notifications](https://www.pushmix.co.uk/docs/laravel-package) with Laravel 5.7.

## Contents

- [Setting up your Pushmix account](#setting-up-your-pushmix-account)
- [Installation](#installation)
	- [Configuration](#configuration)
- [Displaying Opt In Prompt](#displaying-opt-in-prompt)
- [Usage](#usage)
	- [Available Message methods](#all-available-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Issues](#issues)
- [Security Vulnerabilities](#security-vulnerabilities)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Setting up your Pushmix account

If you haven't already, sign up for a free account on [pushmix.co.uk](https://dash.pushmix.co.uk/register).

[Create new subscription](https://www.pushmix.co.uk/docs/create-subscription) for your website and choose preferred [integration method](https://www.pushmix.co.uk/docs/installation). Build your subscribers audience via displaying an Opt-In Prompt asking users for permission to send them push notifications.

## Installation

You can install the package via composer:

```bash
$ composer require pushmix/laravel-web-notification:1.4
```

If you're installing the package in Laravel 5.4 or lower, you must import the service provider:

```php
// config/app.php
'providers' => [
    ...
    Pushmix\WebNotification\PushmixServiceProvider::class,
],
```

## Configuration

Publish package config and view files:

```bash
php artisan vendor:publish --provider="Pushmix\WebNotification\PushmixServiceProvider"
```

Add your Subscription ID into `.env` file:

```bash
PUSHMIX_SUBSCRIPTION_ID=PASTE_YOUR_SUBSCRIPTION_ID_HERE
```



## Displaying Opt In Prompt

To display Opt-In Prompt you will need to include block of JavaScript into your template using Blade `@include` directive.

Alternatively you can copy and paste content of `vendor.pushmix.optin` into template.

```bash
    <body>
        ...

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>
        </div>

        <!-- Including Opt In Prompt in Blade template-->

        @include('vendor.pushmix.optin')

    </body>
    ...
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

``` php
use Pushmix\WebNotification\PushmixChannel;
use Pushmix\WebNotification\PushmixMessage;
use Illuminate\Notifications\Notification;

class AbandonedCart extends Notification
{
    public function via($notifiable)
    {
        return [PushmixChannel::class];
    }

		public function toPushmix($to)
    {

      return PushmixMessage::create($to)
						/* Required Parameters */
          ->title("You still have items in your Cart!")
          ->body("There's still time to complete your order. Return to your cart?")
          ->url("https://www.pushmix.co.uk")

					/* Optional Parameters */
          ->button("Return to your cart", "https://www.pushmix.co.uk/docs") // button one
          ->priority("high")
          ->ttl(7200) // time to live
          ->icon("https://www.pushmix.co.uk/media/favicons/apple-touch-icon.png")
          ->badge("https://www.pushmix.co.uk/media/favicons/pm_badge_v2.png")
          ->image("https://www.pushmix.co.uk/media/photos/photo16.jpg");
    }
}
```

The notifications will be sent to the audience, which subscribed via Opt-In Prompt displayed on your website.
Using the `Notification::route` method, you can specify which subscribers group you are targeting.

```php
use Notification;
use App\Notifications\AbandonedCart;
...
// Target All Subscribed Users
Notification::route('Pushmix', 'all')->notify(new AbandonedCart());

// Target Topic One Subscribers
Notification::route('Pushmix', 'one')->notify(new AbandonedCart());

// Target Topic Two Subscribers
Notification::route('Pushmix', 'two')->notify(new AbandonedCart());


```
### All available methods

[Pushmix documentation](https://www.pushmix.co.uk/docs/api)

- `title('')`: Accepts a string value for the title, required*
- `body('')`: Accepts a string value for the notification body,required*
- `url('')`: Accepts an url for the notification click event,required*

- `button('', '')`: Accepts string value for button title and an url for the notification click event. Max 2 buttons can be attached.
- `icon('')`: Accepts an url for the icon.
- `priority('')`: Accepts `high` or `normal` strings.
- `ttl('')`: Accepts an integer, notification life span in seconds,must be from 0 to 2,419,200
- `icon('')`: Accepts an url for the icon.
- `badge('')`: Accepts an url for the badge.
- `image('')`: Accepts an url for the large image.


## Testing

Navigate into the package folder `vendor/pushmix/laravel-web-notification` and issue following command:

```bash
$ composer test
```


## Issues

If you come across any issues please report them [here](https://github.com/pushmix/laravel-web-notification/issues).

## Security Vulnerabilities
If you discover a security vulnerability please send an e-mail to support@pushmix.co.uk.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Alexander Pechkarev](https://github.com/alexpechkarev)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
