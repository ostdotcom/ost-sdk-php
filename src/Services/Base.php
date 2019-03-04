<?php
/**
 * contains Base class
 */

namespace OST;

use InvalidArgumentException;
use Lib\Request;
use Lib\Validate;
use RuntimeException;

/**
 * Base Class
 */
abstract class Base
{
    const MISSING_ID = 'id missing in request params';
    const MISSING_USER_ID = 'user id missing in request params';
    const INVALID_CHAIN_ID = 'chain id is invalid in request params';
    const MISSING_DEVICE_ADDRESS = 'device address missing in request params';
    const MISSING_SESSION_ADDRESS = 'session address missing in request params';
    const MISSING_TRANSACTION_ID = 'transaction id missing in request params';
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
     * @throws InvalidArgumentException
     *
     * @return string
     */
    protected function getId(array $params)
    {
        if (Validate::isPresent($params['id'])) {
            return urlencode($params['id']);
        }

        throw new InvalidArgumentException(static::MISSING_ID);
    }

    /**
     * getUserId from params array
     *
     * @param array $params request object which would fire API calls
     *
     * @throws InvalidArgumentException
     *
     * @return string
     */
    protected function getUserId(array $params)
    {
      if (Validate::isPresent($params['user_id'])) {
        return urlencode($params['user_id']);
      }

      throw new InvalidArgumentException(static::MISSING_USER_ID);
    }

    /**
     * getChainId from params array
     *
     * @param array $params request object which would fire API calls
     *
     * @throws InvalidArgumentException
     *
     * @return string
     */
    protected function getChainId(array $params)
    {
      if (!Validate::isPresent($params['chain_id'])) {
        throw new InvalidArgumentException(static::INVALID_CHAIN_ID);
      }

      return urlencode($params['chain_id']);
    }

    /**
     * getDeviceAddress from params array
     *
     * @param array $params request object which would fire API calls
     *
     * @throws InvalidArgumentException
     *
     * @return string
     */
    protected function getDeviceAddress(array $params)
    {
        if (Validate::isPresent($params['device_address'])) {
            return urlencode($params['device_address']);
        }

        throw new InvalidArgumentException(static::MISSING_DEVICE_ADDRESS);
    }


    /**
     * getSessionAddress from params array
     *
     * @param array $params request object which would fire API calls
     *
     * @throws InvalidArgumentException
     *
     * @return string
     */
    protected function getSessionAddress(array $params)
    {
        if (Validate::isPresent($params['session_address'])) {
            return urlencode($params['session_address']);
        }

        throw new InvalidArgumentException(static::MISSING_SESSION_ADDRESS);
    }

    /**
     * getTransactionId from params array
     *
     * @param array $params request object which would fire API calls
     *
     * @throws InvalidArgumentException
     *
     * @return string
     */
    protected function getTransactionId(array $params)
    {
      if (Validate::isPresent($params['transaction_id'])) {
        return urlencode($params['transaction_id']);
      }

      throw new InvalidArgumentException(static::MISSING_TRANSACTION_ID);
    }

    /**
     * getRecoveryOwnerAddress from params array
     *
     * @param array $params request object which would fire API calls
     *
     * @throws InvalidArgumentException
     *
     * @return string
     */
    protected function getRecoveryOwnerAddress(array $params)
    {
      if (Validate::isPresent($params['recovery_owner_address'])) {
        return urlencode($params['recovery_owner_address']);
      }

      throw new InvalidArgumentException(static::MISSING_USER_ID);
    }

}
