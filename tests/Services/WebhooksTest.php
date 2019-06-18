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
  public function webhookEndpoints()
  {
    $webhooksService = $this->ostObj->services->webhooks;
    $params = array();
    $params['topics'] =  array("transactions/initiate", "transactions/success");
    $currentTime = time();
    $version = phpversion();
    $params['url'] =  "https://testingWebhooks.com"."/".$currentTime."/".$version;
    $responseForCreate = $webhooksService->create($params)->wait();
    $this->isSuccessResponse($responseForCreate);
    putenv('WEBHOOK_ID='.$responseForCreate['data']['webhook']['id']);

    $paramsForGet = array();
    $paramsForGet['webhook_id'] = getenv('WEBHOOK_ID');
    $responseForGet = $webhooksService->get($paramsForGet)->wait();
    $this->isSuccessResponse($responseForGet);

    $paramsForUpdate = array();
    $paramsForUpdate['webhook_id'] = getenv('WEBHOOK_ID');
    $paramsForUpdate['topics'] =  array("transactions/initiate", "transactions/success", "transactions/failure");
    $responseForUpdate = $webhooksService->update($paramsForUpdate)->wait();
    $this->isSuccessResponse($responseForUpdate);

    $paramsForDelete = array();
    $paramsForDelete['webhook_id'] = getenv('WEBHOOK_ID');
    $responseForDelete = $webhooksService->delete($paramsForDelete)->wait();
    $this->isSuccessResponse($responseForDelete);
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
    * Verify webhook request signature.
    *
    * @test
    *
    * @throws Exception
    */
    public function verifySignature()
    {
      $webhooksService = $this->ostObj->services->webhooks;
      $params = array();
      $params["version"] = "2";
      $params["webhook_secret"] = "mySecret";
      $data = array();
      $data["hello"] = "hello";
      $params["stringified_data"] = json_encode($data);
      $params["request_timestamp"] = "1559902637";
      $params["signature"] = "2c56c143550c603a6ff47054803f03ee4755c9c707986ae27f7ca1dd1c92a824";
      $response = $webhooksService->verifySignature($params);
      $this->assertTrue($response == true);
    }

}
