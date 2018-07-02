<?php
/**
 * Manifest class
 */

namespace OST\V1_1;

use Lib\Request;

use OST\V1\Users;
use OST\V1\Actions;
use OST\V1\Airdrops;
use OST\V1\Token;
use OST\V1\Transactions;
use OST\V1\Transfers;

/**
 * Class providing public vars to interact with V1 API's for different modules
 */
class Manifest
{
    /** @var Users object which has methods to fire API's belonging to User module */
    public $users;

    /** @var Actions object which has methods to fire API's belonging to Actions module */
    public $actions;

    /** @var Airdrops object which has methods to fire API's belonging to Airdrops module */
    public $airdrops;

    /** @var Token object which has methods to fire API's belonging to Token module */
    public $token;

    /** @var Transactions object which has methods to fire API's belonging to Transactions module */
    public $transactions;

    /** @var Transfers object which has methods to fire API's belonging to Transfers module */
    public $transfers;

    /** @var Balances object which has methods to fire API's belonging to Balances module */
    public $balances;

    /** @var Ledger object which has methods to fire API's belonging to Ledger module */
    public $ledger;

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

    // Define services available in V1
    $this->users = new Users($requestObj);
    $this->actions = new Actions($requestObj);
    $this->airdrops = new Airdrops($requestObj);
    $this->token = new Token($requestObj);
    $this->transactions = new Transactions($requestObj);
    $this->transfers = new Transfers($requestObj);

    // Define services available in V1.1
    $this->balances = new Balances($requestObj);
    $this->ledger = new Ledger($requestObj);

  }

}
