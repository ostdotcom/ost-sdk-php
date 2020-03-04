<?php
/**
 * Created by PhpStorm.
 * User: tejassangani
 * Date: 2019-03-05
 * Time: 16:05
 */
use PHPUnit\Framework\TestCase;

class ServiceTestBase extends TestCase
{

  public $environmentVariables;

  public $ostObj;

  function __construct()
  {
    $this->environmentVariables = $this->setEnvironmentVariables();
    $this->ostObj = $this->instantiateOSTSDKForV2Api();
    parent::__construct();
  }
  /**
   *
   * Instantiate OSTKYCSDK to interact with V2 API's
   *
   * @throws Exception
   */
  public function instantiateOSTSDKForV2Api()
  {
    $sdkInitParams = array();
    $sdkInitParams['apiKey'] = getenv('OST_KIT_API_KEY');
    $sdkInitParams['apiSecret'] = getenv('OST_KIT_API_SECRET');
    $sdkInitParams['apiBaseUrl'] = getenv('OST_KIT_API_ENDPOINT');
    return new OSTSdk($sdkInitParams);
  }

  /**
   *
   * Instantiate OSTKYCSDK to interact with V2 API's
   *
   * @throws Exception
   */
  public function setEnvironmentVariables()
  {

    $tempEnvironmentVariables = array();
    $tempEnvironmentVariables['userId'] = getenv('OST_KIT_USER_ID');
    $tempEnvironmentVariables['auxChainId'] = getenv('OST_KIT_AUX_CHAIN_ID');
    $tempEnvironmentVariables['deviceUserAddress'] = getenv('OST_KIT_USER_DEVICE_ADDRESS');

    $tempEnvironmentVariables['recoveryOwnerAddress'] = getenv('OST_KIT_RECOVERY_OWNER_ADDRESS');
    $tempEnvironmentVariables['sessionAddress'] = getenv('OST_KIT_SESSION_ADDRESS');
    $tempEnvironmentVariables['ruleAddress'] = getenv('OST_KIT_RULE_ADDRESS');

    $tempEnvironmentVariables['user2TokenHolderAddress'] = getenv('OST_KIT_USER2_TOKEN_HOLDER_ADDRESS');
    $tempEnvironmentVariables['transactionId'] = getenv('OST_KIT_TRANSACTION_ID');
    $tempEnvironmentVariables['redemptionId'] = getenv('OST_KIT_REDEMPTION_ID');
    $tempEnvironmentVariables['redeemableSkuId'] = getenv('OST_KIT_REDEEMABLE_SKU_ID');
    $tempEnvironmentVariables['companyUserId'] = getenv('OST_KIT_COMPANY_USER_ID');
    return $tempEnvironmentVariables;
  }

  /**
   *
   * Is Valid Success Response
   *
   * @param $response
   *
   */
  public function isSuccessResponse($response)
  {
    $this->assertArrayHasKey('success', $response);
    $this->assertTrue($response['success'] == true);
  }

  /**
   *
   * Is Valid Faliure Response
   *
   * @param $response
   *
   */
  public function isFaliureResponse($response)
  {
    $this->assertArrayHasKey('success', $response);
    $this->assertTrue($response['success'] == false);
  }

  /**
   *
   * Is UnProcessable Entity
   *
   * @param $response
   *
   */
  public function isUnprocessableEntity($response)
  {
    if ($response['success'] == false) {
      $this->assertEquals($response['err']['code'], "UNPROCESSABLE_ENTITY");
    }
  }

  /**
   *
   * Generate Random Address
   *
   */
  public function generateRandomAddress() {
    $characters = '0123456789abcdefABCDEF';
    $charactersLength = strlen($characters);
    $randomString = "";
    for ($i = 0; $i < 40; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return "0x".$randomString;
  }

}
