<?php
/**
 * Created by PhpStorm.
 * User: tejassangani
 * Date: 2019-03-05
 * Time: 16:44
 */
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/ServiceTestBase.php");

final class TransactionsTest extends ServiceTestBase
{
  /**
   *
   * Get a transaction info
   *
   * @test
   *
   * @throws Exception
   */
  public function get()
  {
    $transactionsService = $this->ostObj->services->transactions;
    $params = array();
    $params['user_id'] =  $this->environmentVariables['userId'];
    $params['transaction_id'] =  $this->environmentVariables['transactionId'];
    $response = $transactionsService->get($params)->wait();
    $this->isSuccessResponse($response);
  }

  /**
   *
   * Get all transactions for a user
   *
   * @test
   *
   * @throws Exception
   */
  public function getList()
  {
    $ostObj = $this->instantiateOSTSDKForV2Api();
    $transactionsService = $ostObj->services->transactions;
    $params = array();
    $params['user_id'] =  $this->environmentVariables['userId'];
    $response = $transactionsService->getList($params)->wait();
    $this->isSuccessResponse($response);
  }

  /**
   *
   * execute company to user transaction
   *
   * @test
   *
   * @throws Exception
   */
  public function execute()
  {
    $ostObj = $this->instantiateOSTSDKForV2Api();
    $transactionsService = $ostObj->services->transactions;
    $executeParams = array();
    $executeParams['user_id'] = $this->environmentVariables['companyUserId'];
    $executeParams['to'] = $this->environmentVariables['ruleAddress'];
    $rawCallData = array();
    $transferTo = array($this->environmentVariables['user2TokenHolderAddress']);
    $transferAmount = array("1");
    $rawCallData['method'] = 'directTransfers';
    $rawCallData['parameters'] = array($transferTo, $transferAmount);
    $executeParams['raw_calldata'] = json_encode($rawCallData);
    $response = $transactionsService->execute($executeParams)->wait();
    $this->isSuccessResponse($response);
  }

}
