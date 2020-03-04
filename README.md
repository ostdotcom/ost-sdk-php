# OST Server-Side PHP SDK
[![Build Status](https://travis-ci.org/ostdotcom/ost-sdk-php.svg?branch=develop)](https://travis-ci.org/ostdotcom/ost-sdk-php)


[OST](https://dev.ost.com/) Platform SDK for PHP.

## Introduction

OST is a complete technology solution enabling mainstream businesses 
to easily launch blockchain based economies without requiring blockchain development.

Brand Tokens (BTs) are white-label cryptocurrency tokens with utility representations
running on highly-scalable Ethereum-based utility blockchains,
backed by value token (such as OST, USDC) staked on Ethereum mainnet. Within a business`s
token economy, BTs can only be transferred to whitelisted user addresses.
This ensures that they stay within the token economy.

The OST technology stack is designed to give businesses everything they need
to integrate, test, and deploy BTs. Within the OST suite of products, developers
can use OST Platform to create, test, and launch Brand Tokens.

OST APIs and server-side SDKs make it simple and easy for developers to
integrate blockchain tokens into their apps.

For documentation, visit [https://dev.ost.com/](https://dev.ost.com/)

## Getting Started

### Setup Brand Token
1. Sign-up on [OST Platform](https://platform.ost.com) and setup your Brand Token.
2. Obtain your API Key and API Secret from [developers page](https://platform.ost.com/mainnet/developer).

### Installation
The preferred way to install the OST PHP SDK is to use latest stable version of the SDK. Simply type the following into a terminal window:

Install Composer:

```bash
    curl -sS https://getcomposer.org/installer | php
```

Install the latest stable version of the SDK:

```bash
    php composer.phar require ostdotcom/ost-sdk-php
```

## Usage

* Require the Composer autoloader.

    ```php
    require 'vendor/autoload.php';
    ```

* Initialize the SDK object.

    ```php
    // Declare connection parameters.

    /* Mandatory API parameters */

    $apiKey = '__abc'; // OBTAINED FROM DEVELOPER PAGE

    $apiSecret = '_xyz';  // OBTAINED FROM DEVELOPER PAGE

    /*
       The valid API endpoints are:
       1. Mainnet: "https://api.ost.com/mainnet/v2/"
       2. Testnet: "https://api.ost.com/testnet/v2/"
     */
    $apiBaseUrl = 'https://api.ost.com/testnet/v2/';

    /* Optional API parameters */

    // Connection timeout in seconds.
    $timeoutInSeconds = '60';

    $configParams = array();
    $configParams["timeout"] = $timeoutInSeconds;


    $params = array();
    $params['apiKey'] = $apiKey;
    $params['apiSecret'] = $apiSecret;
    $params['apiBaseUrl'] = $apiBaseUrl;
    $params["config"] = $configParams;

    $ostObj = new OSTSdk($params);
    ```

### Users Module 

* Initialize Users service object to perform user specific actions.

    ```php
    $usersService = $ostObj->services->users;
    ```

* Create User. This creates a unique identifier for each user.

    ```php
    /* Mandatory API parameters */
    // No mandatory parameters.

    $createParams = array();
    $response = $usersService->create($createParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

* Get User Detail using the userId obtained in user create.

    ```php
    /* Mandatory API parameters */

    // UserId of user for whom user details needs to be fetched.
    $userId = 'c2c__';

    $getParams = array();
    $getParams['user_id'] = $userId;

    $response = $usersService->get($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

* Get Users List. Pagination is supported in this API.

    ```php
    /* Mandatory API parameters */
    // No mandatory parameters.

    /* Optional API parameters */

    // Array of userIds for which data needs to be fetched.
    $userIdsArray = array("c2c__", "d2c__");

    // Pagination identifier from the previous API call response. Not needed for page one.
    $paginationIdentifier = 'e77y___';

    // Limit.
    $limit = 10;

    $getParams = array();
    $getParams['ids'] = $userIdsArray;
    $getParams['pagination_identifier'] = $paginationIdentifier;
    $getParams['limit'] = $limit;

    $response = $usersService->getList($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

### Devices Module

* Initialize Devices service object to perform device specific actions.

    ```php
    $devicesService = $ostObj->services->devices;
    ```

* Create a Device for User.

    ```php
    /* Mandatory API parameters */

    // UserId of user for whom device needs to be created.
    $userId = 'c2c___';

    // Device address of user's device.
    $deviceAddress = '0x1Ea___';

    // Device API signer address.
    $apiSignerAddress = '0x5F8___';

    $createParams = array();
    $createParams['user_id'] = $userId;
    $createParams['address'] = $deviceAddress;
    $createParams['api_signer_address'] = $apiSignerAddress;

    $response = $devicesService->create($createParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

* Get User Device Detail using userId and deviceAddress.

    ```php
    * Mandatory API parameters */

    // UserId of user for whom device details needs to be fetched.
    $userId = 'c2c___';

    // Device address of user's device.
    $deviceAddress = '0x1E___';

    $getParams = array();
    $getParams['user_id'] = $userId;
    $getParams['device_address'] = $deviceAddress;

    $response = $devicesService->get($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

* Get User Devices List. Pagination is supported.

    ```php
    /* Mandatory API parameters */

    // UserId of user for whom device details needs to be fetched.
    $userId = 'c2c6___';

    /* Optional API parameters */

    // Pagination identifier from the previous API call response. Not needed for page one.
    $paginationIdentifier = 'eyJ___';

    // Array of device addresses of end user.
    $deviceAddressesArray = array("0x5906ae461eb6283cf15b0257d3206e74d83a6bd4","0xab248ef66ee49f80e75266595aa160c8c1abdd5a");

    // Limit.
    $limit = 10;

    $getParams = array();
    $getParams['user_id'] = $userId;
    $getParams['pagination_identifier'] = $paginationIdentifier;
    $getParams['addresses'] = $deviceAddressesArray;
    $getParams['limit'] = $limit;

    $response = $devicesService->getList($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

### Device Managers Module

* Initialize Device Manager service object to perform device manager specific actions.

    ```php
    $deviceManagersService = $ostObj->services->deviceManagers;
    ```

* Get Device Manager Detail using userId.

    ```php
    // Mandatory API parameters

    // UserId of user for whom device manager details needs to be fetched.
    $userId = 'c2c___';

    $getParams = array();
    $getParams['user_id'] = $userId;

    $response = $deviceManagersService->get($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

### Sessions Module

* Initialize Sessions service object to perform session specific actions.

    ```php
    $sessionsService = $ostObj->services->sessions;
    ```

* Get User Session Detail using userId and session address.

    ```php
    // Mandatory API parameters

    // UserId of user for whom session details needs to be fetched.
    $userId = 'c2c___';

    // Session address of user for which details needs to be fetched.
    $sessionAddress = '0x1Ea___';

    $getParams = array();
    $getParams['user_id'] = $userId;
    $getParams['session_address'] = $sessionAddress;

    $response = $sessionsService->get($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

* Get User Sessions List using userId. Pagination is supported by this API.

    ```php
    // Mandatory API parameters

    // UserId of user for whom session details needs to be fetched.
    $userId = 'c2c___';

    // Optional API parameters

    // Pagination identifier from the previous API call response. Not needed for page one.
    $paginationIdentifier = 'eyJs___';

    // Array of session addresses of end user.
    $sessionAddressesArray = array("0x59___","0xab___");

    // Limit.
    $limit = 10;

    $getParams = array();
    $getParams['user_id'] = $userId;
    $getParams['pagination_identifier'] = $paginationIdentifier;
    $getParams['addresses'] = $sessionAddressesArray;
    $getParams['limit'] = $limit;

    $response = $sessionsService->getList($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

### Executing Transactions

For executing transactions, you need to understand the 4 modules described below.

#### Rules Module

* Initialize Rules service object to perform rules specific actions.

    ```php
    $rulesService = $ostObj->services->rules;
    ```

* List Rules.

    ```php
    /* Mandatory API parameters */
    // No mandatory parameters.

    $getParams = array();
    $response = $rulesService->getList($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

#### Price Points Module

* Initialize Price Points service object to perform price points specific actions.

    ```php
    $pricePointsService = $ostObj->services->pricePoints;
    ```

* Get Price Points Detail.

    ```php
    // Mandatory API parameters

    // ChainId of your brand token economy.
    $chainId = 2000;

    $getParams = array();
    $getParams['chain_id'] = $chainId;

    $response = $pricePointsService->get($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```


#### Transactions Module

* Initialize Transactions service object to perform transaction specific actions.

    ```php
    $transactionsService = $ostObj->services->transactions;
    ```

* DIRECT-TRANSFERS execute transaction should be used to transfer BTs to your end-users.

    ```php
    // Mandatory API parameters

    // Token holder address of receiver.
    $transferTo = array("0xa31___", "0xa32___");

    // Amount of tokens to be transferred. You might need to increase precision of PHP depending on your use-case for transferAmount.
    // Example = ini_set('precision', 25);
    $transferAmount = array("1", "1");

    // Parameters required for rule execution.
    $rawCallData = array();
    $rawCallData['method'] = 'directTransfers';
    $rawCallData['parameters'] = array($transferTo, $transferAmount);

    // Company userId.
    $companyUserId = "ee89___";

    // Address of DirectTransfer rule. Use list rules API of Rules module to get the address of rules.
    // In the rules array which you will get in response, use the address having name "Direct Transfer".
    $directTransferRuleAddress = "0xe379___";

    // Optional API parameters

    // Name of the transaction. Eg. 'like', 'download', etc.
    // NOTE: Max length 25 characters (Allowed characters: [A-Za-z0-9_/s])
    $transactionName = 'like';

    // Transaction type. Possible values: 'company_to_user', 'user_to_user', 'user_to_company'.
    $transactionType = 'user_to_user';

    // Some extra information about transaction.
    // NOTE: Max length 125 characters (Allowed characters: [A-Za-z0-9_/s])
    $details = 'lorem_ipsum';

    // Additional transaction information. There is no dependency between any of the metaProperty keys.
    // However, if a key is present, its value cannot be null or undefined.
    $metaPropertyParams = array();
    $metaPropertyParams['name'] = $transactionName;
    $metaPropertyParams['type'] = $transactionType;
    $metaPropertyParams['details'] = $details;

    $executeParams = array();
    $executeParams['user_id'] = $companyUserId;
    $executeParams['to'] = $directTransferRuleAddress;
    $executeParams['raw_calldata'] = json_encode($rawCallData);
    $executeParams['meta_property'] = $metaPropertyParams;

    $response = $transactionsService->execute($executeParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

* PAY Execute Transaction should be used when transactions of BTs equivalent to some fiat amount need to be executed.

    ```php
    // Mandatory API parameters

    // Token holder address of receiver.
    $transferToAddress = '0xa31__';

    // Company token holder address.
    $companyTokenHolderAddress = '0xa963___';

    // Pay currency code. Supported currency codes are 'USD', 'EUR' and 'GBP'.
    $payCurrencyCode = 'USD';

    // In pay transaction, the transfer amounts are in pay currency (fiat currency like USD) which then are converted
    // into tokens. Use get price point detail API of Price Points module to get this value.
    $pricePoint = 0.020606673;

    // Price point needs to be passed in atto. Multiply the price point with 10^18. Also, this value should be a string. 
    // You might need to increase precision of PHP depending on your use-case. Example = ini_set('precision', 25);
    $intendedPricePointInAtto = (string)($pricePoint * 10**18);

    // Amount of Fiat to be transferred.
    $transferAmountInFiat = 0.1;

    // Transfer amount in wei needs to be passed in atto. Multiply the fiat transfer amount with 10^18. Also, this value should be a string. 
    // You might need to increase precision of PHP depending on your use-case. Example = ini_set('precision', 25);
    $fiatTransferAmountInAtto = (string)($transferAmountInFiat * 10**18);;

    // Parameters required for rule execution.
    $rawCallData = array();
    $rawCallData['method'] = 'pay';
    $rawCallData['parameters'] = array($companyTokenHolderAddress, array($transferToAddress), array($fiatTransferAmountInAtto), $payCurrencyCode, $intendedPricePointInAtto);

    // Company userId.
    $companyUserId = 'ee8___';

    // Address of Pay rule. Use list rules API to get the address of rules.
    // In the rules array which you will get in response, use the address having name "Pricer".
    $payRuleAddress = '0xe37___';

    // Optional API parameters

    // Name of the transaction. Eg. 'like', 'download', etc.
    // NOTE: Max length 25 characters (Allowed characters: [A-Za-z0-9_/s])
    $transactionName = 'like';

    // Transaction type. Possible values: 'company_to_user', 'user_to_user', 'user_to_company'.
    $transactionType = 'company_to_user';

    // Some extra information about transaction.
    // NOTE: Max length 125 characters (Allowed characters: [A-Za-z0-9_/s])
    $details = 'lorem_ipsum';

    // Additional transaction information. There is no dependency between any of the metaProperty keys.
    // However, if a key is present, its value cannot be null or undefined.

    $metaPropertyParams = array();
    $metaPropertyParams['name'] = $transactionName;
    $metaPropertyParams['type'] = $transactionType;
    $metaPropertyParams['details'] = $details;

    $executeParams = array();
    $executeParams['user_id'] = $companyUserId;
    $executeParams['to'] = $payRuleAddress;
    $executeParams['raw_calldata'] = json_encode($rawCallData);
    $executeParams['meta_property'] = $metaPropertyParams;

    $response = $transactionsService->execute($executeParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

* Get Transaction Detail using userId and transactionId.

    ```php
    // Mandatory API parameters

    // UserId of end-user.
    $userId = 'ee8___';

    // Unique identifier of the transaction to be retrieved.
    $transactionId = 'f1d___';

    $getParams = array();
    $getParams['user_id'] = $userId;
    $getParams['transaction_id'] = $transactionId;
    $response = $transactionsService->get($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

* Get User Transactions using userId. Pagination is supported by this API.

    ```php
    // Mandatory API parameters

    // UserId of end-user.
    $userId = 'ee89___';

    // Optional API parameters

    // Array of status values.
    $statusesArray = array('CREATED', 'SUBMITTED', 'SUCCESS', 'FAILED');
  
    // To get transactions between a specific time interval, add start timestamp and end timestamp. 
    $startTime = 1563260786;
    $endTime = 1563280786;

    // Name of the transaction. Eg. 'like', 'download', etc.
    // NOTE: Max length 25 characters (Allowed characters: [A-Za-z0-9_/s])
    $transactionName = 'like';

    // Transaction type. Possible values: 'company_to_user', 'user_to_user', 'user_to_company'.
    $transactionType = 'company_to_user';

    // NOTE: Max length 125 characters (Allowed characters: [A-Za-z0-9_/s])
    $details = 'lorem_ipsum';

    // Additional transaction information. There is no dependency between any of the metaProperty keys.
    // However, if a key is present, its value cannot be null or undefined.
    $metaPropertyArrayParams = array();
    $metaPropertyArrayParams['name'] = $transactionName;
    $metaPropertyArrayParams['type'] = $transactionType;
    $metaPropertyArrayParams['details'] = $details;
    $metaPropertiesArray = array($metaPropertyArrayParams);
    $metaPropertiesArrayJsonStr = json_encode($metaPropertiesArray);

    // Limit.
    $limit = 10;

    // Pagination identifier from the previous API call response.  Not needed for page one.
    $paginationIdentifier = 'eyJsY___';

    $getParams = array();
    $getParams['user_id'] = $userId;
    $getParams['start_time'] = $startTime;
    $getParams['end_time'] = $endTime;
    $getParams['statuses'] = $statusesArray;
    $getParams['meta_properties'] = $metaPropertiesArrayJsonStr;
    $getParams['limit'] = $limit;
    $getParams['pagination_identifier'] = $paginationIdentifier;

    $response = $transactionsService->getList($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

#### Balances Module

* Initialize Balances service object to perform balances specific actions.

    ```php
    $balancesService = $ostObj->services->balances;
    ```

* Get User Balance using userId.

    ```php
    // Mandatory API parameters

    // UserId for whom balance needs to be fetched.
    $userId = 'c2c6___';
    $getParams = array();
    $getParams['user_id'] = $userId;

    $response = $balancesService->get($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

### Recovery Owners Module

* Initialize Recovery Owners service object to perform recovery owners specific actions.

    ```php
    $recoveryOwnersService = $ostObj->services->recoveryOwners;
    ```

* Get Recovery Owner Detail using userId and recovery owner address.

    ```php
    // Mandatory API parameters

    // UserId for whom recovery details needs to be fetched.
    $userId = 'c2c___';

    // Recovery address of user.
    $recoveryOwnerAddress = '0xe37___';

    $getParams = array();
    $getParams['user_id'] = $userId;
    $getParams['recovery_owner_address'] = $recoveryOwnerAddress;

    $response = $recoveryOwnersService->get($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

### Tokens Module

* Initialize Tokens service object to perform tokens specific actions.

    ```php
    $tokensService = $ostObj->services->tokens;
    ```

* Get Token Detail.

    ```php
    /* Mandatory API parameters */
    // No mandatory parameters.

    $getParams = array();
    $response = $tokensService->get($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

### Chains Module

* Initialize Chains service object to perform chains specific actions.

    ```php
    $chainsService = $ostObj->services->chains;
    ```

* Get Chain Detail using chainId.

    ```php
    // Mandatory API parameters

    // ChainId for which details needs to be fetched. Only origin chainId and OST-specific auxiliary chainIds are allowed.
    $chainId = '2000';

    $getParams = array();
    $getParams['chain_id'] = $chainId;
    $response = $chainsService->get($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

### Base Tokens Module

* Initialize Base Tokens service object to perform base tokens specific actions.

    ```php
    $baseTokensService = $ostObj->services->baseTokens;
    ```

* Get Base Tokens Detail.

    ```php
    /* Mandatory API parameters */
    // No mandatory parameters.

    $getParams = array();
    $response = $baseTokensService->get($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

### Webhooks Module

* Initialize Webhooks service object to perform webhooks specific actions.

    ```php
    $webhooksService = $ostObj->services->webhooks;
    ```

* Create Webhook using the topics and the subscription url.

    ```php
    // Mandatory API parameters

    // Array of topics.
    $topicParams = array("transactions/initiate", "transactions/success");

    // URL where you want to receive the event notifications.
    $url = 'https://www.testingWebhooks.com';

    // Optional API parameters

    // Status of a webhook. Possible values are 'active' and 'inactive'.
    $status = 'active';

    $createParams = array();
    $createParams['topics'] =  $topicParams;
    $createParams['url'] =  $url;
    $createParams['status'] =  $status;

    $response = $webhooksService->create($createParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

* Update existing Webhook using a webhookId and an array of topics.

    ```php
    // Mandatory API parameters

    // Array of topics.
    $topicParams = array("transactions/initiate", "transactions/success", "transactions/failure");

    // Unique identifier for a webhook.
    $webhookId = 'a743___';

    // Optional API parameters

    // Status of a webhook. Possible values are 'active' and 'inactive'.
    $status = 'active';

    $updateParams = array();
    $updateParams['webhook_id'] = $webhookId;
    $updateParams['topics'] =  $topicParams;
    $updateParams['status'] =  $status;

    $response = $webhooksService->update($updateParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

* Get Webhook using webhookId.

    ```php
    // Mandatory API parameters

    // Unique identifier for a webhook.
    $webhookId = 'a743___';

    $getParams = array();
    $getParams['webhook_id'] = $webhookId;

    $response = $webhooksService->get($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

* Get Webhook List. Pagination is supported by this API.

    ```php
    // Mandatory API parameters
    // No mandatory parameters.

    // Optional API parameters

    // Limit.
    $limit = 10;

    // Pagination identifier from the previous API call response.  Not needed for page one.
    $paginationIdentifier = 'eyJwY___';

    $getParams = array();
    $getParams['limit'] = $limit;
    $getParams['pagination_identifier'] = $paginationIdentifier;

    $response = $webhooksService->getList($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

* Delete Webhook using webhookId.

    ```php
    // Mandatory API parameters

    // Unique identifier for a webhook.
    $webhookId = 'a743___';

    $deleteParams = array();
    $deleteParams['webhook_id'] = $webhookId;

    $response = $webhooksService->delete($deleteParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

* Verify webhook request signature. This can be used to validate if the webhook received at your end from OST platform is correctly signed.

    ```php
    // Webhook data obtained.
    $webhookEventData = {"id":"54e3cd1c-afd7-4dcf-9c78-137c56a53582","topic":"transactions/success","created_at":1560838772,"webhook_id":"0823a4ea-5d87-44cf-8ca8-1e5a31bf8e46","version":"v2","data":{"result_type":"transaction","transaction":{"id":"ddebe817-b94f-4b51-9227-f543fae4715a","transaction_hash":"0x7ee737db22b58dc4da3f4ea4830ca709b388d84f31e77106cb79ee09fc6448f9","from":"0x69a581096dbddf6d1e0fff7ebc1254bb7a2647c6","to":"0xc2f0dde92f6f3a3cb13bfff43e2bd136f7dcfe47","nonce":3,"value":"0","gas_price":"1000000000","gas_used":120558,"transaction_fee":"120558000000000","block_confirmation":24,"status":"SUCCESS","updated_timestamp":1560838699,"block_timestamp":1560838698,"block_number":1554246,"rule_name":"Pricer","meta_property":{},"transfers":[{"from":"0xc2f0dde92f6f3a3cb13bfff43e2bd136f7dcfe47","from_user_id":"acfdea7d-278e-4ffc-aacb-4a21398a280c","to":"0x0a754aaab96d634337aac6556312de396a0ca46a","to_user_id":"7bc8e0bd-6761-4604-8f8e-e33f86f81309","amount":"112325386","kind":"transfer"}]}}}

    // Get webhoook version from webhook events data.
    $version = "v2";

    // Get ost-timestamp from the response received in event.
    $requestTimestamp = '1559902637';

    // Get signature from the response received in event.
    $signature = '2c56c143550c603a6ff47054803f03ee4755c9c707986ae27f7ca1dd1c92a824';

    $webhookSecret = 'mySecret';

    $params = array();
    $params["version"] = $version;
    $params["stringified_data"] = json_encode($webhookEventData);
    $params["request_timestamp"] = $requestTimestamp;
    $params["signature"] = $signature;
    $params["webhook_secret"] = $webhookSecret;

    $response = $webhooksService->verifySignature($params);
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

  
### Redemption Modules

Two modules of redemption, "Redeemable SKUs" and "User Redemptions", are described below.

#### Redeemable SKUs Module

* Initialize Redeemable SKUs service object to perform redeemable skus specific actions.

    ```php
    $redeemableSkusService = $ostObj->services->redeemableSkus;
    ```
  
* Get Redeemable SKU detail using the redeemable sku id.

    ```php
    // Mandatory API parameters

    // Fetch details of following redeemable sku.
    $redeemableSkuId = '1';
    
    $getParams = array();
    $getParams['redeemable_sku_id'] = $redeemableSkuId;
    $response = $redeemableSkusService->get($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

* Get Redeemable SKUs List. Pagination is supported by this API.

    ```php
    // Mandatory API parameters
    // NOTE: No mandatory parameters.
  
    // Optional API parameters
  
    // Limit.
    $limit = 10;

    // Array of redeemable SKU ids.
    $redeemableSkuIds =  array('1', '2');

    // Pagination identifier from the previous API call response.  Not needed for page one.
    $paginationIdentifier = 'eyJsY___';
 
    $getParams = array();
    $getParams['redeemable_sku_ids'] = $redeemableSkuIds;
    $getParams['limit'] = $limit;
    $getParams['pagination_identifier'] = $paginationIdentifier;
    
    $response = $redeemableSkusService->getList($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```
  
#### User Redemptions Module

* Initialize Redemptions service object to perform user redemption specific actions.

    ```php
    $redemptionsService = $ostObj->services->redemptions;
    ```

* Get User redemption details using the userId and redemptionId.

    ```php
    // Mandatory API parameters
  
    // UserId of user for whom redemption details needs to be fetched.
    $userId = 'ee8___';
  
    // Unique identifier of the redemption of user.
    $redemptionId = 'aa___';
    
    $getParams = array();
    $getParams['user_id'] = $userId;
    $getParams['redemption_id'] = $redemptionId;
    $response = $redemptionsService->get($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```

* Get User Redemptions List. Pagination is supported by this API.

    ```php
    // Mandatory API parameters
    $userId = 'ee89___';
    
    // Optional API parameters
    
    // Limit.
    $limit = 10;
  
    // Array of user redemption uuids.
    $redemptionIds = array('a743___', 'a743___');
    
    // Pagination identifier from the previous API call response.  Not needed for page one.
    $paginationIdentifier = 'eyJsY___';
      
    $getParams = array();
    $getParams['user_id'] = $userId;
    $getParams['redemption_ids'] = $redemptionIds;
    $getParams['limit'] = $limit;
    $getParams['pagination_identifier'] = $paginationIdentifier;
    
    $response = $redemptionsService->getList($getParams)->wait();
    echo json_encode($response, JSON_PRETTY_PRINT);
    ```