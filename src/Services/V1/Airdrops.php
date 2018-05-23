<?php
/**
 * contains Airdrops class
 */

namespace OST\V1;

/**
 * Class encapsulating methods to interact with V0 API's for Airdrops module
 */
class Airdrops extends \OST\Base
{

  /**
   * Constructor
   *
   * @param object $requestObj request object which would fire API calls
   *
   */
  public function __construct($requestObj)
  {
    parent::__construct($requestObj, '/airdrops');
  }

  /**
   * Execute an airdrop
   *
   * @param array $params params for executing an airdrop
   *
   * @throws \Exception
   *
   * @return object
   *
   */
  public function execute($params = array()) {
    return $this->requestObj->post($this->urlPrefix . '/', $params);
  }

  /**
   * List airdrops
   *
   * @param array $params params for fetching airdrops list
   *
   * @throws \Exception
   *
   * @return object
   *
   */
  public function getList($params = array()) {
    return $this->requestObj->get($this->urlPrefix . '/', $params);
  }

  /**
   * Get airdrop details
   *
   * @param array $params params for fetching details of a airdrop
   *
   * @throws \Exception
   *
   * @return object
   *
   */
  public function get($params = array()) {
    return $this->requestObj->get($this->urlPrefix . '/' . $this->getId($params) . '/', $params);
  }

}
