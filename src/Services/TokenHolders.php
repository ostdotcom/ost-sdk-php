<?php
/**
 * TokenHolders class
 */

namespace OST;

use OST\Base;

/**
 * Class encapsulating methods to interact with API's for Token Holders module
 */
class TokenHolders extends Base
{

    const PREFIX = '/users';
    const SUFFIX = '/token-holders';

    /**
     * Create a Token Holder
     *
     * @param array $params params for creating a token holder
     *
     * @return object
     *
     */
    public function create(array $params = array())
    {
      return $this->requestObj->post($this->getPrefix() . '/' . $this->getUserId($params) . $this->getSuffix() . '/', $params);
    }

    /**
     * Get token holder details
     *
     * @param array $params params for fetching details of a token holder
     *
     * @throws \Exception
     *
     * @return object
     *
     */
    public function get(array $params = array())
    {
      return $this->requestObj->get($this->getPrefix() . '/' . $this->getUserId($params) . $this->getSuffix() . '/', $params);
    }

}
