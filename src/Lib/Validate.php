<?php
/**
 * contains Validate class
 */

namespace Lib;

/**
 * Class encapsulating basic validation logic
 */
class Validate
{
    /**
     * Check if input is present
     *
     * @param object $params object containing request params
     *
     * @return boolean
     */
    public static function isPresent($params)
    {
        return $params !== null && !empty($params);
    }
}
