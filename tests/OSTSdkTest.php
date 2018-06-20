<?php

use OST\V0\User;
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
     * Check if SDK object created to interact with V0 API's is valid
     *
     * @test
     *
     * @throws Exception
     */
    public function canCreateInstanceOfOSTSdkForV0Api()
    {
        $this->assertInstanceOf(
            OSTSdk::class,
            $this->instantiateOSTSdkForV0Api()
        );
    }

    /**
     *
     * Check if SDK object created to interact with V1 API's is valid
     *
     * @test
     *
     * @throws Exception
     */
    public function canCreateInstanceOfOSTSdkForV1Api()
    {
        $this->assertInstanceOf(
            OSTSdk::class,
            $this->instantiateOSTSdkForV1Api()
        );
    }

    /**
     *
     * Check if SDK object can fire a GET request for V0 API's
     *
     * @test
     *
     * @throws Exception
     */
    public function canFireGetRequestForV0()
    {
        $ostObj = $this->instantiateOSTSdkForV0Api();
        $userService = $ostObj->services->user;
        $response = $userService->getList()->wait();
        $this->isSuccessResponse($response);
    }

    /**
     *
     * Check if SDK object can fire a POST request for V0 API's
     *
     * @test
     *
     * @throws Exception
     */
    public function canFirePostRequestForV0()
    {
        $ostObj = $this->instantiateOSTSdkForV0Api();
        $userService = $ostObj->services->user;
        $createUserParams = array();
        $createUserParams['name'] = 'Test';
        $response = $userService->create($createUserParams)->wait();
        $this->isSuccessResponse($response);
    }

    /**
     *
     * Check if SDK object can fire a GET request for V1 API's
     *
     * @test
     *
     * @throws Exception
     */
    public function canFireGetRequestForV1()
    {
        $ostObj = $this->instantiateOSTSdkForV1Api();
        $userService = $ostObj->services->users;
        $response = $userService->getList()->wait();
        $this->isSuccessResponse($response);
    }

    /**
     *
     * Check if SDK object can fire a POST request for V1 API's
     *
     * @test
     *
     * @throws Exception
     */
    public function canFirePostRequestForV1()
    {
        $ostObj = $this->instantiateOSTSdkForV1Api();
        $userService = $ostObj->services->users;
        $createUserParams = array();
        $createUserParams['name'] = 'Test';
        $response = $userService->create($createUserParams)->wait();
        $this->isSuccessResponse($response);
    }

    /**
     *
     * Instantiate OSTSdk to interact with V0 API's
     *
     * @throws Exception
     */
    private function instantiateOSTSdkForV0Api()
    {
        $sdkInitParams = array();
        $sdkInitParams['apiKey'] = getenv('OST_KIT_API_KEY');
        $sdkInitParams['apiSecret'] = getenv('OST_KIT_API_SECRET');
        $sdkInitParams['apiBaseUrl'] = getenv('OST_KIT_API_ENDPOINT');
        return new OSTSdk($sdkInitParams);
    }

    /**
     *
     * Instantiate OSTSdk to interact with V1 API's
     *
     * @throws Exception
     */
    private function instantiateOSTSdkForV1Api()
    {
        $sdkInitParams = array();
        $sdkInitParams['apiKey'] = getenv('OST_KIT_API_KEY');
        $sdkInitParams['apiSecret'] = getenv('OST_KIT_API_SECRET');
        $sdkInitParams['apiBaseUrl'] = getenv('OST_KIT_API_V1_ENDPOINT');
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
