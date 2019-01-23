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

### Token Module 

```php
$tokenService = $ostObj->services->tokens;
```

Get Token Detail:

```php
$getParams = array();
$getParams['client_id'] = 1;
$response = $tokenService->get($getParams)->wait();
var_dump($response);
```