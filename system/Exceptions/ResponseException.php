<?php

namespace System\Exceptions;

use Exception;
use Throwable;
class ResponseException extends Exception
{

    /**
     * @var $values
     */
    private $values;

    public function __construct($message = "", $code = 0, Throwable $previous = null, $values = [])
    {
        parent::__construct($message, $code, $previous);
        $this->values = $values;
    }

    public function getResponse()
    {
        return [
            'success' => $this->getCode(),
            'data'    => $this->values,
            'message' => $this->getMessage()
        ];
    }
}