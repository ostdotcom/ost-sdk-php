<?php
/**
 * Created by PhpStorm.
 * User: tejassangani
 * Date: 2019-03-05
 * Time: 16:43
 */
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/ServiceTestBase.php");

final class PricePointsTest extends ServiceTestBase
{
  /**
   *
   * Get a Price Points
   *
   * @test
   *
   * @throws Exception
   */
  public function get()
  {
    $pricePointsService = $this->ostObj->services->pricePoints;
    $params = array();
    $params['chain_id'] =  $this->environmentVariables['auxChainId'];
    $response = $pricePointsService->get($params)->wait();
    $this->isSuccessResponse($response);
  }

}
