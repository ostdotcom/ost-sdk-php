<?php
/**
 * Created by PhpStorm.
 * User: tejassangani
 * Date: 2019-03-05
 * Time: 16:42
 */
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/ServiceTestBase.php");

final class DevicesTest extends ServiceTestBase
{
  /**
   *
   * Get User Device
   *
   * @test
   *
   * @throws Exception
   */
  public function get()
  {
    $devicesService = $this->ostObj->services->devices;
    $params = array();
    $params['user_id'] =  $this->environmentVariables['userId'];
    $params['device_address'] =  $this->environmentVariables['deviceUserAddress'];
    $response = $devicesService->get($params)->wait();
    $this->isSuccessResponse($response);
  }

  /**
   *
   * Get User Device(s) List
   *
   * @test
   *
   * @throws Exception
   */
  public function getList()
  {
    $devicesService = $this->ostObj->services->devices;
    $params = array();
    $params['user_id'] =  $this->environmentVariables['userId'];
    $params['device_address'] =  $this->environmentVariables['deviceUserAddress'];
    $response = $devicesService->getList($params)->wait();
    $this->isSuccessResponse($response);
  }

  /**
   *
   * Create a device for User
   *
   * @test
   *
   * @throws Exception
   */
  public function create()
  {
    $devicesService = $this->ostObj->services->devices;
    $params = array();
    $params['user_id'] =  $this->environmentVariables['userId'];
    $params['address'] =  $this->generateRandomAddress();
    $params['api_signer_address'] =  $this->generateRandomAddress();
    $response = $devicesService->create($params)->wait();
    $this->isSuccessResponse($response);
  }

}
