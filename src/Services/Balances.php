<?php
/**
 * Balances class
 */

namespace OST;

use OST\Base;

/**
 * Class encapsulating methods to interact with API's for Balances module
 */
class Balances extends Base
{

  const PREFIX = '/users';
  const SUFFIX = '/balance';

  /**
   * Get user's balance
   *
   * @param array $params params for fetching balance of a user
   *
   * @throws \Exception
   *
   * @return object
   *
   */
  public function get(array $params = array())
  {
    return $this->requestObj->get($this->getPrefix() . '/' . $this->getUserId($params) . $this->getSuffix() . '/', $params);
  }

}
