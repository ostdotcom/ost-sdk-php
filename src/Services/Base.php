<?php
/**
 * contains Base class
 */

namespace OST;

use Lib\Request;
use Lib\Validate;
use RuntimeException;

/**
 * Base Class
 */
abstract class Base
{
    const PREFIX = '';

    /** @var Request request object which would fire API calls */
    protected $requestObj;

    /**
     * Constructor
     *
     * @param Request $requestObj request object which would fire API calls
     */
    public function __construct(Request $requestObj)
    {
        $this->requestObj = $requestObj;
    }

    /**
     * @return string
     * @throws RuntimeException
     */
    protected function getPrefix()
    {
        if (empty(static::PREFIX)) {
            throw new RuntimeException('Prefix must be defined in class: ' . get_class($this));
        }

        return static::PREFIX;
    }

    /**
     * getId from params array
     *
     * @param array $params request object which would fire API calls
     *
     * @throws \Exception
     *
     * @return string
     */
    protected function getId(array $params)
    {
        if (Validate::isPresent($params['id'])) {
            return urlencode($params['id']);
        }

        throw new \Exception('id missing in request params');
    }
}
