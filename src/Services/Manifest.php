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
    /** @var Tokens object which has methods to fire API's belonging to Token module */
    public $tokens;

    /** @var Users object which has methods to fire API's belonging to User module */
    public $users;

    /** @var Devices object which has methods to fire API's belonging to Device module */
    public $devices;

    /** @var Session object which has methods to fire API's belonging to Session module */
    public $sessions;

    /** @var DeviceManagers object which has methods to fire API's belonging to DeviceManager module */
    public $deviceManagers;

    /** @var TokenHolders object which has methods to fire API's belonging to TokenHolder module */
    public $tokenHolders;

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

    $this->tokens = new Tokens($requestObj);

    $this->users = new Users($requestObj);

    $this->devices = new Devices($requestObj);

    $this->sessions = new Sessions($requestObj);

    $this->deviceManagers = new DeviceManagers($requestObj);

    $this->tokenHolders = new TokenHolders($requestObj);

  }

}
