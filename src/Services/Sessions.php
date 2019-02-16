<?php
/**
 * Users class
 */

namespace OST;

use OST\Base;

/**
 * Class encapsulating methods to interact with API's for Session module
 */
class Sessions extends Base
{

  const PREFIX = '/users';
  const SUFFIX = '/sessions';


  /**
     * Get session of a user
     *
     * @param array $params params for fetching sessions list
     *
     * @return object
     *
     */
    public function get(array $params = array())
    {
      return $this->requestObj->get($this->getPrefix() . '/' . $this->getUserId($params) . $this->getSuffix() . '/' . $this->getSessionAddress($params) . '/', $params);
    }

  /**
   * List sessions of a user
   *
   * @param array $params params for fetching sessions list
   *
   * @return object
   *
   */
  public function getList(array $params = array())
  {
    return $this->requestObj->get($this->getPrefix() . '/' . $this->getUserId($params) . $this->getSuffix() . '/', $params);
  }

}
