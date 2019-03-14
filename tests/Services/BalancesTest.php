<?php
/**
 * Created by PhpStorm.
 * User: tejassangani
 * Date: 2019-03-05
 * Time: 16:08
 */
$filepath = realpath(dirname(__FILE__));
require_once($filepath . "/ServiceTestBase.php");

final class BalancesTest extends ServiceTestBase
{
  /**
   *
   * Get User's Balance
   *
   * @test
   *
   * @throws Exception
   */
  public function get()
  {
    $balancesService = $this->ostObj->services->balances;
    $params = array();
    $params['user_id'] = $this->environmentVariables['userId'];
    $response = $balancesService->get($params)->wait();
    $this->isSuccessResponse($response);
  }

}
