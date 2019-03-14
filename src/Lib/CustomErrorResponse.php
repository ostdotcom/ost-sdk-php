<?php

namespace Lib;

use JsonSerializable;

/**
 * @package Lib
 */
class CustomErrorResponse implements JsonSerializable
{
  const BAD_REQUEST = 400;
  const TOO_MANY_REQUESTS = 429;
  const BAD_GATEWAY = 502;
  const SERVICE_UNAVAILABLE = 503;
  const GATEWAY_TIMEOUT = 504;

  const SUCCESS_KEY = 'success';
  const ERR_KEY = 'err';

  /** @var int */
  private $statusCode;

  /** @var string */
  private $internalId;

  /**
   * @param int $statusCode
   * @param string $internalId
   */
  public function __construct($statusCode = -1, $internalId = '')
  {
    $this->statusCode = $statusCode;
    $this->internalId = $internalId;
  }

  /**
   * @return array
   */
  public function jsonSerialize()
  {
    return $this->getMessage();
  }

  /**
   * @return array
   */
  public function getMessage()
  {
    $customErrorMessages = $this->customErrorMessages();

    if (empty($this->internalId) && empty($customErrorMessages[$this->statusCode])) {
      return $this->getDefaultErrorMessage();
    }

    if (($this->internalId == "connect_exception") && !empty($this->statusCode)) {
      return $this->getTimeoutErrorMessage();
    }

    if (!empty($this->internalId) && empty($customErrorMessages[$this->statusCode])) {
      return $this->customGenericErrorMessage();
    }

    return $customErrorMessages[$this->statusCode];
  }

  /**
   * @return array
   */
  private function customErrorMessages()
  {
    return [
      self::BAD_REQUEST => $this->getBadRequestErrorMessage(),
      self::TOO_MANY_REQUESTS => $this->getToManyRequestsErrorMessage(),
      self::BAD_GATEWAY => $this->getBadGatewayErrorMessage(),
      self::SERVICE_UNAVAILABLE => $this->getServiceUnavailableErrorMessage(),
      self::GATEWAY_TIMEOUT => $this->getGatewayTimeoutErrorMessage()
    ];
  }

  private function decorateErrorMessage($message)
  {
    return [
        self::SUCCESS_KEY => false,
        self::ERR_KEY => $message
    ];
  }

  /**
   * @return array
   */
  private function getBadRequestErrorMessage()
  {
    return $this->decorateErrorMessage([
      'code' => 'BAD_REQUEST',
      'internal_id' => 'SDK(BAD_REQUEST)',
      'msg' => '',
      'error_data' => []
    ]);
  }

  /**
   * @return array
   */
  private function getToManyRequestsErrorMessage()
  {
    return $this->decorateErrorMessage([
      'code' => 'TOO_MANY_REQUESTS',
      'internal_id' => 'SDK(TOO_MANY_REQUESTS)',
      'msg' => '',
      'error_data' => []
    ]);
  }

  /**
   * @return array
   */
  private function getBadGatewayErrorMessage()
  {
    return $this->decorateErrorMessage([
      'code' => 'BAD_GATEWAY',
      'internal_id' => 'SDK(BAD_GATEWAY)',
      'msg' => '',
      'error_data' => []
    ]);
  }

  /**
   * @return array
   */
  private function getTimeoutErrorMessage()
  {
    return $this->decorateErrorMessage([
        'code' => 'REQUEST_TIMEOUT',
        'internal_id' => 'SDK(REQUEST_TIMEOUT)',
        'msg' => '',
        'error_data' => []
    ]);
  }

  /**
   * @return array
   */
  private function getServiceUnavailableErrorMessage()
  {
    return $this->decorateErrorMessage([
      'code' => 'SERVICE_UNAVAILABLE',
      'internal_id' => 'SDK(SERVICE_UNAVAILABLE)',
      'msg' => '',
      'error_data' => []
    ]);
  }

  /**
   * @return array
   */
  private function getGatewayTimeoutErrorMessage()
  {
    return $this->decorateErrorMessage([
      'code' => 'GATEWAY_TIMEOUT',
      'internal_id' => 'SDK(GATEWAY_TIMEOUT)',
      'msg' => '',
      'error_data' => []
    ]);
  }

  /**
   * @return array
   */
  private function customGenericErrorMessage()
  {
    return $this->decorateErrorMessage([
      'code' => 'SOMETHING_WENT_WRONG',
      'internal_id' => 'SDK(' . $this->internalId . ')',
      'msg' => '',
      'error_data' => []
    ]);
  }

  /**
   * @return array
   */
  private function getDefaultErrorMessage()
  {
    return $this->decorateErrorMessage([
      'code' => 'SOMETHING_WENT_WRONG',
      'internal_id' => 'SDK(SOMETHING_WENT_WRONG)',
      'msg' => '',
      'error_data' => []
    ]);
  }
}
