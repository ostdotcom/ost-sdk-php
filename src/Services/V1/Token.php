<?php
/**
 * Token class
 */

namespace OST\V1;

use Lib\Request;

/**
 * Class encapsulating methods to interact with V1 API's for Token module
 */
class Token extends \OST\Base
{

  /**
   * Constructor
   *
   * @param Request $requestObj request object which would fire API calls
   *
   */
  public function __construct(Request $requestObj)
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
  public function get(array $params = array()) {
    return $this->requestObj->get($this->urlPrefix . '/', $params);
  }

}
