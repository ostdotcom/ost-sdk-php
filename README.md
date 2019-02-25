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
//$getParams['ids'] = array('91263ebd-6b2d-4001-b732-4024430ca758', '91263ebd-6b2d-4001-b732-4024430ca758');
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
$createParams['user_id'] = '90aee630-2e7c-4fff-91cc-229bc9007ffc';
$createParams['address'] = '0xbE8b3Fa4133E77e72277aF6b3Ea7BB3750511B88';
$createParams['api_signer_address'] = '0xA9C90F80F96D9b896ae5aC3248b64348984aa7bC';
$createParams['device_uuid'] = '593a967f-87bd-49a6-976c-52edf46c4df4';
$createParams['device_name'] = 'Iphone S';
$response = $deviceService->create($createParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get User Device(s) List:

```php
$getParams = array();
$getParams['user_id'] = 'd194aa75-acd5-4f40-b3fb-e73a7cf7c0d9';
//$getParams['pagination_identifier'] = 'eyJsYXN0RXZhbHVhdGVkS2V5Ijp7InVpZCI6eyJTIjoiZDE5NGFhNzUtYWNkNS00ZjQwLWIzZmItZTczYTdjZjdjMGQ5In0sIndhIjp7IlMiOiIweDU4YjQxMDY0NzQ4OWI4ODYzNTliNThmZTIyMjYwZWIxOTYwN2IwZjYifX19';
//$getParams['addresses'] = array("0x5906ae461eb6283cf15b0257d3206e74d83a6bd4","0xab248ef66ee49f80e75266595aa160c8c1abdd5a");
$response = $deviceService->getList($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get User Device:

```php
$getParams = array();
$getParams['user_id'] = 'd194aa75-acd5-4f40-b3fb-e73a7cf7c0d9';
$getParams['device_address'] = '0x1Ea365269A3e6c8fa492eca9A531BFaC8bA1649E';
$response = $deviceService->get($getParams)->wait();
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
//$getParams['pagination_identifier'] = 'eyJsYXN0RXZhbHVhdGVkS2V5Ijp7InVpZCI6eyJTIjoiZDE5NGFhNzUtYWNkNS00ZjQwLWIzZmItZTczYTdjZjdjMGQ5In0sIndhIjp7IlMiOiIweDU4YjQxMDY0NzQ4OWI4ODYzNTliNThmZTIyMjYwZWIxOTYwN2IwZjYifX19';
//$getParams['addresses'] = array("0x5906ae461eb6283cf15b0257d3206e74d83a6bd4","0xab248ef66ee49f80e75266595aa160c8c1abdd5a");
$response = $sessionService->getList($getParams)->wait();
var_dump($response);
```

Get User Session:

```php
$getParams = array();
$getParams['user_id'] = 'd194aa75-acd5-4f40-b3fb-e73a7cf7c0d9';
$getParams['session_address'] = '0x1Ea365269A3e6c8fa492eca9A531BFaC8bA1649E';
$response = $sessionService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Transactions Module 

```php
$transactionService = $ostObj->services->transactions;
```

Execute Transaction:

```php
$executeParams = array();
$executeParams['user_id'] = '0ed0ee05-d647-4c11-93ca-4a08702c00af';
$executeParams['to'] = '0x0db21951af9afbd7490461d1029e1e0cc1436a7d';
$rawCallData = array();
$transferTo = array("0x80655ef8e10632885c85e567d76aedd63d2c5756");
$transferAmount = array("10");
$rawCallData['method'] = 'directTransfers';
$rawCallData['parameters'] = array($transferTo, $transferAmount);
$executeParams['raw_calldata'] = json_encode($rawCallData);

$response = $transactionService->execute($executeParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get Transactions:

```php
$getParams = array();
$getParams['user_id'] = '0ed0ee05-d647-4c11-93ca-4a08702c00af';
$getParams['transaction_id'] = '14d11128-55c5-4ef5-b721-9e298cb83fb2';
$response = $transactionService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get User Transactions:

```php
$getParams = array();
$getParams['user_id'] = '0ed0ee05-d647-4c11-93ca-4a08702c00af';
$response = $transactionService->getList($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Balances Module 

```php
$balanceService = $ostObj->services->balances;
```

Get Balance

```php
$getParams = array();
$getParams['user_id'] = 'd194aa75-acd5-4f40-b3fb-e73a7cf7c0d9';
$response = $balanceService->get($getParams)->wait();
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