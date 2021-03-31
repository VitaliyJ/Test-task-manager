<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class RecordFailedException extends Exception
{
    public function __construct($message = "Record failed", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
