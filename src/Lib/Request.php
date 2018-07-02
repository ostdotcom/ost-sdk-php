<?php
/**
 * Request class
 */

namespace Lib;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Promise;

/**
 * Class encapsulating logic to fire HTTP GET & POST Requests
 */
class Request
{
    /** @var array OST REST base URL */
    private $baseUrl;
    /** @var string OST KIT API key */
    private $apiKey;
    /** @var string OST KIT API secret */
    private $apiSecret;

    /**
     * Constructor
     *
     * @param array $params Array containing the necessary params {
     * @type string $apiKey API Key.
     * @type string $apiSecret API Secret.
     * @type string $baseUrl Base API URL.
     * }
     *
     * @throws \Exception
     *
     */
    public function __construct(array $params)
    {
        if (!Validate::isPresent($params['apiKey']) ||
            !Validate::isPresent($params['apiSecret']) ||
            !Validate::isPresent($params['apiBaseUrl'])) {

            throw new \Exception('mandatory param missing in constructor args');

        }

        $this->apiKey = $params['apiKey'];
        $this->apiSecret = $params['apiSecret'];

        $this->baseUrl = $this->sanitizeApiBaseUrl($params['apiBaseUrl']);

    }

    /**
     * Send a GET request
     *
     * @param string $endpoint endpoint to the GET request
     * @param array $arguments optional object containing params which are to be sent across in the GET request
     *
     * @return object
     *
     */
    public function get($endpoint, array $arguments = array())
    {
        $argsCopy = $this->copyAndSanitizeArgs($arguments);

        // build Path to hit by appending query params and signature
        $urlPath = $endpoint . '?' . http_build_query($argsCopy, '', '&');
        $urlPath = $urlPath . '&signature=' . hash_hmac('sha256', $urlPath, $this->apiSecret);

        /** @var Promise $promise */
        $promise = $this->getRequestClient()->getAsync(substr($urlPath, 1), $this->getCommonRequestParams());

        return $promise->then(
        // $onFulfilled
            function ($response) {
                return $this->parseResponse($response);
            },
            // $onRejected
            function ($reason) {
                return $this->customGenericErrorResponse('g_1');
            }
        );

    }

    /**
     * Send a POST request
     *
     * @param string $endpoint endpoint to the GET request
     * @param array $arguments optional object containing params which are to be sent across in the GET request
     *
     * @return object
     *
     */
    public function post($endpoint, array $arguments = array())
    {
        $argsCopy = $this->copyAndSanitizeArgs($arguments);

        // sanitize request params
        $query = $endpoint . '?' . http_build_query($argsCopy, '', '&');
        $query = str_replace('%5B0%5D', '[]', $query);

        $argsCopy['signature'] = hash_hmac('sha256', $query, $this->apiSecret);

        $postParams = $this->getCommonRequestParams();
        $postParams['body'] = http_build_query($argsCopy, '', '&');

        /** @var Promise $promise */
        $promise = $this->getRequestClient()->postAsync(substr($endpoint, 1), $postParams);

        return $promise->then(
        // $onFulfilled
            function ($response) {
                return $this->parseResponse($response);
            },
            // $onRejected
            function ($reason) {
                return $this->customGenericErrorResponse('p_1');
            }
        );
    }


    /**
     * sanitize API Base URL
     *
     * @param string $apiBaseUrl api base url
     *
     * @return string
     *
     */
    private function sanitizeApiBaseUrl($apiBaseUrl)
    {

      // append a trailing / to apiEndpoint (if required)
      // NOTE: As Guzzle remove "v1" from base url if ending slash is not present
      if ($apiBaseUrl[strlen($apiBaseUrl) - 1] !== '/') {
        $apiBaseUrl .= '/';
      }

      return $apiBaseUrl;

    }

    /**
     * Parse response of GET / POST requests
     *
     * @param object $response response obj of HTTP request
     *
     * @return object
     *
     */
    private function parseResponse($response)
    {
        $jsonObject = $this->parseJsonString($response->getBody());
        if ($this->isInternalResponse($jsonObject)) {
            return $jsonObject;
        }

        return $this->customErrorResponse($response->getStatusCode());
    }

    /**
     * Generic Something Went Wrong Response
     *
     * @param string $internal_id
     *
     * @return object
     *
     */
    private function customGenericErrorResponse($internal_id)
    {
        $strResponse = "{\"success\": false, \"err\": {\"code\": \"SOMETHING_WENT_WRONG\", \"internal_id\": \"SDK({$internal_id})\", \"msg\": \"\", \"error_data\":[]}}";
        return $this->parseJsonString($strResponse);
    }

    /**
     * returns error Response depending on HTTP status code of response
     *
     * @param integer $statusCode HTTP response code
     *
     * @return object
     *
     */
    private function customErrorResponse($statusCode)
    {
        switch ($statusCode) {
            case 400:
                $strResponse = '{"success": false, "err": {"code": "BAD_REQUEST", "internal_id": "SDK(BAD_REQUEST)", "msg": "", "error_data":[]}}';
                break;
            case 429:
                $strResponse = '{"success": false, "err": {"code": "TOO_MANY_REQUESTS", "internal_id": "SDK(TOO_MANY_REQUESTS)", "msg": "", "error_data":[]}}';
                break;
            case 502:
                $strResponse = '{"success": false, "err": {"code": "BAD_GATEWAY", "internal_id": "SDK(BAD_GATEWAY)", "msg": "", "error_data":[]}}';
                break;
            case 503:
                $strResponse = '{"success": false, "err": {"code": "SERVICE_UNAVAILABLE", "internal_id": "SDK(SERVICE_UNAVAILABLE)", "msg": "", "error_data":[]}}';
                break;
            case 504:
                $strResponse = '{"success": false, "err": {"code": "GATEWAY_TIMEOUT", "internal_id": "SDK(GATEWAY_TIMEOUT)", "msg": "", "error_data":[]}}';
                break;
            default:
                $strResponse = '{"success": false, "err": {"code": "SOMETHING_WENT_WRONG", "internal_id": "SDK(SOMETHING_WENT_WRONG)", "msg": "", "error_data":[]}}';
        }

        return $this->parseJsonString($strResponse);

    }

    /**
     * parse string to a JSON object
     *
     * @param string $strResponse string which would be type casted to json object
     *
     * @return object
     *
     */
    private function parseJsonString($strResponse)
    {
        try {
            $jsonObject = json_decode($strResponse, true);
        } catch (\Exception $e) {
            $jsonObject = $this->customGenericErrorResponse('pjs_1');
        }
        return $jsonObject;
    }

    /**
     * check if json object was created from an internal response string
     *
     * @param object $jsonObject json object
     *
     * @return boolean
     *
     */
    private function isInternalResponse($jsonObject)
    {
        return isset($jsonObject['success']);
    }

    /**
     * copy over the passed input args and process
     *
     * @param array $arguments json object
     *
     * @return array
     *
     */
    private function copyAndSanitizeArgs(array $arguments)
    {

        // create copy of input array to not modify it
        $argsCopy = $arguments;

        // append basic params
        $argsCopy['api_key'] = $this->apiKey;
        $argsCopy['request_timestamp'] = time();

        // sort by key name
        ksort($argsCopy);

        return $argsCopy;

    }

    /**
     * create a client object for firing HTTP request
     *
     * @return object
     *
     */
    private function getRequestClient()
    {
        return new Client([
            'base_uri' => $this->baseUrl
        ]);

    }

    /**
     * returns common params for GET & POST requests
     *
     * @return array
     *
     */
    private function getCommonRequestParams()
    {
        return [
            'headers' => [
                'User-Agent' => 'ost-sdk-php', // add version to it
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'http_errors' => false,
            'connect_timeout' => 10,
            'open_timeout' => 10
        ];

    }
}
