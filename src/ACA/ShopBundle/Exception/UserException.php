<?php

namespace ACA\ShopBundle\Exception;

use \Exception as Exception;

/**
 * Class UserException gets thrown when there is a valid error caused by user action
 *
 * @package ACA\ShopBundle\Exception
 */
class UserException extends Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}