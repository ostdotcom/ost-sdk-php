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

// The config field is optional
$configParams = array();
// This is the timeout in seconds for which the socket connection will remain open
$configParams["timeout"] = 15;
$params["config"] = $configParams;

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
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Users Module 

```php
$userService = $ostObj->services->users;
```

Create User:

```php
$createParams = array();
$response = $userService->create($createParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get User Detail:

```php
$getParams = array();
$getParams['id'] = '91263ebd-6b2d-4001-b732-4024430ca758';
$response = $userService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get User List:

```php
$getParams = array();
$response = $userService->getList($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Devices Module 

```php
$deviceService = $ostObj->services->devices;
```

Create a device for User:

```php
$createParams = array();
$createParams['user_id'] = 'd194aa75-acd5-4f40-b3fb-e73a7cf7c0d9';
$createParams['address'] = '0x1Ea365269A3e6c8fa492eca9A531BFaC8bA1649E';
$createParams['api_signer_address'] = '0x5F860598383868e8E8Ee0ffC5ADD92369Db37455';
$createParams['device_uuid'] = '593a967f-87bd-49a6-976c-52edf46c4df4';
$createParams['device_name'] = 'Iphone S';
$response = $deviceService->create($createParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get User Device(s) List:

```php
$getParams = array();
$getParams['user_id'] = 'd194aa75-acd5-4f40-b3fb-e73a7cf7c0d9';
//$getParams['limit'] = 1;
//$getParams['pagination_identifier'] = 'eyJsYXN0RXZhbHVhdGVkS2V5Ijp7InVpZCI6eyJTIjoiZDE5NGFhNzUtYWNkNS00ZjQwLWIzZmItZTczYTdjZjdjMGQ5In0sIndhIjp7IlMiOiIweDU4YjQxMDY0NzQ4OWI4ODYzNTliNThmZTIyMjYwZWIxOTYwN2IwZjYifX19';
//$getParams['address'] = '0x5906ae461eb6283cf15b0257d3206e74d83a6bd4,0xab248ef66ee49f80e75266595aa160c8c1abdd5a';
$response = $deviceService->getList($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get User Device:

```php
$getParams = array();
$getParams['user_id'] = 'd194aa75-acd5-4f40-b3fb-e73a7cf7c0d9';
$getParams['device_address'] = '0x1Ea365269A3e6c8fa492eca9A531BFaC8bA1649E';
$response = $deviceService->getDevice($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Session Module

```php
$sessionService = $ostObj->services->sessions;
```

Get User Session(s) List:

```php
$getParams = array();
$getParams['user_id'] = 'e50e252c-318f-44a5-b586-9a9ea1c41c15';
//$getParams['limit'] = 1;
//$getParams['pagination_identifier'] = 'eyJsYXN0RXZhbHVhdGVkS2V5Ijp7InVpZCI6eyJTIjoiZDE5NGFhNzUtYWNkNS00ZjQwLWIzZmItZTczYTdjZjdjMGQ5In0sIndhIjp7IlMiOiIweDU4YjQxMDY0NzQ4OWI4ODYzNTliNThmZTIyMjYwZWIxOTYwN2IwZjYifX19';
//$getParams['address'] = '0x5906ae461eb6283cf15b0257d3206e74d83a6bd4,0xab248ef66ee49f80e75266595aa160c8c1abdd5a';
$response = $sessionService->getList($getParams)->wait();
var_dump($response);
```

### Device Manager Module 

```php
$deviceManagerService = $ostObj->services->deviceManagers;
```

Get User's Device Manager Details:

```php
$getParams = array();
$getParams['user_id'] = '1617ce62-c269-4203-bb1c-76cb778d7093';
$response = $deviceManagerService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Price Points Module 

```php
$pricePointsService = $ostObj->services->pricePoints;
```

Get 

```php
$getParams = array();
$response = $pricePointsService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Chains Module 

```php
$chainsService = $ostObj->services->chains;
```

Get 

```php
$getParams = array();
$getParams['chain_id'] = '2000';
$response = $chainsService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

