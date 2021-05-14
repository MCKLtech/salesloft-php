# salesloft-php

PHP bindings to the SalesLoft API

## Installation

This library requires PHP 7.1 and later

The recommended way to install drift-php is through [Composer](https://getcomposer.org)

This library is intended to speed up development time but is not a shortcut to reading the SalesLoft API documentation. Many endpoints require specific and required fields for successful operation. Always read the documentation before using an endpoint.

```sh
composer require mckltech/salesloft-php
```

## Clients - API Key 

Initialize your client using your access token:

```php
use SalesLoft\SalesLoftClient;

$client = new SalesLoftClient('ACCESS_TOKEN');
```

> - The access token is expected to be from your SalesLoft API Key console or from a successful OAuth install


## Support, Issues & Bugs

This library is unofficial and is not endorsed or supported by SalesLoft.

For bugs and issues, open an issue in this repo and feel free to submit a PR. Any issues that do not contain full logs or explanations will be closed. We need you to help us help you!

## API Versions

This library is intended to work with the SalesLoft V2 API as published in May 2021.

## Contacts

```php
/** List Users */
$client->users->list();

/** Create A Person */
$client->people->create(['email_address' => 'example@salesloft.com', 'first_name' => 'Sales', 'last_name' => 'Loft']);
```

## Supported Endpoints

All endpoints follow a similar mechanism to the examples show above. Again, please ensure you read the SalesLoft API documentation prior to use as there are numerous required fields for most POST/PUT/PATCH operations.

- Cadences 
- Users
- People
- Notes
- Person Stages

## Exceptions

Exceptions are handled by HTTPlug. Every exception thrown implements `Http\Client\Exception`. See the [http client exceptions](http://docs.php-http.org/en/latest/httplug/exceptions.html) and the [client and server errors](http://docs.php-http.org/en/latest/plugins/error.html). If you want to catch errors you can wrap your API call into a try/catch block:

```php
try {
    $users = $client->users->list();
} catch(Http\Client\Exception $e) {
    if ($e->getCode() == '404') {
        // Handle 404 error
        return;
    } else {
        throw $e;
    }
}
```

## Credit

The layout and methodology used in this library is courtesy of https://github.com/intercom/intercom-php


