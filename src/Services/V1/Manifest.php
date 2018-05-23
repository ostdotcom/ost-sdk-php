<?php
/**
 * contains Manifest class
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

    // Define services available in V1
    $this->users = new Users($this->requestObj);
    $this->actions = new Actions($this->requestObj);
    $this->airdrops = new Airdrops($this->requestObj);
    $this->token = new Token($this->requestObj);
    $this->transactions = new Transactions($this->requestObj);
    $this->transfers = new Transfers($this->requestObj);

  }

}
