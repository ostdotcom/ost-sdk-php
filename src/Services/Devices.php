<?php
/**
 * Users class
 */

namespace OST;

use OST\Base;

/**
 * Class encapsulating methods to interact with API's for Devices module
 */
class Devices extends Base
{

  const PREFIX = '/users';
  const SUFFIX = '/devices';

  /**
   * Associate a Device with a User
   *
   * @param array $params params for associating a device
   *
   * @return object
   *
   */
  public function create(array $params = array())
  {
    return $this->requestObj->post($this->getPrefix()  . '/' . $this->getUserId($params) . $this->getSuffix() . '/', $params);
  }

  /**
   * List devices of a user
   *
   * @param array $params params for fetching devices list
   *
   * @return object
   *
   */
  public function getList(array $params = array())
  {
    return $this->requestObj->get($this->getPrefix() . '/' . $this->getUserId($params) . $this->getSuffix() . '/', $params);
  }

  /**
   * Get device of a user
   *
   * @param array $params params for fetching device
   *
   * @return object
   *
   */
  public function get(array $params = array())
  {
    return $this->requestObj->get($this->getPrefix() . '/' . $this->getUserId($params) . $this->getSuffix() . '/' . $this->getDeviceAddress($params) . '/', $params);
  }

}
