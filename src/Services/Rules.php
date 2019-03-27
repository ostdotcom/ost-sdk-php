<?php
/**
 * Rules class
 */

namespace OST;

use OST\Base;

/**
 * Class encapsulating methods to interact with API's for Rules module
 */
class Rules extends Base
{
    const PREFIX = '/rules';

    /**
     * List Rules
     *
     * @param array $params params for fetching List Rules
     *
     * @return object
     *
     */
    public function getList(array $params = array())
    {
        return $this->requestObj->get($this->getPrefix() . '/', $params);
    }
}
