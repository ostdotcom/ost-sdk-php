<?php
/**
 * Base tokens class
 */

namespace OST;

use OST\Base;

/**
 * Class encapsulating methods to interact with API's for Base Tokens module
 */
class BaseTokens extends Base
{
    const PREFIX = '/base-tokens';

    /**
     * Get base tokens details
     *
     * @param array $params params for fetching details of a base tokens
     *
     * @return object
     *
     */
    public function get(array $params = array())
    {
        return $this->requestObj->get($this->getPrefix() . '', $params);
    }
}
