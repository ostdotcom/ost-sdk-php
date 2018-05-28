# OST PHP SDK
The official [OST PHP SDK](https://dev.ost.com/).

## Requirements

To use this SDK, developers will need to:
1. Sign-up on [https://kit.ost.com](https://kit.ost.com).
2. Launch a branded token economy with the OST KIT Economy Planner.
3. Obtain an API Key and API Secret from [https://kit.ost.com/developer-api-console](https://kit.ost.com/developer-api-console).

## Documentation

[https://dev.ost.com/](https://dev.ost.com/)

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
$params['apiBaseUrl']='https://sandboxapi.ost.com/v1/';

$ostObj = new OSTSdk($params);

```

### Users Module 

```php
$userService = $ostObj->services->users;
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
$editUserParams['id'] = '867a5ea0-d8c1-4137-9be1-39c4549969ed';
$response = $userService->edit($editUserParams)->wait();
var_dump($response);
```

Get a user:

```php
$getUserParams = array();
$getUserParams['id'] = '7ac1da33-b1d2-4f03-b39c-fbac0f1e2b92';
$response = $userService->get($getUserParams)->wait();
var_dump($response);
```

Get a list of users and other data:

```php
$listUserParams = array();
$listUserParams['page_no'] = '1';
$listUserParams['limit'] = '5';
$listUserParams['id'] = 'a3b87254-21b7-4eaf-a2be-c368fd65c7b6,fb8e284d-e9c4-4432-a78e-74766e206d73';
$response = $userService->getList($listUserParams)->wait();
var_dump($response);
```

### Airdrops Module 

```php
$airdropService = $ostObj->services->airdrops;
```

Airdrop branded tokens to users:

```php
$airdropParams = array();
$airdropParams['airdropped'] = 'false';
$airdropParams['amount'] = '1';
$airdropParams['user_ids'] = 'f87346e4-61f6-4d55-8cb8-234c65437b01';
$response = $airdropService->execute($airdropParams)->wait();
var_dump($response);
```

Get Airdrop Status:

```php
$getairdropStatusParams = array();
$getairdropStatusParams['id'] = '7ac1da33-b1d2-4f03-b39c-fbac0f1e2b92';
$response = $airdropService->get($getairdropStatusParams)->wait();
var_dump($response);
```

List Airdrop:

```php
$listAirdropParams = array();
$listAirdropParams['page_no'] = '1';
$listAirdropParams['limit'] = '11';
$listAirdropParams['current_status'] = 'processing,complete';
$response = $airdropService->getList($listAirdropParams)->wait();
var_dump($response);
```

### Actions Module 

```php
$actionService = $ostObj->services->actions;
```

Create an action:

```php
$createParams = array();
$createParams['name'] = 'Like';
$createParams['kind'] = 'user_to_user';
$createParams['currency'] = 'USD';
$createParams['arbitrary_amount'] = 'false';
$createParams['amount'] = '1';
$createParams['commission_percent'] = '1.1';
$response = $actionService->create($createParams)->wait();
var_dump($response);
```

Edit an existing action:

```php
$editParams = array();
$editParams['name'] = 'Temp';
$editParams['id'] = '22880';
$response = $actionService->edit($editParams)->wait();
var_dump($response);
```

Get a list of existing actions and other data:

```php
$listParams = array();
$listParams['page_no'] = '1';
$listParams['limit'] = '11';
$listParams['id'] = '22880';
$response = $actionService->getList($listParams)->wait();
var_dump($response);
```

Get Action Detail:

```php
$getActionParams = array();
$getActionParams['id'] = '22880';
$response = $actionService->get($getActionParams)->wait();
var_dump($response);
```


### Transactions Module 

```php
$transactionService = $ostObj->services->transactions;
```

Get Transaction Detail:

```php
$getParams = array();
$getParams['id'] = 'ee50f777-1d39-4196-adf8-3021ecc9d852';
$response = $transactionService->get($getParams)->wait();
var_dump($response);
```

Get Transaction List:

```php
$listParams = array();
$listParams['page_no'] = '1';
$listParams['limit'] = '11';
$listParams['id'] = 'ee50f777-1d39-4196-adf8-3021ecc9d852';
$response = $transactionService->getList($listParams)->wait();
var_dump($response);
```

Execute a Transaction:

```php
$executeParams = array();
$executeParams['from_user_id'] = 'f87346e4-61f6-4d55-8cb8-234c65437b01';
$executeParams['to_user_id'] = 'c07bd853-e893-4400-b7e8-c358cfa05d85';
$executeParams['action_id'] = '20145';
$response = $transactionService->execute($executeParams)->wait();
var_dump($response);
```

### Token Module 

```php
$tokenService = $ostObj->services->token;
```

Get Token Detail:

```php
$getParams = array();
$response = $tokenService->get($getParams)->wait();
var_dump($response);
```

### Transfers Module 

```php
$transferService = $ostObj->services->transfers;
```

Get Transfer Detail:

```php
$getParams = array();
$getParams['id'] = 'ad03a99e-e7c4-4f5a-9fab-ef9a3e422621';
$response = $transferService->get($getParams)->wait();
var_dump($response);
```

Get Transfer List:

```php
$listParams = array();
$listParams['page_no'] = '1';
$listParams['limit'] = '11';
$response = $transferService->getList($listParams)->wait();
var_dump($response);
```

Execute a Transfer:

```php
$executeParams = array();
$executeParams['to_address'] = '0xF65E3C06b973a226f9e9B2960d7acdB8fdF9a331';
$executeParams['amount'] = '1';
$response = $transferService->execute($executeParams)->wait();
var_dump($response);
```
