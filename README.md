# drift-php

PHP bindings to the Drift API

## Installation

This library requires PHP 7.1 and later

The recommended way to install drift-php is through [Composer](https://getcomposer.org)

This library is intended to speed up development time but is not a shortcut to reading the Drift API documentation. Many endpoints require specific and required fields for successful operation. Always read the documentation before using an endpoint.

```sh
composer require mckltech/drift-php
```

## Clients - API Key 

Initialize your client using your access token:

```php
use Drift\DriftClient;

$client = new DriftClient('ACCESS_TOKEN');
```

> - The access token is expected to be from your Drift Developer console or from a successful OAuth install: https://devdocs.drift.com/docs/authentication-and-scopes


## Support, Issues & Bugs

This library is unofficial and is not endorsed or supported by Drift.

For bugs and issues, open an issue in this repo and feel free to submit a PR. Any issues that do not contain full logs or explanations will be closed. We need you to help us help you!

## API Versions

This library is intended to work with the Drift API as published in April 2021.

## Contacts

```php
/** List Contacts */
$client->contacts->list();

/** List 5 contacts with the email 'example@drift.com' */
$client->contacts->list(['limit' => 5, 'email' => 'example@drift.com']);

/** Create A Contact */
$client->contacts->create(['email' => 'example@drift.com', 'name' => 'John Drift']);
```

## Conversations & Messages

```php
/** Create a Conversation */
$client->messages->createConversation('example@drift.com', 'Hello John!');

/** Create a new message in Conversation ID 12345 send by User ID 9876 */
$client->messages->createMessage(12345, 'Let me check on that for you!', 9876);

/** Add a private note by User ID 7654 to Conversation ID 12345 */
$client->messages->createNote(12345, 'Called customer about refund request', 7654);
```

## Supported Endpoints

All endpoints follow a similar mechanism to the examples show above. Again, please ensure you read the Drift API documentation prior to use as there are numerous required fields for most POST/PUT/PATCH operations.

- Accounts
- Admin
- Contacts
- Messages
- Conversations
- Playbooks
- GDPR

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


