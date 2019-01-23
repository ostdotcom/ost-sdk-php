<?php
/**
 * Manifest class
 */

namespace OST;

use Lib\Request;

use OST\Token;

/**
 * Class providing public vars to interact with API's for different modules
 */
class Manifest
{
    /** @var Token object which has methods to fire API's belonging to Token module */
    public $token;

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

    $this->token = new Token($requestObj);

  }

}
