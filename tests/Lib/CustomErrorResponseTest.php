<?php

namespace Tests\Lib;

use Lib\CustomErrorResponse;
use PHPUnit\Framework\TestCase;

class CustomErrorResponseTest extends TestCase
{
  /**
   * @dataProvider dataProviderCustomErrorResponse
   * @param $statusCode
   * @param $internalId
   * @param $expected
   */
  public function testJsonSerializeSucceeds($statusCode, $internalId, $expected)
  {
    $actual = json_encode(new CustomErrorResponse($statusCode, $internalId));
    $this->assertEquals($expected, $actual);
  }

  /**
   * @return array
   */
  public function dataProviderCustomErrorResponse()
  {
    return [
      [
        CustomErrorResponse::BAD_REQUEST,
        '',
        '{"success":false,"err":{"code":"BAD_REQUEST","internal_id":"SDK(BAD_REQUEST)","msg":"","error_data":[]}}',
      ],
      [
        CustomErrorResponse::TOO_MANY_REQUESTS,
        '',
        '{"success":false,"err":{"code":"TOO_MANY_REQUESTS","internal_id":"SDK(TOO_MANY_REQUESTS)","msg":"","error_data":[]}}',
      ],
      [
        CustomErrorResponse::BAD_GATEWAY,
        '',
        '{"success":false,"err":{"code":"BAD_GATEWAY","internal_id":"SDK(BAD_GATEWAY)","msg":"","error_data":[]}}',
      ],
      [
        CustomErrorResponse::SERVICE_UNAVAILABLE,
        '',
        '{"success":false,"err":{"code":"SERVICE_UNAVAILABLE","internal_id":"SDK(SERVICE_UNAVAILABLE)","msg":"","error_data":[]}}',
      ],
      [
        CustomErrorResponse::GATEWAY_TIMEOUT,
        '',
        '{"success":false,"err":{"code":"GATEWAY_TIMEOUT","internal_id":"SDK(GATEWAY_TIMEOUT)","msg":"","error_data":[]}}',
      ],
      [
        -1,
        '',
        '{"success":false,"err":{"code":"SOMETHING_WENT_WRONG","internal_id":"SDK(SOMETHING_WENT_WRONG)","msg":"","error_data":[]}}',
      ],
      [
        -1,
        'pjs_1',
        '{"success":false,"err":{"code":"SOMETHING_WENT_WRONG","internal_id":"SDK(pjs_1)","msg":"","error_data":[]}}',
      ]
    ];
  }
}
