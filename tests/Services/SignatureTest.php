<?php
/**
 * Created by PhpStorm.
 * User: tejassangani
 * Date: 2019-03-06
 * Time: 01:26
 */

use \Lib\Request;

$filepath = realpath (dirname(__FILE__));
require_once($filepath."/ServiceTestBase.php");

final class SignatureTest extends ServiceTestBase
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
    $params = array();
    $params['a'] = null;
    $params['b'] = array();
    $params['c'] = "";
    $params['d'] = array(null, "");
    $params['e'] = array();
    $params['arrayValues'] = array("Hello", "There", "12345");
    $params['k1'] = 125.45;
    $params['k2'] = "Tejas";

    $hashWithKeyValue1 = array();
    $hashWithKeyValue1['a'] = "L21A";
    $hashWithKeyValue1['b'] = "L21B";

    $hashWithKeyValue2 = array();
    $hashWithKeyValue2['a'] = "L22A";
    $hashWithKeyValue2['b'] = "L22B";

    $hashWithKeyValue3 = array();
    $hashWithKeyValue3['a'] = "L23A";
    $hashWithKeyValue3['b'] = "L23B";

    $nestedparams = array();
    $nestedparams['a'] = $hashWithKeyValue1;
    $nestedparams['b'] = $hashWithKeyValue2;
    $nestedparams['c'] = $hashWithKeyValue3;

    $params["aaaaa"] = $nestedparams;
    $params["garbage_str"] = "~!@#$%^&*()_+-= {}[]:\";'?/<>,. this is garbage";

    $ostparams = array();
    $ostparams['apiKey'] = "b921b46142cbfbea3328d9d257ac5b0d";
    $ostparams['apiSecret'] = "a0431203671f42c079b2154066fd04ba";
    $ostparams['apiBaseUrl'] = "https://api.ost.com/mainnet/v2/";
    $obj = new Request($ostparams);
    $endpoint = "/api/v2/users";
    $argsCopy = $obj->build_nested_query($params, '');
    $stringToSign = $endpoint . '?' . $argsCopy;

    $signature = $obj->getSignature($stringToSign);
    $this->assertTrue($signature == "28664cdbc613b66835d7bcf825dce719fb8e0621992c291ba9bd1767c1c5560d");
  }

}
