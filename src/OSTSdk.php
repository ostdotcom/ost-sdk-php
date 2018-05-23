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
  public
    $services;

  /**
   * Class constructor.
   *
   * @param array $params Array containing the necessary params {
   *      @type string $apiKey API Key.
   *      @type string $apiSecret API Secret.
   *      @type string $baseUrl Base API URL.
   * }
   *
   * @throws \Exception
   */
  public function __construct($params)
  {

    // Extract API major version
    $apiEndpointVersion = preg_split('/\//', $params['apiBaseUrl'])[3];

    if (is_null($apiEndpointVersion)) {
      $this->services = new \OST\V0\Manifest($params);
    } elseif (strtolower($apiEndpointVersion) == 'v1') {
      $this->services = new \OST\V1\Manifest($params);
    } else {
      throw new \Exception('Api endpoint is invalid');
    }

  }

}
