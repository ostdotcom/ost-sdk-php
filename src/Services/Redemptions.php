<?php
/**
 * Redemptions class
 */

namespace OST;

use OST\Base;

/**
 * Class encapsulating methods to interact with API's for Redemptions module
 */
class Redemptions extends Base
{

  const PREFIX = '/users';
  const SUFFIX = '/redemptions';

  /**
   * List Redemptions of a user
   *
   * @param array $params params for fetching redemptions list
   *
   * @return object
   *
   */
  public function getList(array $params = array())
  {
    return $this->requestObj->get($this->getPrefix() . '/' . $this->getUserId($params) . $this->getSuffix() . '/', $params);
  }

  /**
   * Get Redemption details of a uuid
   *
   * @param array $params params for fetching details of a redemption
   *
   * @return object
   *
   */
  public function get(array $params = array())
  {
    return $this->requestObj->get($this->getPrefix() . '/' . $this->getUserId($params) . $this->getSuffix() . '/' . $this->getRedemptionId($params) . '/', $params);
  }

}
