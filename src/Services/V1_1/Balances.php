<?php
/**
 * Balances class
 */

namespace OST\V1_1;

use OST\Base;

/**
 * Class encapsulating methods to interact with V1.1 API's for Balances module
 */
class Balances extends Base
{

  const PREFIX = '/balances';

  /**
   * Get balance of user
   *
   * @param array $params params for fetching balance of user
   *
   * @throws \Exception
   *
   * @return object
   *
   */
  public function get($params = array()) {
    return $this->requestObj->get($this->getPrefix() . '/' . $this->getId($params) . '/', $params);
  }

}
