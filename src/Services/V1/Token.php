<?php
/**
 * Token class
 */

namespace OST\V1;

/**
 * Class encapsulating methods to interact with V1 API's for Token module
 */
class Token extends \OST\Base
{

  /**
   * Constructor
   *
   * @param object $requestObj request object which would fire API calls
   *
   */
  public function __construct($requestObj)
  {
    parent::__construct($requestObj, '/token');
  }

  /**
   * Get token details
   *
   * @param array $params params for fetching details of a token
   *
   * @return object
   *
   */
  public function get($params = array()) {
    return $this->requestObj->get($this->urlPrefix . '/', $params);
  }

}
