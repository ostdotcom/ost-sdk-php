<?php
/**
 * Webhooks class
 */

namespace OST;

use OST\Base;

/**
 * Class encapsulating methods to interact with API's for Webhook module
 */
class Webhooks extends Base
{

  const PREFIX = '/webhooks';

  /**
   * Create a new webhook.
   *
   * @param array $params params for creating a new webhook
   *
   * @return object
   *
   */
  public function create(array $params = array())
  {
    return $this->requestObj->post($this->getPrefix() . '/', $params);
  }

  /**
   * Update a webhook.
   *
   * @param array $params params for updating a webhook
   *
   * @return object
   *
   */
  public function update(array $params = array())
  {
    return $this->requestObj->post($this->getPrefix() . '/' . $this->getWebhookId($params) . '/', $params);
  }

  /**
   * Get a webhook.
   *
   * @param array $params params for fetching webhook
   *
   * @return object
   *
   */
  public function get(array $params = array())
  {
    return $this->requestObj->get($this->getPrefix() . '/' . $this->getWebhookId($params) . '/', $params);
  }

  /**
   * List all webhooks.
   *
   * @param array $params params for fetching webhooks list
   *
   * @return object
   *
   */
  public function getList(array $params = array())
  {
    return $this->requestObj->get($this->getPrefix() . '/', $params);
  }


  /**
   * Delete a webhook.
   *
   * @param array $params params for deleting a webhook.
   *
   * @return object
   *
   */
  public function delete(array $params = array())
  {
    return $this->requestObj->delete($this->getPrefix() . '/' . $this->getWebhookId($params) . '/', $params);
  }
  
  /**
   * Verify webhook request signature.
   *
   * @param array $params params for verifying a webhook signature.
   *
   * @return object
   *
   */
  public function verifySignature(array $params = array())
  {
    $version = $params["version"];
    $webhookSecret = $params["webhook_secret"];
    $stringifiedData = $params["stringified_data"];
    $requestTimestamp = $params["request_timestamp"];
    $signature = $params["signature"];

    $signatureParams = $requestTimestamp.".".$version.".".$stringifiedData;
    $signatureToBeVerified = hash_hmac('sha256', $signatureParams, $webhookSecret);

    if(strcmp($signatureToBeVerified, $signature) == 0)
    {
      return true;
    } else {
      return false;
    }
  }
}








