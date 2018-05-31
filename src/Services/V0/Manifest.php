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
  public function __construct(array $params)
  {

    $requestObj = new \Lib\Request($params);

    // Define services available in V0
    $this->user = new User($requestObj);
    $this->transactionKind = new TransactionKind($requestObj);

  }

}
