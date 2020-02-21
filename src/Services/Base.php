<?php
/**
 * contains Base class
 */

namespace OST;

use InvalidArgumentException;
use BadMethodCallException;
use Lib\Request;
use Lib\Validate;
use RuntimeException;

/**
 * Base Class
 */
abstract class Base
{
   const PREFIX = '';
  const SUFFIX = '';

  /** @var Request request object which would fire API calls */
  protected $requestObj;

  /**
   * Constructor
   *
   * @param Request $requestObj request object which would fire API calls
   */
  public function __construct(Request $requestObj)
  {
    $this->requestObj = $requestObj;
  }

  /**
   * @return string
   * @throws RuntimeException
   */
  protected function getPrefix()
  {
    if (empty(static::PREFIX)) {
      throw new RuntimeException('Prefix must be defined in class: ' . get_class($this));
    }

    return static::PREFIX;
  }

  /**
   * @return string
   * @throws RuntimeException
   */
  protected function getSuffix()
  {
    if (empty(static::SUFFIX)) {
      throw new RuntimeException('Suffix must be defined in class: ' . get_class($this));
    }

    return static::SUFFIX;
  }

  /**
   * getId from params array
   *
   * @param array $params request object which would fire API calls
   *
   * @return string
   */
  protected function getId(array $params)
  {
    return $this->getValueForKey($params, "id");
  }

  /**
   * getUserId from params array
   *
   * @param array $params request object which would fire API calls
   *
   * @return string
   */
  protected function getUserId(array $params)
  {
    return $this->getValueForKey($params, "user_id");
  }

  /**
   * getChainId from params array
   *
   * @param array $params request object which would fire API calls
   *
   * @return string
   */
  protected function getChainId(array $params)
  {
    return $this->getValueForKey($params, "chain_id");
  }

  /**
   * getDeviceAddress from params array
   *
   * @param array $params request object which would fire API calls
   *
   * @return string
   */
  protected function getDeviceAddress(array $params)
  {
    return $this->getValueForKey($params, "device_address");
  }


  /**
   * getSessionAddress from params array
   *
   * @param array $params request object which would fire API calls
   *
   * @return string
   */
  protected function getSessionAddress(array $params)
  {
    return $this->getValueForKey($params, "session_address");
  }

  /**
   * getTransactionId from params array
   *
   * @param array $params request object which would fire API calls
   *
   * @return string
   */
  protected function getTransactionId(array $params)
  {
    return $this->getValueForKey($params, "transaction_id");
  }

  /**
   * getRedemptionId from params array
   *
   * @param array $params request object which would fire API calls
   *
   * @return string
   */
   protected function getRedemptionId(array $params)
   {
     return $this->getValueForKey($params, "redemption_id");
   }

  /**
   * getRedeemableSkuId from params array
   *
   * @param array $params request object which would fire API calls
   *
   * @return string
   */
   protected function getRedeemableSkuId(array $params)
   {
     return $this->getValueForKey($params, "redeemable_sku_id");
   }

  /**
   * getRecoveryOwnerAddress from params array
   *
   * @param array $params request object which would fire API calls
   *
   * @return string
   */
  protected function getRecoveryOwnerAddress(array $params)
  {
    return $this->getValueForKey($params, "recovery_owner_address");
  }

  /**
   * getWebhookId from params array
   *
   * @param array $params request object which would fire API calls
   *
   * @return string
   */
  protected function getWebhookId(array $params)
  {
    return $this->getValueForKey($params, "webhook_id");
  }

  /**
   * Get Value for Given Key
   *
   * @param array $params request object which would fire API calls
   *
   * @throws InvalidArgumentException, BadMethodCallException
   *
   * @return string
   */
  private function getValueForKey(&$params, $key)
  {
    $value = '';
    if (array_key_exists($key, $params)) {
      $value = $params[$key];
      unset($params[$key]);
    }
    if (($value === null) || ($value === '')) {
      throw new BadMethodCallException("$key is missing in request params");
    }
    if (!(Validate::isValidParams($value))) {
      throw new InvalidArgumentException("$key is invalid in request params");
    }
    return urlencode($value);
  }

}
