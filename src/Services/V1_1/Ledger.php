<?php
/**
 * Ledger class
 */

namespace OST\V1_1;

use OST\Base;

/**
 * Class encapsulating methods to interact with V1.1 API's for Ledger module
 */
class Ledger extends Base
{

  const PREFIX = '/ledger';

  /**
   * Get ledger for user
   *
   * @param array $params params for fetching ledger for an user
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
