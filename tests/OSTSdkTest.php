<?php

use OST\User;
use PHPUnit\Framework\TestCase;

final class OSTSdkTest extends TestCase
{
  /**
   *
   * override setUp() to load environment variables from .env.example file for non TRAVIS environment
   *
   * @throws Exception
   */
    protected function setUp()
    {
        if (getenv('BUILD_ENV') !== 'TRAVIS') {
            $dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
            $dotenv->load();
        }
        parent::setUp();
    }

    /**
     *
     * Check if SDK object can fire a GET request
     *
     * @test
     *
     * @throws Exception
     */
    public function canFireGetRequest()
    {
        $ostObj = $this->instantiateOSTSdk();
        $tokensService = $ostObj->services->tokens;
        $response = $tokensService->get()->wait();
        var_dump($response);
        $this->isSuccessResponse($response);
    }

//    /**
//     *
//     * Check if SDK object can fire a POST request
//     *
//     * @test
//     *
//     * @throws Exception
//     */
//    public function canFirePostRequest()
//    {
//        $ostObj = $this->instantiateOSTSdk();
//        $userService = $ostObj->services->users;
//        $createUserParams = array();
//        $createUserParams['name'] = 'Test';
//        $response = $userService->create($createUserParams)->wait();
//        $this->isSuccessResponse($response);
//    }

    /**
     *
     * Instantiate OSTSdk to interact with API's
     *
     * @throws Exception
     */
    private function instantiateOSTSdk()
    {
        $sdkInitParams = array();
        $sdkInitParams['apiKey'] = getenv('OST_KIT_API_KEY');
        $sdkInitParams['apiSecret'] = getenv('OST_KIT_API_SECRET');
        $sdkInitParams['apiBaseUrl'] = getenv('OST_KIT_SANDBOX_API_ENDPOINT');
        return new OSTSdk($sdkInitParams);
    }

    /**
     *
     * Is Valid Success Response
     *
     * @param $response
     *
     */
    private function isSuccessResponse($response)
    {
        $this->assertArrayHasKey('success', $response);
        $this->assertTrue($response['success'] == true);
    }

}
