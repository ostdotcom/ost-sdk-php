<?php
/**
 * Created by PhpStorm.
 * User: tejassangani
 * Date: 2019-03-05
 * Time: 16:44
 */
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/ServiceTestBase.php");

final class TokensTest extends ServiceTestBase
{
  /**
   *
   * Get a Token
   *
   * @test
   *
   * @throws Exception
   */
  public function get()
  {
    $tokensService = $this->ostObj->services->tokens;
    $params = array();
    $response = $tokensService->get($params)->wait();
    $this->isSuccessResponse($response);
  }

}
