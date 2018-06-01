<?php
/**
 * Transactions class
 */

namespace OST\V1;

use OST\Base;

/**
 * Class encapsulating methods to interact with V1 API's for Transactions module
 */
class Transactions extends Base
{
    const PREFIX = '/transactions';

    /**
     * Execute a Transaction
     *
     * @param array $params params for executing a Transaction
     *
     * @return object
     *
     */
    public function execute(array $params = array())
    {
        return $this->requestObj->post($this->getPrefix() . '/', $params);
    }

    /**
     * List Transactions
     *
     * @param array $params params for fetching Transactions list
     *
     * @return object
     *
     */
    public function getList(array $params = array())
    {
        return $this->requestObj->get($this->getPrefix() . '/', $params);
    }

    /**
     * Get Transaction details
     *
     * @param array $params params for fetching details of a Transaction
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
