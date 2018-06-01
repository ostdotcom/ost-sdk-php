<?php
/**
 * Transfers class
 */

namespace OST\V1;

use OST\Base;

/**
 * Class encapsulating methods to interact with V1 API's for Transfers module
 */
class Transfers extends Base
{
    const PREFIX = '/transfers';

    /**
     * Execute a transfer
     *
     * @param array $params params for executing a transfer
     *
     * @return object
     *
     */
    public function execute(array $params = array())
    {
        return $this->requestObj->post($this->getPrefix() . '/', $params);
    }

    /**
     * List transfers
     *
     * @param array $params params for fetching transfers list
     *
     * @return object
     *
     */
    public function getList(array $params = array())
    {
        return $this->requestObj->get($this->getPrefix() . '/', $params);
    }

    /**
     * Get transfer details
     *
     * @param array $params params for fetching details of a transfer
     *
     * @throws \Exception
     *
     * @return object
     *
     */
    public function get(array $params = array())
    {
        return $this->requestObj->get($this->getPrefix() . '/' . $this->getId($params) . '/', $params);
    }
}
