<?php
/**
 * Created by PhpStorm.
 * User: Dhananjay8
 * Date: 2019-05-20
 * Time: 16:44
 */
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/ServiceTestBase.php");

final class BaseTokensTest extends ServiceTestBase
{
  /**
   *
   * Get Base Tokens
   *
   * @test
   *
   * @throws Exception
   */
  public function get()
  {
    $baseTokensService = $this->ostObj->services->baseTokens;
    $params = array();
    $response = $baseTokensService->get($params)->wait();
    $this->isSuccessResponse($response);
  }

}
