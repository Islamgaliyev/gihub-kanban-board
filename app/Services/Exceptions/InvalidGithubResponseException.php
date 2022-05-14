<?php

namespace App\Services\Exceptions;

use Throwable;

class InvalidGithubResponseException extends \Exception
{
    public function __construct($message = "Invalid GitHub response.", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
