<?php
/**
 * contains Base class
 */
namespace OST;

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
   * @param object $requestObj request object which would fire API calls
   * @param string $urlPrefix  string which would be prepended to all urls for a given module
   *
   */
  public function __construct($requestObj, $urlPrefix)
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
  protected function getId($params)
  {
    if (\Lib\Validate::isPresent($params['id'])) {
      return $params['id'];
    } else {
      throw new \Exception('id missing in request params');
    }
  }

}
