<?php
/**
 * Created by PhpStorm.
 * User: tejassangani
 * Date: 2019-03-05
 * Time: 16:44
 */
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/ServiceTestBase.php");

final class SessionsTest extends ServiceTestBase
{
  /**
   *
   * Get a Session
   *
   * @test
   *
   * @throws Exception
   */
  public function get()
  {
    $sessionsService = $this->ostObj->services->sessions;
    $params = array();
    $params['user_id'] =  $this->environmentVariables['userId'];
    $params['session_address'] =  $this->environmentVariables['sessionAddress'];
    $response = $sessionsService->get($params)->wait();
    $this->isSuccessResponse($response);
  }

  /**
   *
   * Get List of Sessions
   *
   * @test
   *
   * @throws Exception
   */
  public function getList()
  {
    $ostObj = $this->instantiateOSTSDKForV2Api();
    $sessionsService = $ostObj->services->sessions;
    $params = array();
    $params['user_id'] =  $this->environmentVariables['userId'];
    $response = $sessionsService->getList($params)->wait();
    $this->isSuccessResponse($response);
  }

}
