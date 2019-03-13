<?php
/**
 * Created by PhpStorm.
 * User: tejassangani
 * Date: 2019-03-05
 * Time: 16:45
 */
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/ServiceTestBase.php");

final class UsersTest extends ServiceTestBase
{
  /**
   *
   * Get an User
   *
   * @test
   *
   * @throws Exception
   */
  public function get()
  {
    $usersService = $this->ostObj->services->users;
    $params = array();
    $params['user_id'] =  $this->environmentVariables['userId'];
    $response = $usersService->get($params)->wait();
    $this->isSuccessResponse($response);
  }

  /**
   *
   * Create an User
   *
   * @test
   *
   * @throws Exception
   */
  public function getList()
  {
    $ostObj = $this->instantiateOSTSDKForV2Api();
    $usersService = $ostObj->services->users;
    $params = array();
    $response = $usersService->getList($params)->wait();
    $this->isSuccessResponse($response);
  }

  /**
   *
   * Get List of users
   *
   * @test
   *
   * @throws Exception
   */
  public function create()
  {
    $ostObj = $this->instantiateOSTSDKForV2Api();
    $usersService = $ostObj->services->users;
    $params = array();
    $response = $usersService->create($params)->wait();
    $this->isSuccessResponse($response);
  }

}
