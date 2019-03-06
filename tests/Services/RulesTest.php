<?php
/**
 * Created by PhpStorm.
 * User: tejassangani
 * Date: 2019-03-05
 * Time: 16:44
 */
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/ServiceTestBase.php");

final class RulesTest extends ServiceTestBase
{
  /**
   *
   * List all Rules
   *
   * @test
   *
   * @throws Exception
   */
  public function getList()
  {
    $rulesService = $this->ostObj->services->rules;
    $params = array();
    $response = $rulesService->getList($params)->wait();
    $this->isSuccessResponse($response);
  }

}
