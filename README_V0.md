# OST PHP SDK
The official [OST PHP SDK](https://dev.ost.com/docs/0.9.1/simpletoken.html).

## Requirements

To use this SDK, developers will need to:
1. Sign-up on [https://kit.ost.com](https://kit.ost.com).
2. Launch a branded token economy with the OST KIT Economy Planner.
3. Obtain an API Key and API Secret from [https://kit.ost.com/developer-api-console](https://kit.ost.com/developer-api-console).

## Documentation

[https://dev.ost.com/](https://dev.ost.com/docs/0.9.1/simpletoken.html)

## Installation

Install Composer:

```bash
> curl -sS https://getcomposer.org/installer | php
```

Install the latest stable version of the SDK:

```bash
> php composer.phar require ostdotcom/ost-sdk-php
```

## Example Usage

Require the Composer autoloader:

```php
require 'vendor/autoload.php';
```

Initialize the SDK object:

```php

$params = array();
$params['apiKey']=API_KEY;
$params['apiSecret']=API_SECRET;
$params['apiBaseUrl']='https://playgroundapi.ost.com/';

$ostObj = new OSTSdk($params);

```

### Users Module 

```php
$userService = $ostObj->services->user;
```

Create a new user:

```php
$createUserParams = array();
$createUserParams['name'] = 'Test';
$response = $userService->create($createUserParams)->wait();
var_dump($response);
```

Edit an existing user:

```php
$editUserParams = array();
$editUserParams['name'] = 'Bob';
$editUserParams['uuid'] = 'df696477-3b2b-46a2-99df-38a482e08811';
$response = $userService->edit($editUserParams)->wait();
var_dump($response);
```

Get a list of users and other data:

```php
$listUserParams = array();
$response = $userService->getList($listUserParams)->wait();
var_dump($response);
```

Airdrop branded tokens to users:

```php
$airdropParams = array();
$airdropParams['list_type'] = 'all';
$airdropParams['amount'] = '1';
$response = $userService->airdropTokens($airdropParams)->wait();
var_dump($response);
```

As airdropping tokens is an asynchronous task, you can check the airdrop's status:

```php
$getairdropStatusParams = array();
$getairdropStatusParams['airdrop_uuid'] = 'd8303e01-5ce0-401f-8ae4-d6a0bcdb2e24';
$response = $userService->getAirdropStatus($getairdropStatusParams)->wait();
var_dump($response);
```

### Transaction Kind Module 

```php
$transactionKindService = $ostObj->services->transactionKind;
```

Create new transaction types:

```php
$createParams = array();
$createParams['name'] = 'Like';
$createParams['kind'] = 'user_to_user';
$createParams['currency_type'] = 'usd';
$createParams['currency_value'] = '1.25';
$createParams['commission_percent'] = '1';
$response = $transactionKindService->create($createParams)->wait();
var_dump($response);
```

Edit an existing transaction kind:

```php
$editParams = array();
$editParams['name'] = 'LikeNew';
$editParams['client_transaction_id'] = '22881';
$editParams['currency_type'] = 'usd';
$editParams['currency_value'] = '1.25';
$editParams['commission_percent'] = '1';
$response = $transactionKindService->edit($editParams)->wait();
var_dump($response);
```

Get a list of existing transaction kinds and other data:

```php
$listParams = array();
$response = $transactionKindService->getList($listParams)->wait();
var_dump($response);
```

Execute a branded token transfer by transaction kind:

```php
$executeParams = array();
$executeParams['from_uuid'] = '1234-1928-1081dsds-djhksjd';
$executeParams['to_uuid'] = '1234-1928-1081dsds-djhksj2';
$executeParams['transaction_kind'] = 'Like';
$response = $transactionKindService->execute($executeParams)->wait();
var_dump($response);
```

Get the status of an executed transaction:

```php
$getStatusParams = array();
$getStatusParams['transaction_uuids'] = ['d8303e01-5ce0-401f-8ae4-d6a0bcdb2e24'];
$response = $transactionKindService->getStatus($getStatusParams)->wait();
var_dump($response);
```
