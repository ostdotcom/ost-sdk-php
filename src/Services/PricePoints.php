<?php
/**
 * PricePoints class
 */

namespace OST;

use OST\Base;

/**
 * Class encapsulating methods to interact with API's for Price Points module
 */
class PricePoints extends Base
{
    const PREFIX = '/chains';
    const SUFFIX = '/price-points';

    /**
     * Get token details
     *
     * @param array $params params for fetching details of a token
     *
     * @return object
     *
     */
    public function get(array $params = array())
    {
        return $this->requestObj->get($this->getPrefix() . '/' . $this->getChainId($params) . $this->getSuffix(). '/', $params);
    }
}