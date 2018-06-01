<?php
/**
 * Actions class
 */

namespace OST\V1;

use OST\Base;

/**
 * Class encapsulating methods to interact with V1 API's for Actions module
 */
class Actions extends Base
{
    const PREFIX = '/actions';

    /**
     * Create a action
     *
     * @param array $params params for creating an action
     *
     * @return object
     *
     */
    public function create(array $params = array())
    {
        return $this->requestObj->post($this->getPrefix() . '/', $params);
    }

    /**
     * Edit an action
     *
     * @param array $params params for editing an action
     *
     * @throws \Exception
     *
     * @return object
     *
     */
    public function edit(array $params = array())
    {
        return $this->requestObj->post($this->getPrefix() . '/' . $this->getId($params) . '/', $params);
    }

    /**
     * List actions
     *
     * @param array $params params for fetching actions list
     *
     * @return object
     *
     */
    public function getList(array $params = array())
    {
        return $this->requestObj->get($this->getPrefix() . '/', $params);
    }

    /**
     * Get action details
     *
     * @param array $params params for fetching details of an action
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
