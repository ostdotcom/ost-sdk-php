# OST PHP SDK
[![Build Status](https://travis-ci.org/OpenSTFoundation/ost-sdk-php.svg?branch=master)](https://travis-ci.org/OpenSTFoundation/ost-sdk-php)

The official [OST PHP SDK](https://dev.ost.com/).

## Introduction

OST is a complete technology solution enabling mainstream businesses 
to easily launch blockchain-based economies at low risk and without 
requiring blockchain development.

At the core of OST is the concept of OST-powered Brand Tokens (BTs). 
BTs are white-label cryptocurrency tokens running on highly scalable 
Ethereum-based side blockchains, backed by staking OST Tokens into smart 
contracts on Ethereum mainnet. BTs can only be transferred to whitelisted 
user addresses within a business’s community. This ensures that they stay 
within a specific BT community.

The OST technology stack is designed to give businesses everything they need 
to integrate, test, and deploy BTs.Within the OST suite of products developers 
can use OST KIT to create, test and launch Branded Tokens backed by OST. 

OST APIs and Server Side SDKs make it simple and easy for developers to 
integrate blockchain tokens into their apps.

## Advantages

Using the OST SDKs provides a number of advantages
* Simplicity: The SDKs reduce the complexity of integration by handling multiple authentication scenarios automatically. This means that the appropriate method call will be to minimize the end-user interactions.
* Performance: Caching, key management and nonce management ensure that end-users overall experience is improved.
* Security: Separating the Server Side API interactions from the client ensures that user's private keys are generated and stored securely on the user's device and not shared across the network.


## Requirements

Integrating OST SDK into your application can begin as soon as you create an account, 
with OST KIT requiring only three steps:
1. Sign-up on [https://kit.ost.com](https://kit.ost.com).
2. Create your branded token in OST KIT.
3. Obtain an API Key and API Secret from [https://kit.ost.com/mainnet/developer](https://kit.ost.com/mainnet/developer).

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

Set the following variables for convenience :

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

### Users Module 

Given that Brand Tokens are valuable to users,  if their private 
keys are compromised it could result in the user being unable to 
access their tokens. To tackle this OST promotes a mobile-first 
approach and provides mobile(client) and server SDKs. 


* The server SDKs enable you to register users with KIT server.
* The client SDKs provides the additional support required for 
the ownership and management of Brand Tokens by end users so 
that they can create keys and control their tokens. 

To register user with KIT you can use the services provided in user module. 

Initialize a Users object to perform user specific actions, like creating users:

```php
$userService = $ostObj->services->users;
```

Creating a user with KIT:

```php
$createParams = array();
$response = $userService->create($createParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get User Detail:

```php
$getParams = array();
$getParams['user_id'] = '6e4bfe87-f32f-4eae-8d5b-fde08c33a955';
$response = $userService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get User List:

```php
$getParams = array();
//$getParams['ids'] = array('91263ebd-6b2d-4001-b732-4024430ca758', '45673ebd-6b2d-4001-b732-4024430ca758');
//$getParams['limit'] = 10;
$response = $userService->getList($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Devices Module 

Once a user is created via API, partner company should register 
user’s device with KIT.  Post which they can activate user’s 
wallet on their device. Partner company can register multiple 
devices per user. 


Initialize a Device object to perform device specific actions, 
like registering devices:

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
//$getParams['limit'] = 10;
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

### Device Managers Module

After  user is created and their device is registered via API,  
a wallet can be activated. Activating a wallet involves the deployment of :

* TokenHolder contract - each user in the economy is be represented by this smart contract on blockchain.  It holde the user's balances.
* Device Manager (Multisig contract) - This contract is configured to control the user's TokenHolder contract.
* DelayedRecoveryModule contract - that supports recovery via a 6 digit PIN. 

In order to enable user to access their tokens i.e their TokenHolder contract 
from multiple devices without having to share private keys across devices we 
came up with a multi-signature contract. We refer to this entity as device 
manager in OST APIs.

To get information about user’s device manager use services provided in device manager module.

```php
$deviceManagersService = $ostObj->services->deviceManagers;
```

Get Token Detail:

```php
$getParams = array();
$getParams['user_id'] = 'd194aa75-acd5-4f40-b3fb-e73a7cf7c0d9';
$response = $deviceManagersService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Session Module

In order to create a seamless user experience so that users don't have to 
sign a new transaction at every move in the application we came up with 
the concept of sessionKeys. These keys are used to sign messages on user's 
behalf for a predetermined amount of time and with a defined maximum spending 
limit per-transaction.

These keys are created on the mobile device from where the end user participates 
in the economy. Each key has a corresponding public key, which in-turn has a 
corresponding public address. User’s TokenHolder contract can have multiple 
sessionKeys for signing messages on user’s behalf.

To get information about user’s session keys use services provided in session module.

```php
$sessionService = $ostObj->services->sessions;
```

Get User Session(s) List:

```php
$getParams = array();
$getParams['user_id'] = 'e50e252c-318f-44a5-b586-9a9ea1c41c15';
//$getParams['pagination_identifier'] = 'eyJsYXN0RXZhbHVhdGVkS2V5Ijp7InVpZCI6eyJTIjoiZDE5NGFhNzUtYWNkNS00ZjQwLWIzZmItZTczYTdjZjdjMGQ5In0sIndhIjp7IlMiOiIweDU4YjQxMDY0NzQ4OWI4ODYzNTliNThmZTIyMjYwZWIxOTYwN2IwZjYifX19';
//$getParams['addresses'] = array("0x5906ae461eb6283cf15b0257d3206e74d83a6bd4","0xab248ef66ee49f80e75266595aa160c8c1abdd5a");
//$getParams['limit'] = 10;
$response = $sessionService->getList($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get User Session:

```php
$getParams = array();
$getParams['user_id'] = 'd194aa75-acd5-4f40-b3fb-e73a7cf7c0d9';
$getParams['session_address'] = '0x1Ea365269A3e6c8fa492eca9A531BFaC8bA1649E';
$response = $sessionService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

## For executing transactions we need to understand 3 modules listed below :
To enable partner companies to design Rules that align with their economy goals 
and define the behavior of the token transfer, they have the flexibility to 
write their custom rules contract. OST has written one rule contract the 
[PricerRule Contract](https://github.com/OpenSTFoundation/openst-contracts/blob/develop/contracts/rules/PricerRule.sol) 
for partner companies to use.

For executing a token transfer, end-user's TokenHolder contract interacts with Rules Contract.

### Rules Module

So for executing a token transfer, partner company need to start with fetching details of 
deployed rules contract and understand the methods written within them and the corresponding 
parameters passed in those methods.

To get information about rules contracts deployed use services provided in rule module.

```php
$rulesService = $ostObj->services->rules;
```

List all Rules:

```php
$getParams = array();
$response = $rulesService->getList($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Transactions Module

Once you’ve fetched the rule method and rule parameters to be passed using services 
in rule module you can start with executing the transfer using the services provided 
in transaction module.

```php
$transactionService = $ostObj->services->transactions;
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
//$executeParams['meta_property', $metaPropertyParams];
$response = $transactionService->execute($executeParams)->wait();
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
//$executeParams['meta_property', $metaPropertyParams];
$response = $transactionService->execute($executeParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get a transaction info:

```php
$getParams = array();
$getParams['user_id'] = '0ed0ee05-d647-4c11-93ca-4a08702c00af';
$getParams['transaction_id'] = '14d11128-55c5-4ef5-b721-9e298cb83fb2';
$response = $transactionService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

Get all transactions for a user:

```php
//$metaPropertyArrayParams = array();
//$metaPropertyArrayParams['name'] = 'transaction_name'; //like, download IMP : Max length 25 characters (numbers alphabets spaces _ - allowed)
//$metaPropertyArrayParams['type'] = 'user_to_user'; // user_to_user, company_to_user, user_to_company
//$metaPropertyArrayParams['details'] = 'test'; // memo field to add additional info about the transaction .  IMP : Max length 120 characters (numbers alphabets spaces _ - allowed)
//$metaPropertyArray = array($metaPropertyArrayParams);
//$metaPropertyArrayJsonStr = json_encode($metaPropertyArray);

//$statusArray = array('CREATED', 'SUBMITTED', 'SUCCESS', 'FAILED');

$getParams = array();
$getParams['user_id'] = '0ed0ee05-d647-4c11-93ca-4a08702c00af';

//$getParams['status'] = $statusArray;
//$getParams['meta_property'] = $metaPropertyArrayJsonStr;
//$getParams['limit'] = 10;

$response = $transactionService->getList($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Balances Module

Balance services offer the functionality to view user’s balances.

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

### Recovery Owners Module
End user’s brand tokens are held by a token holder contract that is controlled ("owned") 
by device manager; the device manager  is controlled ("owned") by device keys created 
and held by the user in their wallets; and if those keys are compromised, the device 
manager (which is a multi-signature contract) is programmed to allow replacement of a 
key by a recovery key.

The DelayedRecoveryModule is deployed at the time of the creation of the wallet. The 
recoveryOwner public-private key pair is created using inputs from the Partner, OST 
and the user. The public addresse of the recoveryOwner is stored on this DelayedRecoveryModule 
contract.

Recovering access to tokens after the owner key becomes compromised

User requests recovery from partner company application by entering their 6-digit 
recovery PIN. Once the request has been raised user waits for defined delay which 
is 12 hours currently.

OST wallet SDK Create the recoveryOwner private key using the inputs from the Partner, 
OST and the user.  This should exactly match the recoveryOwner that was made when the 
wallet was initially created. 

To fetch the recoveryOwner address for a particular user services provided in Recovery 
Owner Module are used.

```php
$recoveryOwnersService = $ostObj->services->recoveryOwners;
```

Get Token Detail:

```php
$getParams = array();
$getParams['user_id'] = 'd194aa75-acd5-4f40-b3fb-e73a7cf7c0d9';
$getParams['recovery_owner_address'] = '0x1Ea365269A3e6c8fa492eca9A531BFaC8bA1649E';
$response = $recoveryOwnersService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Tokens Module

To get information about the token created on the OST KIT interface use services provided 
by token module. Partner company can use this service to know the chain id , the auxiliary 
chain on which their economy is running apart from other information.

```php
$tokenService = $ostObj->services->tokens;
```

Get Token Detail:

```php
$getParams = array();
$response = $tokenService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```

### Chains Module 

To get information about the auxiliary chain on which the token economy is running use services 
provided by chain module.

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

### Price Points Module

To know the OST price point in USD and the last timestamp when it was updateds 
use services provided by Price Point module.

```php
$pricePointsService = $ostObj->services->pricePoints;
```

Get 

```php
$getParams = array();
$getParams['chain_id'] = '2000';
$response = $pricePointsService->get($getParams)->wait();
echo json_encode($response, JSON_PRETTY_PRINT);
```
