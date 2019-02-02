<?php
/**
 * Users class
 */

namespace OST;

use OST\Base;

/**
 * Class encapsulating methods to interact with API's for Devices module
 */
class DeviceManagers extends Base
{

  const PREFIX = '/users';
  const SUFFIX = '/device-managers';

  /**
   * Get Device Manager of a User
   *
   * @param array $params params for fetching device managers of a user
   *
   * @return object
   *
   */
  public function get(array $params = array())
  {
    return $this->requestObj->get($this->getPrefix()  . '/' . $this->getUserId($params) . $this->getSuffix() . '/', $params);
  }

}
