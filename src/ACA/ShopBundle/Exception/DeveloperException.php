<?php

namespace ACA\ShopBundle\Exception;

use \Exception as Exception;

/**
 * Class DeveloperException is thrown when there is a valid exception developers need to know about
 *
 * @package ACA\ShopBundle\Exception
 */
class DeveloperException extends Exception
{
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        // Log the error as it came in
        $this->log($message);

        /** @var string $message Override the developer message with a default message to the user */
        $message = 'An error has occurred, we are working on it!';

        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    /**
     * Log this exception so we can analyze the problem
     * @param string $message Message to log
     * @return void
     * @todo make this happen
     */
    protected function log($message)
    {

    }
}