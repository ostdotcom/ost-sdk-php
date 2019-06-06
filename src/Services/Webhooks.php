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
}
