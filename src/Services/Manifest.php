<?php
/**
 * Manifest class
 */

namespace OST;

use Lib\Request;

/**
 * Class providing public vars to interact with API's for different modules
 */
class Manifest

{

    /** @var Balances object which has methods to fire API's belonging to Balance module */
    public $balances;

    /** @var Chains object which has methods to fire API's belonging to Chains module */
    public $chains;

    /** @var DeviceManagers object which has methods to fire API's belonging to DeviceManagers module */
    public $deviceManagers;

    /** @var Devices object which has methods to fire API's belonging to Device module */
    public $devices;

    /** @var PricePoints object which has methods to fire API's belonging to PricePoints module */
    public $pricePoints;

    /** @var RecoveryOwners object which has methods to fire API's belonging to RecoveryOwners module */
    public $recoveryOwners;

    /** @var Redemptions object which has methods to fire API's belonging to Redemptions module */
    public $redemptions;

    /** @var RedeemableSkus object which has methods to fire API's belonging to RedeemableSkus module */
    public $redeemableSkus;

    /** @var Rules object which has methods to fire API's belonging to Rules module */
    public $rules;

    /** @var Session object which has methods to fire API's belonging to Session module */
    public $sessions;

    /** @var Tokens object which has methods to fire API's belonging to Token module */
    public $tokens;

    /** @var Transaction object which has methods to fire API's belonging to Transaction module */
    public $transactions;

    /** @var Users object which has methods to fire API's belonging to User module */
    public $users;

    /** @var BaseTokens object which has methods to fire API's belonging to Base Tokens module */
    public $baseTokens;

    /** @var Webhooks object which has methods to fire API's belonging to Webhook module */
    public $webhooks;


  /**
   * Constructor
   *
   * @param array $params Array containing the necessary params {
   *      @type string $apiKey API Key.
   *      @type string $apiSecret API Secret.
   *      @type string $baseUrl Base API URL.
   * }
   *
   * @throws \Exception
   *
   */
  public function __construct($params)
  {

    $requestObj = new Request($params);

    $this->balances = new Balances($requestObj);

    $this->chains = new Chains($requestObj);

    $this->deviceManagers = new DeviceManagers($requestObj);

    $this->devices = new Devices($requestObj);

    $this->pricePoints = new PricePoints($requestObj);

    $this->recoveryOwners = new RecoveryOwners($requestObj);

    $this->redemptions = new Redemptions($requestObj);

    $this->redeemableSkus = new RedeemableSkus($requestObj);

    $this->rules = new Rules($requestObj);

    $this->sessions = new Sessions($requestObj);

    $this->tokens = new Tokens($requestObj);

    $this ->transactions = new Transactions($requestObj);

    $this->users = new Users($requestObj);

    $this->baseTokens = new BaseTokens($requestObj);

    $this->webhooks = new Webhooks($requestObj);

  }

}
