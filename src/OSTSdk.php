<?php
/**
 * OSTSdk class
 */

/**
 * Class which provides access to OST KIT services
 */
class OSTSdk
{

  /** @var object object to access methods */
  public $services;

  /**
   * Class constructor.
   *
   * @param array $params Array containing the necessary params {
   * @type string $apiKey API Key.
   * @type string $apiSecret API Secret.
   * @type string $apiBaseUrl Base API URL.
   * }
   *
   * @throws \Exception
   */
  public function __construct(array $params)
  {

    if (!isset($params)) {
      $message = 'Params missing. Did you forget to set params?';
      throwException($message);
    } elseif (!isset($params['apiKey'])) {
      $message = 'Params missing. Did you forget to set apiKey in params?';
      throwException($message);
    } elseif (!isset($params['apiBaseUrl'])) {
      $message = 'Params missing. Did you forget to set apiBaseUrl in params?';
      throwException($message);
    } elseif (!isset($params['apiSecret'])) {
      $message = 'Params missing. Did you forget to set apiSecret in params?';
      throwException($message);
    } else {
      $this->services = new \OST\Manifest($params);
    }

  }

  /**
   * Class constructor.
   *
   * @param string $message
   *
   * @throws \Exception
   */
  function throwException(string $message) {
    throw new Exception($message);
  }


}
