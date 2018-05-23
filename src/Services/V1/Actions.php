<?php
/**
 * contains Actions class
 */

namespace OST\V1;

/**
 * Class encapsulating methods to interact with V0 API's for Actions module
 */
class Actions extends \OST\Base
{

  /**
   * Constructor
   *
   * @param object $requestObj request object which would fire API calls
   *
   */
  public function __construct($requestObj)
  {
    parent::__construct($requestObj, '/actions');
  }

  /**
   * Create a action
   *
   * @param array $params params for creating an action
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
   * Edit an action
   *
   * @param array $params params for editing an action
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
   * List actions
   *
   * @param array $params params for fetching actions list
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
   * Get action details
   *
   * @param array $params params for fetching details of a action
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
