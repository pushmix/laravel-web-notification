# pushmix/laravel-web-notification

## About

This package integrates Pushmix service with Laravel applications allowing inclusion of web notification opt in prompt to any template and sending notification messages using API from Controller.


## Installation

The preferred method of installation is via [Packagist][] and [Composer][]. Run the following command to install the package and add it as a requirement to your project's `composer.json`:

```bash
composer require pushmix/web-laravel-notification:dev-master
```

Create subscription at [Pushmix](https://www.pushmix.co.uk) copy your `subscription_id` and paste into `.env` file.
```bash
PUSHMIX_SUBSCRIPTION_ID=MY_SUBSCRIPTION_ID
```

Publish package assets and you good to go.
```bash
composer require pushmix/web-laravel-notification:dev-master
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