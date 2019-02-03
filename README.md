# OST PHP SDK
[![Build Status](https://travis-ci.org/OpenSTFoundation/ost-sdk-php.svg?branch=master)](https://travis-ci.org/OpenSTFoundation/ost-sdk-php)

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
$params['apiKey']='';
$params['apiSecret']='';
$params['apiBaseUrl']='';

$ostObj = new OSTSdk($params);

```

### Tokens Module 

```php
$tokenService = $ostObj->services->tokens;
```

Get Token Detail:

```php
$getParams = array();
$response = $tokenService->get($getParams)->wait();
var_dump($response);
```

### Users Module 

```php
$userService = $ostObj->services->users;
```

Create User:

```php
$createParams = array();
$response = $userService->create($createParams)->wait();
var_dump($response);
```

Get User Detail:

```php
$getParams = array();
$getParams['id'] = '932f775c-43fd-48a4-aa3e-35c1a1732763';
$response = $userService->get($getParams)->wait();
var_dump($response);
```

Get User List:

```php
$getParams = array();
$response = $userService->getList($getParams)->wait();
var_dump($response);
```

### Devices Module 

```php
$deviceService = $ostObj->services->devices;
```


Create a device for User:

```php
$createParams = array();
$createParams['user_id'] = '1617ce62-c269-4203-bb1c-76cb778d7093';
$createParams['address'] = '0xBC248Ef66Ee49f80E75266595aa160c8c1abdD5a';
$createParams['personal_sign_address'] = '0xAfd814146EAB5Dd96eEefE00B3DbE3270B822066';
$createParams['device_uuid'] = '793a967f-87bd-49a6-976c-52edf46c4df4';
$createParams['device_name'] = 'Iphone S';
$response = $deviceService->create($createParams)->wait();
var_dump($response);
```

Get User Device(s) List:

```php
$getParams = array();
$getParams['address'] = '';
$response = $deviceService->getList($getParams)->wait();
var_dump($response);
```

### Device Manager Module 

```php
$deviceManagerService = $ostObj->services->deviceManagers;
```

Get User's Device Manager Details:

```php
$getParams = array();
$getParams['user_id'] = '';
$response = $deviceManagerService->get($getParams)->wait();
var_dump($response);
```

