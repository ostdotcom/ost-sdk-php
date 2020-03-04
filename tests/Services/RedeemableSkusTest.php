<?php
/**
 * Created by PhpStorm.
 * User: aman
 * Date: 2020-02-20
 * Time: 16:44
 */
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/ServiceTestBase.php");

final class RedeemableSkusTest extends ServiceTestBase
{
  /**
   *
   * Get a redemption info
   *
   * @test
   *
   * @throws Exception
   */
  public function get()
  {
    $redeemableSkusService = $this->ostObj->services->redeemableSkus;
    $params = array();
    $params['redeemable_sku_id'] =  $this->environmentVariables['redeemableSkuId'];
    $response = $redeemableSkusService->get($params)->wait();
    $this->isSuccessResponse($response);
  }

  /**
   *
   * Get all redeemableSkus
   *
   * @test
   *
   * @throws Exception
   */
  public function getList()
  {
    $ostObj = $this->instantiateOSTSDKForV2Api();
    $redeemableSkusService = $ostObj->services->redeemableSkus;
    $params = array();
    $response = $redeemableSkusService->getList($params)->wait();
    $this->isSuccessResponse($response);
  }

}
