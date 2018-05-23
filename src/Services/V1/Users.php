<?php
/**
 * contains Users class
 */

namespace OST\V1;

/**
 * Class encapsulating methods to interact with V0 API's for Users module
 */
class Users extends \OST\Base
{

  /**
   * Constructor
   *
   * @param object $requestObj request object which would fire API calls
   *
   */
  public function __construct($requestObj)
  {
    parent::__construct($requestObj, '/users');
  }

  /**
   * Create a User
   *
   * @param array $params params for creating a user
   *
   * @throws \Exception
   *
   * @return object
   *
   */
  public function create($params = array()) {
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
  public function edit($params = array()) {
    return $this->requestObj->post($this->urlPrefix . '/' . $this->getId($params) . '/', $params);
  }

  /**
   * List Users
   *
   * @param array $params params for fetching users list
   *
   * @throws \Exception
   *
   * @return object
   *
   */
  public function getList($params = array()) {
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
  public function get($params = array()) {
    return $this->requestObj->get($this->urlPrefix . '/' . $this->getId($params) . '/', $params);
  }

}
