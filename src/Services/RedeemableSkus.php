<?php
/**
 * RedeemableSkus class
 */

namespace OST;

use OST\Base;

/**
 * Class encapsulating methods to interact with API's for RedeemableSkus module
 */
class RedeemableSkus extends Base
{

  const PREFIX = '/redeemable-skus';

  /**
   * List RedeemableSkus
   *
   * @param array $params params for fetching redeemable skus list
   *
   * @return object
   *
   */
  public function getList(array $params = array())
  {
    return $this->requestObj->get($this->getPrefix() . '/', $params);
  }

  /**
   * Get RedeemableSku details of a uuid
   *
   * @param array $params params for fetching details of a redeemable sku
   *
   * @return object
   *
   */
  public function get(array $params = array())
  {
    return $this->requestObj->get($this->getPrefix() . '/' . $this->getRedeemableSkuId($params) . '/', $params);
  }

}
