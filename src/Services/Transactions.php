<?php
/**
 * Transactions class
 */

namespace OST;

use OST\Base;

/**
 * Class encapsulating methods to interact with API's for Transactions module
 */
class Transactions extends Base
{

  const PREFIX = '/users';
  const SUFFIX = '/transactions';

  /**
   * Get transaction details
   *
   * @param array $params params for executing a transaction
   *
   * @return object
   *
   */
  public function execute(array $params = array())
  {
    return $this->requestObj->post($this->getPrefix()  . '/' . $this->getUserId($params) . $this->getSuffix() . '/', $params);
  }

  /**
   * List transactions of a user
   *
   * @param array $params params for fetching transactions list
   *
   * @return object
   *
   */
  public function getList(array $params = array())
  {
    return $this->requestObj->get($this->getPrefix() . '/' . $this->getUserId($params) . $this->getSuffix() . '/', $params);
  }

  /**
   * Get transaction details of a uuid
   *
   * @param array $params params for fetching device
   *
   * @return object
   *
   */
  public function get(array $params = array())
  {
    return $this->requestObj->get($this->getPrefix() . '/' . $this->getUserId($params) . $this->getSuffix() . '/' . $this->getTransactionId($params) . '/', $params);
  }

}
