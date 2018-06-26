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
   * @type string $baseUrl Base API URL.
   * }
   *
   * @throws \Exception
   */
  public function __construct(array $params)
  {
    // Extract API version
    $apiEndpointVersion = explode('/', $params['apiBaseUrl'])[3];

    $intApiVersion = $this->getIntApiVersion($apiEndpointVersion);

    # Provide access to version specific API endpoints
    if ($intApiVersion >= $this->v1dot2IntApiVersion()) {
      throw new \Exception('Unsupported API Version (' . @$apiEndpointVersion . '). Please check for new versions of OSTSdk.');
    } elseif ($intApiVersion >= $this->v1dot1IntApiVersion()) {
      $this->services = new \OST\V1Dot1\Manifest($params);
    } elseif ($intApiVersion >= $this->v1IntApiVersion()) {
      $this->services = new \OST\V1\Manifest($params);
    } else {
      $this->services = new \OST\V0\Manifest($params);
    }

  }

  /**
   * from API Version string generate a integer
   *
   * @param string $apiEndpointVersion api version from the URL
   *
   * @throws \Exception
   *
   * @return int
   */
  private function getIntApiVersion($apiEndpointVersion)
  {

    if (empty($apiEndpointVersion)) {
      return $this->v0IntApiVersion();
    }

    // apply regex match to check if version is in valid format
    preg_match('/^v(\d{1,3})\.?(\d{0,3})\.?(\*|\d{0,3})$/', $apiEndpointVersion, $matches, PREG_OFFSET_CAPTURE);

    if (empty($matches)) {
      throw new \Exception('Api version ' . $apiEndpointVersion . ' is invalid');
    }

    $intApiVersion = 0;

    $intApiVersion += (int)$matches[1][0] * 1000000;

    $intApiVersion += (empty($matches[2][0]) ? 0 : (int)$matches[2][0] * 1000);

    $intApiVersion += (empty($matches[3][0]) ? 0 : (int)$matches[3][0]);

    return $intApiVersion;

  }

  /**
   * Int API Version for V0
   *
   * @return int
   */
  private function v0IntApiVersion()
  {
    return 0;
  }

  /**
   * Int API Version for V1.0
   *
   * @return int
   */
  private function v1IntApiVersion()
  {
    return 1000000;
  }

  /**
   * Int API Version for V1.1
   *
   * @return int
   */
  private function v1dot1IntApiVersion()
  {
    return 1001000;
  }

  /**
   * Int API Version for V1.2
   *
   * @return int
   */
  private function v1dot2IntApiVersion()
  {
    return 1002000;
  }


}
