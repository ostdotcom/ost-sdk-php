<?php
/**
 * Users class
 */

namespace OST\V1;

use Lib\Request;

/**
 * Class encapsulating methods to interact with V1 API's for Users module
 */
class Users extends \OST\Base
{

  /**
   * Constructor
   *
   * @param Request $requestObj request object which would fire API calls
   *
   */
  public function __construct(Request $requestObj)
  {
    parent::__construct($requestObj, '/users');
  }

  /**
   * Create a User
   *
   * @param array $params params for creating a user
   *
   * @return object
   *
   */
  public function create(array $params = array()) {
    return $this->requestObj->post($this->urlPrefix . '/', $params);
  }

  /**
   * Edit a User
   *
   * @param array $params params for editing a user
   *
   * @throws \Exception
   *
   * @return object
   *
   */
  public function edit(array $params = array()) {
    return $this->requestObj->post($this->urlPrefix . '/' . $this->getId($params) . '/', $params);
  }

  /**
   * List Users
   *
   * @param array $params params for fetching users list
   *
   * @return object
   *
   */
  public function getList(array $params = array()) {
    return $this->requestObj->get($this->urlPrefix . '/', $params);
  }

  /**
   * Get user details
   *
   * @param array $params params for fetching details of a user
   *
   * @throws \Exception
   *
   * @return object
   *
   */
  public function get(array $params = array()) {
    return $this->requestObj->get($this->urlPrefix . '/' . $this->getId($params) . '/', $params);
  }

}
