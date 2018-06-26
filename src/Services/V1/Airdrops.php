<?php
/**
 * Airdrops class
 */

namespace OST\V1;

use OST\Base;

/**
 * Class encapsulating methods to interact with V1 API's for Airdrops module
 */
class Airdrops extends Base
{
    const PREFIX = '/airdrops';

    /**
     * Execute an airdrop
     *
     * @param array $params params for executing an airdrop
     *
     * @return object
     *
     */
    public function execute(array $params = array())
    {
        return $this->requestObj->post($this->getPrefix() . '/', $params);
    }

    /**
     * List airdrops
     *
     * @param array $params params for fetching airdrops list
     *
     * @return object
     *
     */
    public function getList(array $params = array())
    {
        return $this->requestObj->get($this->getPrefix() . '/', $params);
    }

    /**
     * Get airdrop details
     *
     * @param array $params params for fetching details of an airdrop
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
