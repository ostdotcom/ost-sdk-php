<?php
/**
 * Created by PhpStorm.
 * User: shlokgilda
 * Date: 2019-06-05
 * Time: 16:42
 */
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/ServiceTestBase.php");

final class WebhooksTest extends ServiceTestBase
{
  /**
   *
   * Create a webhook.
   *
   * @test
   *
   * @throws Exception
   */
  public function create()
  {
    $webhooksService = $this->ostObj->services->webhooks;
    $params = array();
    $params['topics'] =  array("transactions/initiate", "transactions/success");
    $params['url'] =  "https://testingWebhooks.com";
    $response = $webhooksService->create($params)->wait();
    $this->isSuccessResponse($response);
    putenv('WEBHOOK_ID='.$response['data']['webhook']['id']);
  }

  /**
   *
   * Get all webhooks.
   *
   * @test
   *
   * @throws Exception
   */
  public function getAll()
  {
    $webhooksService = $this->ostObj->services->webhooks;
    $params = array();
    $response = $webhooksService->getList($params)->wait();
    $this->isSuccessResponse($response);
  }

  /**
   *
   * Get a webhook.
   *
   * @test
   *
   * @throws Exception
   */
   public function get()
   {
     $webhooksService = $this->ostObj->services->webhooks;
     $params = array();
     $params['webhook_id'] = getenv('WEBHOOK_ID');
     $response = $webhooksService->get($params)->wait();
     $this->isSuccessResponse($response);
   }

   /**
    *
    * Update a webhook.
    *
    * @test
    *
    * @throws Exception
    */
    public function update()
    {
      $webhooksService = $this->ostObj->services->webhooks;
      $params = array();
      $params['webhook_id'] = getenv('WEBHOOK_ID');
      $params['topics'] =  array("transactions/initiate", "transactions/success", "transactions/failure");
      $response = $webhooksService->update($params)->wait();
      $this->isSuccessResponse($response);
    }

   /**
    *
    * Delete a webhook.
    *
    * @test
    *
    * @throws Exception
    */
    public function delete()
    {
      $webhooksService = $this->ostObj->services->webhooks;
      $params = array();
      $params['webhook_id'] = getenv('WEBHOOK_ID');
      $response = $webhooksService->delete($params)->wait();
      $this->isSuccessResponse($response);
    }

}
