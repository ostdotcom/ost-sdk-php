<?php
/**
 * contains Transfers class
 */

namespace OST\V1;

/**
 * Class encapsulating methods to interact with V0 API's for Transfers module
 */
class Transfers extends \OST\Base
{

  /**
   * Constructor
   *
   * @param object $requestObj request object which would fire API calls
   *
   */
  public function __construct($requestObj)
  {
    parent::__construct($requestObj, '/transfers');
  }

  /**
   * Execute a transfer
   *
   * @param array $params params for executing a transfer
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
   * List transfers
   *
   * @param array $params params for fetching transfers list
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
   * Get transfer details
   *
   * @param array $params params for fetching details of a transfer
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
