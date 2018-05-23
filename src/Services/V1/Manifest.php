<?php
/**
 * Manifest class
 */
namespace OST\V1;

/**
 * Class providing public vars to interact with V1 API's for different modules
 */
class Manifest
{

  /** @var object object which has methods to fire API's belonging to User module */
  public
    $users;

  /** @var object object which has methods to fire API's belonging to Actions module */
  public
    $actions;

  /** @var object object which has methods to fire API's belonging to Airdrops module */
  public
    $airdrops;

  /** @var object object which has methods to fire API's belonging to Token module */
  public
    $token;

  /** @var object object which has methods to fire API's belonging to Transactions module */
  public
    $transactions;

  /** @var object object which has methods to fire API's belonging to Transfers module */
  public
    $transfers;

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

    $requestObj = new \Lib\Request($params);

    // Define services available in V1
    $this->users = new Users($requestObj);
    $this->actions = new Actions($requestObj);
    $this->airdrops = new Airdrops($requestObj);
    $this->token = new Token($requestObj);
    $this->transactions = new Transactions($requestObj);
    $this->transfers = new Transfers($requestObj);

  }

}
