<?php
/**
 * Airdrops class
 */

namespace OST\V1;

use Lib\Request;

/**
 * Class encapsulating methods to interact with V1 API's for Airdrops module
 */
class Airdrops extends \OST\Base
{

  /**
   * Constructor
   *
   * @param object $requestObj request object which would fire API calls
   *
   */
  public function __construct(Request $requestObj)
  {
    parent::__construct($requestObj, '/airdrops');
  }

  /**
   * Execute an airdrop
   *
   * @param array $params params for executing an airdrop
   *
   * @return object
   *
   */
  public function execute(array $params = array()) {
    return $this->requestObj->post($this->urlPrefix . '/', $params);
  }

  /**
   * List airdrops
   *
   * @param array $params params for fetching airdrops list
   *
   * @return object
   *
   */
  public function getList(array $params = array()) {
    return $this->requestObj->get($this->urlPrefix . '/', $params);
  }

  /**
   * Get airdrop details
   *
   * @param array $params params for fetching details of an airdrop
   *
   * @throws \Exception
   *
   * @return object
   *
   */
  public function get(array $params = array()) {
    return $this->requestObj->get($this->urlPrefix . '/' . $this->getId($params) . '/', $params);
  }

}
