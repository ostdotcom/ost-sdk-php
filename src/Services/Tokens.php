<?php
/**
 * Tokens class
 */

namespace OST;

use OST\Base;

/**
 * Class encapsulating methods to interact with API's for Tokens module
 */
class Tokens extends Base
{
    const PREFIX = '/tokens';

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
        return $this->requestObj->get($this->getPrefix() . '', $params);
    }
}
