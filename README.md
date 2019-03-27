# OST PHP SDK
[![Build Status](https://travis-ci.org/ostdotcom/ost-sdk-php.svg?branch=develop)](https://travis-ci.org/ostdotcom/ost-sdk-php)

The official [OST](https://dev.ost.com/) PHP SDK.

## Introduction

OST is a complete technology solution enabling mainstream businesses 
to easily launch blockchain-based economies without 
requiring blockchain development.

At the core of OST is the concept of OST-powered Brand Tokens (BTs). 
BTs are white-label cryptocurrency tokens with utility representations 
running on highly-scalable Ethereum-based side blockchains, 
backed by OST tokens staked on Ethereum mainnet. Within a business’s 
token economy, BTs can only be transferred to whitelisted user addresses. 
This ensures that they stay within the token economy.

The OST technology stack is designed to give businesses everything they need 
to integrate, test, and deploy BTs. Within the OST suite of products, developers 
can use OST Platform to create, test, and launch Brand Tokens backed by OST. 

OST APIs and server-side SDKs make it simple and easy for developers to 
integrate blockchain tokens into their apps.

## Requirements

Integrating an OST SDK into your application can begin as soon as you create an account 
with OST Platform, requiring only three steps:
1. Sign-up on [https://platform.ost.com](https://platform.ost.com).
2. Create your Brand Token in OST Platform.
3. Obtain an API Key and API Secret from [https://platform.ost.com/mainnet/developer](https://platform.ost.com/mainnet/developer).

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

## Getting Started

Require the Composer autoloader:

```php
require 'vendor/autoload.php';
```

Set the following variables for convenience:

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

## SDK Modules

If a user's private key is lost, they could lose access 
to their tokens. To tackle this risk, OST promotes a 
mobile-first approach and provides mobile (client) and server SDKs. 


* The server SDKs enable you to register users with OST Platform.
* The client SDKs provide the additional support required for 
the ownership and management of Brand Tokens by users so 
that they can create keys and control their tokens. 

### Users Module 

To register users with OST Platform, you can use the services provided in the Users module. 

Initialize a Users object to perform user-specific actions, like creating users:

```php
$usersService = $ostObj->services->users;
```

Create a User with OST Platform:

```php
$createParams = array();
$response = $usersService->create($createParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get User Detail:

```php
$getParams = array();
$getParams['user_id'] = '6e4bfe87-f32f-4eae-8d5b-fde08c33a955';
$response = $usersService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get Users List:

```php
$getParams = array();
//$getParams['ids'] = array('91263ebd-6b2d-4001-b732-4024430ca758', '45673ebd-6b2d-4001-b732-4024430ca758');
//$getParams['limit'] = 10;
$response = $usersService->getList($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Devices Module 

Once a user is created via the API, you can register the 
user’s device with OST Platform. Next, activate the user’s 
wallet on the user's device. Multiple devices can be 
registered per user. 


Initialize a Devices object to perform device-specific actions, 
like registering devices:

```php
$devicesService = $ostObj->services->devices;
```

Create a Device for User:

```php
$createParams = array();
$createParams['user_id'] = '90aee630-2e7c-4fff-91cc-229bc9007ffc';
$createParams['address'] = '0xbE8b3Fa4133E77e72277aF6b3Ea7BB3750511B88';
$createParams['api_signer_address'] = '0xA9C90F80F96D9b896ae5aC3248b64348984aa7bC';
$response = $devicesService->create($createParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get User Device Detail:

```php
$getParams = array();
$getParams['user_id'] = 'd194aa75-acd5-4f40-b3fb-e73a7cf7c0d9';
$getParams['device_address'] = '0x1Ea365269A3e6c8fa492eca9A531BFaC8bA1649E';
$response = $devicesService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get User Devices List:

```php
$getParams = array();
$getParams['user_id'] = 'd194aa75-acd5-4f40-b3fb-e73a7cf7c0d9';
//$getParams['pagination_identifier'] = 'eyJsYXN0RXZhbHVhdGVkS2V5Ijp7InVpZCI6eyJTIjoiZDE5NGFhNzUtYWNkNS00ZjQwLWIzZmItZTczYTdjZjdjMGQ5In0sIndhIjp7IlMiOiIweDU4YjQxMDY0NzQ4OWI4ODYzNTliNThmZTIyMjYwZWIxOTYwN2IwZjYifX19';
//$getParams['addresses'] = array("0x5906ae461eb6283cf15b0257d3206e74d83a6bd4","0xab248ef66ee49f80e75266595aa160c8c1abdd5a");
//$getParams['limit'] = 10;
$response = $devicesService->getList($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Device Managers Module

After a user is created and their device is registered via the API, 
their wallet can be activated. Activating a wallet involves the deployment of the following contracts:

* TokenHolder - each user in the economy is represented by a TokenHolder that holds the user's token balance.
* Device Manager (multi-signature) - this contract is configured to control the user's TokenHolder contract.
* DelayedRecoveryModule - this contract enables recovery in the event a key is lost.

In order to enable a user to access their tokens, i.e., interact 
with their TokenHolder contract, from multiple devices without 
having to share private keys across devices, a multi-signature 
contract is employed. We refer to this entity as the Device 
Manager in OST APIs.

To get information about a user’s Device Manager, use services provided in the Device Managers module.

```php
$deviceManagersService = $ostObj->services->deviceManagers;
```

Get Device Manager Detail:

```php
$getParams = array();
$getParams['user_id'] = 'd194aa75-acd5-4f40-b3fb-e73a7cf7c0d9';
$response = $deviceManagersService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Sessions Module

In order to create a more seamless user experience, so that users don't have to 
sign a new transaction at every move in the application, we use session keys. 
These keys are authorized to sign transactions on the user's behalf 
for a predetermined amount of time and with a defined maximum spending 
limit per transaction.

These session keys are created in a user's wallet. A user’s TokenHolder 
contract can have multiple authorized session keys.

To get information about a user’s session keys, use services provided in the Sessions module.

```php
$sessionsService = $ostObj->services->sessions;
```

Get User Session Detail:

```php
$getParams = array();
$getParams['user_id'] = 'd194aa75-acd5-4f40-b3fb-e73a7cf7c0d9';
$getParams['session_address'] = '0x1Ea365269A3e6c8fa492eca9A531BFaC8bA1649E';
$response = $sessionsService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get User Sessions List:

```php
$getParams = array();
$getParams['user_id'] = 'e50e252c-318f-44a5-b586-9a9ea1c41c15';
//$getParams['pagination_identifier'] = 'eyJsYXN0RXZhbHVhdGVkS2V5Ijp7InVpZCI6eyJTIjoiZDE5NGFhNzUtYWNkNS00ZjQwLWIzZmItZTczYTdjZjdjMGQ5In0sIndhIjp7IlMiOiIweDU4YjQxMDY0NzQ4OWI4ODYzNTliNThmZTIyMjYwZWIxOTYwN2IwZjYifX19';
//$getParams['addresses'] = array("0x5906ae461eb6283cf15b0257d3206e74d83a6bd4","0xab248ef66ee49f80e75266595aa160c8c1abdd5a");
//$getParams['limit'] = 10;
$response = $sessionsService->getList($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Executing Transactions

For executing transactions, you need to understand the 4 modules described below.

#### Rules Module

When executing a token transfer, a user's TokenHolder contract 
interacts with a token rule contract. A token economy can have 
multiple token rule contracts. To enable a user to execute a 
token transfer, you need to start with fetching details of 
registered rule contracts and understanding their methods and the 
corresponding parameters passed in those methods.

To get information about deployed rule contracts, use services provided in the Rules module.

```php
$rulesService = $ostObj->services->rules;
```

List Rules:

```php
$getParams = array();
$response = $rulesService->getList($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

#### Price Points Module

To know the OST price point in USD and when it was last updated, 
use services provided by the Price Points module.

```php
$pricePointsService = $ostObj->services->pricePoints;
```

Get Price Points Detail:

```php
$getParams = array();
$getParams['chain_id'] = '2000';
$response = $pricePointsService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```


#### Transactions Module

After reviewing the rules information received using services in the Rules 
module, you will know what data is required to execute transfers 
with a token rule using the services provided in the Transaction module.

```php
$transactionsService = $ostObj->services->transactions;
```

Execute Transaction DIRECT-TRANSFERS:

```php
//$metaPropertyParams = array();
//$metaPropertyParams['name'] = 'transaction_name'; //like, download IMP : Max length 25 characters (numbers alphabets spaces _ - allowed)
//$metaPropertyParams['type'] = 'user_to_user'; // user_to_user, company_to_user, user_to_company
//$metaPropertyParams['details'] = ''; // memo field to add additional info about the transaction .  IMP : Max length 120 characters (numbers alphabets spaces _ - allowed)

$executeParams = array();
$executeParams['user_id'] = '6e4bfe87-f32f-4eae-8d5b-fde08c33a955';
$executeParams['to'] = '0xea2dffffdddec5a6ecf208be4dc9f50cbba4a678';
$rawCallData = array();
$transferTo = array("0x121eff5d65d6861c3865c655616f53bd8957643e", "0x121eff5d65d6861c3865c655616f53bd8957643e");
$transferAmount = array("5", "5");
$rawCallData['method'] = 'directTransfers';
$rawCallData['parameters'] = array($transferTo, $transferAmount);
$executeParams['raw_calldata'] = json_encode($rawCallData);
//$executeParams['meta_property'] = $metaPropertyParams;
$response = $transactionsService->execute($executeParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Execute Transaction PAY:

```php
//$metaPropertyParams = array();
//$metaPropertyParams['name'] = 'transaction_name'; //like, download IMP : Max length 25 characters (numbers alphabets spaces _ - allowed)
//$metaPropertyParams['type'] = 'user_to_user'; // user_to_user, company_to_user, user_to_company
//$metaPropertyParams['details'] = ''; // memo field to add additional info about the transaction .  IMP : Max length 120 characters (numbers alphabets spaces _ - allowed)

$executeParams = array();
$executeParams['user_id'] = '6e4bfe87-f32f-4eae-8d5b-fde08c33a955';
$executeParams['to'] = '0xfcaab39f8d14cfa332d4b875444ce0547c90792d';
$rawCallData = array();
$transferTo = array("0x121eff5d65d6861c3865c655616f53bd8957643e", "0x121eff5d65d6861c3865c655616f53bd8957643e");
$transferAmount = array("150000000000000000", "100000000000000000");
$rawCallData['method'] = 'pay';
$tokenHolderSender = '0xa9632350057c2226c5a10418b1c3bc9acdf7e2ee';
$payCurrencyCode = 'USD';
$ostToUsdInWei = '23757000000000000'; // get price-point response
$rawCallData['parameters'] = array($tokenHolderSender, $transferTo, $transferAmount, $payCurrencyCode, $ostToUsdInWei);
$executeParams['raw_calldata'] = json_encode($rawCallData);
//$executeParams['meta_property'] = $metaPropertyParams;
$response = $transactionsService->execute($executeParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get Transaction Detail:

```php
$getParams = array();
$getParams['user_id'] = '0ed0ee05-d647-4c11-93ca-4a08702c00af';
$getParams['transaction_id'] = '14d11128-55c5-4ef5-b721-9e298cb83fb2';
$response = $transactionsService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get User Transactions:

```php
//$metaPropertyArrayParams = array();
//$metaPropertyArrayParams['name'] = 'transaction_name'; //like, download IMP : Max length 25 characters (numbers alphabets spaces _ - allowed)
//$metaPropertyArrayParams['type'] = 'user_to_user'; // user_to_user, company_to_user, user_to_company
//$metaPropertyArrayParams['details'] = 'test'; // memo field to add additional info about the transaction .  IMP : Max length 120 characters (numbers alphabets spaces _ - allowed)
//$metaPropertiesArray = array($metaPropertyArrayParams);
//$metaPropertiesArrayJsonStr = json_encode($metaPropertiesArray);

//$statusesArray = array('CREATED', 'SUBMITTED', 'SUCCESS', 'FAILED');

$getParams = array();
$getParams['user_id'] = '0ed0ee05-d647-4c11-93ca-4a08702c00af';

//$getParams['statuses'] = $statusesArray;
//$getParams['meta_properties'] = $metaPropertiesArrayJsonStr;
//$getParams['limit'] = 10;

$response = $transactionsService->getList($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

#### Balances Module

Balance services offer the functionality to view a user’s balances.

```php
$balancesService = $ostObj->services->balances;
```

Get User Balance:

```php
$getParams = array();
$getParams['user_id'] = 'd194aa75-acd5-4f40-b3fb-e73a7cf7c0d9';
$response = $balancesService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Recovery Owners Module
A user’s Brand Tokens are held by a TokenHolder contract that is controlled ("owned") 
by a Device Manager; the device manager is controlled ("owned") by device keys created 
and held by the user in their wallets; and if any of those keys is lost, the Device 
Manager (which is a multi-signature contract) is programmed to allow replacement of a 
key by the recovery owner key for the user, via the DelayedRecoveryModule, which is deployed
at the time of the creation of the user's initial wallet.

To fetch the recovery owner address for a particular user, use services provided 
in the Users module. To fetch that recovery owner's information, then services 
provided in the Recovery Owners Module are used.

```php
$recoveryOwnersService = $ostObj->services->recoveryOwners;
```

Get Recovery Owner Detail:

```php
$getParams = array();
$getParams['user_id'] = 'd194aa75-acd5-4f40-b3fb-e73a7cf7c0d9';
$getParams['recovery_owner_address'] = '0x1Ea365269A3e6c8fa492eca9A531BFaC8bA1649E';
$response = $recoveryOwnersService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Tokens Module

To get information about the Brand Token created on the OST Platform interface, use services provided 
by the Tokens module. You can use this service to obtain the chain ID of the auxiliary 
chain on which the token economy is running, in addition to other information.

```php
$tokensService = $ostObj->services->tokens;
```

Get Token Detail:

```php
$getParams = array();
$response = $tokensService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Chains Module 

To get information about the auxiliary chain on which the token economy is running, use services 
provided by the Chains module.

```php
$chainsService = $ostObj->services->chains;
```

Get Chain Detail:

```php
$getParams = array();
$getParams['chain_id'] = '2000';
$response = $chainsService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```
