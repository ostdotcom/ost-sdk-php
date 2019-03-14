<?php
/**
 * Created by PhpStorm.
 * User: tejassangani
 * Date: 2019-03-05
 * Time: 16:36
 */
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/ServiceTestBase.php");

final class ChainsTest extends ServiceTestBase
{
  /**
   *
   * Get a Chain Information
   *
   * @test
   *
   * @throws Exception
   */
  public function get()
  {
    $chainsService = $this->ostObj->services->chains;
    $params = array();
    $params['chain_id'] =  $this->environmentVariables['auxChainId'];
    $response = $chainsService->get($params)->wait();
    $this->isSuccessResponse($response);
  }

}
