<?php
/**
 * contains Manifest class
 */

namespace OST\V0;

/**
 * Class providing public vars to interact with V0 API's for different modules
 */
class Manifest
{

  /** @var object object which has methods to fire API's belonging to User module */
  public
    $user;

  /** @var object object which has methods to fire API's belonging to TransactionKind module */
  public
    $transactionKind;

  /** @var object object which would fire HTTP requests */
  private
    $requestObj;

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

    $this->requestObj = new \Lib\Request($params);

    // Define services available in V0
    $this->user = new User($this->requestObj);
    $this->transactionKind = new TransactionKind($this->requestObj);

  }

}
