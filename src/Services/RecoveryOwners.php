<?php
/**
 * RecoveryOwners class
 */

namespace OST;

use OST\Base;

/**
 * Class encapsulating methods to interact with API's for RecoveryOwners module
 */
class RecoveryOwners extends Base
{

  const PREFIX = '/users';
  const SUFFIX = '/recovery-owners';

  /**
   * Get Recovery Owner
   *
   * @param array $params params for fetching Recovery Owner of a User
   *
   * @throws \Exception
   *
   * @return object
   *
   */
  public function get(array $params = array())
  {
    return $this->requestObj->get($this->getPrefix() . '/' . $this->getUserId($params) . $this->getSuffix() . '/' . $this->getRecoveryOwnerAddress($params), $params);
  }

}
