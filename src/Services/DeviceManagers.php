<?php
/**
 * DeviceManagers class
 */

namespace OST;

use OST\Base;

/**
 * Class encapsulating methods to interact with API's for DeviceManagers module
 */
class DeviceManagers extends Base
{

  const PREFIX = '/users';
  const SUFFIX = '/device-managers';

  /**
   * Get Device Manager Detail
   *
   * @param array $params params for fetching Device Manager Detail of a User
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
