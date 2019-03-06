<?php
/**
 * Created by PhpStorm.
 * User: tejassangani
 * Date: 2019-03-05
 * Time: 16:43
 */
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/ServiceTestBase.php");

final class RecoveryOwnersTest extends ServiceTestBase
{
  /**
   *
   * Get recovery owner
   *
   * @test
   *
   * @throws Exception
   */
  public function get()
  {
    $recoveryOwnersService = $this->ostObj->services->recoveryOwners;
    $params = array();
    $params['user_id'] =  $this->environmentVariables['userId'];
    $params['recovery_owner_address'] =  $this->environmentVariables['recoveryOwnerAddress'];
    $response = $recoveryOwnersService->get($params)->wait();
    $this->isSuccessResponse($response);
  }

}
