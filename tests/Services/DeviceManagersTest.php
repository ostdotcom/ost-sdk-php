<?php
/**
 * Created by PhpStorm.
 * User: tejassangani
 * Date: 2019-03-05
 * Time: 16:42
 */
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/ServiceTestBase.php");

final class DeviceManagersTest extends ServiceTestBase
{
  /**
   *
   * Get device managers detail
   *
   * @test
   *
   * @throws Exception
   */
  public function get()
  {
    $deviceManagersService = $this->ostObj->services->deviceManagers;
    $params = array();
    $params['user_id'] =  $this->environmentVariables['userId'];
    $response = $deviceManagersService->get($params)->wait();
    $this->isSuccessResponse($response);
  }

}
