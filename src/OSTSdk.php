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
      $this->throwException($message);
    } elseif (!isset($params['apiKey'])) {
      $message = 'Params missing. Did you forget to set apiKey in params?';
      $this->throwException($message);
    } elseif (!isset($params['apiBaseUrl'])) {
      $message = 'Params missing. Did you forget to set apiBaseUrl in params?';
      $this->throwException($message);
    } elseif (!isset($params['apiSecret'])) {
      $message = 'Params missing. Did you forget to set apiSecret in params?';
      $this->throwException($message);
    } elseif (!$this->validateApiBaseUrl($params['apiBaseUrl'])) {
      $message = 'Invalid Api Base Url. It should match regex: ' . $this->apiBaseUrlRegex();
      $this->throwException($message);
    } else {
      $this->services = new \OST\Manifest($params);
    }

  }

  /**
   * Throw exception
   *
   * @param string $message
   *
   * @throws \Exception
   */
  private function throwException($message) {
    throw new Exception($message);
  }

  /**
   * Validate API Base URL
   *
   * @param string $apiBaseUrl
   *
   * @return boolean
   */
  private function validateApiBaseUrl($apiBaseUrl) {
    $matchResponse = preg_match($this->apiBaseUrlRegex(), $apiBaseUrl);
    return $matchResponse == 1;
  }

  /**
   * Validate API Base URL
   *
   * @param string $apiBaseUrl
   *
   * @return string
   */
  private function apiBaseUrlRegex() {
    return "/^.*(testnet|mainnet)\/v2\/?$/";
  }

}
