<?php
/**
 * contains Base class
 */
namespace OST;

use Lib\Request;

/**
 * Base Class
 */
class Base
{

  /** @var object request object which would fire API calls */
  protected
    $requestObj;

  /** @var object string which would be prepended to all urls for a given module */
  protected
    $urlPrefix;

    /**
     * Constructor
     *
     * @param Request $requestObj request object which would fire API calls
     * @param string $urlPrefix string which would be prepended to all urls for a given module
     */
  public function __construct(Request $requestObj, $urlPrefix)
  {
    $this->requestObj = $requestObj;
    $this->urlPrefix = $urlPrefix;
  }

  /**
   * getId from params array
   *
   * @param array $params request object which would fire API calls
   *
   * @throws \Exception
   *
   * @return string
   */
  protected function getId(array $params)
  {
    if (\Lib\Validate::isPresent($params['id'])) {
      return urlencode($params['id']);
    } else {
      throw new \Exception('id missing in request params');
    }
  }

}
