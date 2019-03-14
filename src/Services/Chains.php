<?php
/**
 * Chains class
 */

namespace OST;

use OST\Base;

/**
 * Class encapsulating methods to interact with API's for Chains module
 */
class Chains extends Base
{

    const PREFIX = '/chains';

    /**
     * Get chain details
     *
     * @param array $params params for fetching details of a chain
     *
     * @throws \Exception
     *
     * @return object
     *
     */
    public function get(array $params = array())
    {
      return $this->requestObj->get($this->getPrefix() . '/' . $this->getChainId($params) . '/', $params);
    }

}
