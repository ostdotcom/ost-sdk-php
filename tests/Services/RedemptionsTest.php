<?php
/**
 * Created by PhpStorm.
 * User: aman
 * Date: 2020-02-20
 * Time: 16:44
 */
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/ServiceTestBase.php");

final class RedemptionsTest extends ServiceTestBase
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
    $redemptionsService = $this->ostObj->services->redemptions;
    $params = array();
    $params['user_id'] =  $this->environmentVariables['userId'];
    $params['redemption_id'] =  $this->environmentVariables['redemptionId'];
    $response = $redemptionsService->get($params)->wait();
    $this->isSuccessResponse($response);
  }

  /**
   *
   * Get all redemptions for a user
   *
   * @test
   *
   * @throws Exception
   */
  public function getList()
  {
    $ostObj = $this->instantiateOSTSDKForV2Api();
    $redemptionsService = $ostObj->services->redemptions;
    $params = array();
    $params['user_id'] =  $this->environmentVariables['userId'];
    $response = $redemptionsService->getList($params)->wait();
    $this->isSuccessResponse($response);
  }

}
