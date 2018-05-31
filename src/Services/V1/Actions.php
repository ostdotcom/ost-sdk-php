<?php
/**
 * Actions class
 */

namespace OST\V1;

use Lib\Request;

/**
 * Class encapsulating methods to interact with V1 API's for Actions module
 */
class Actions extends \OST\Base
{

  /**
   * Constructor
   *
   * @param Request $requestObj request object which would fire API calls
   *
   */
  public function __construct(Request $requestObj)
  {
    parent::__construct($requestObj, '/actions');
  }

  /**
   * Create a action
   *
   * @param array $params params for creating an action
   *
   * @return object
   *
   */
  public function create(array $params = array()) {
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
  public function edit(array $params = array()) {
    return $this->requestObj->post($this->urlPrefix . '/' . $this->getId($params) . '/', $params);
  }

  /**
   * List actions
   *
   * @param array $params params for fetching actions list
   *
   * @return object
   *
   */
  public function getList(array $params = array()) {
    return $this->requestObj->get($this->urlPrefix . '/', $params);
  }

  /**
   * Get action details
   *
   * @param array $params params for fetching details of an action
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
