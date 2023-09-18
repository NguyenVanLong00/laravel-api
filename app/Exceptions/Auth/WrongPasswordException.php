<?php

namespace App\Exceptions\Auth;

use Exception;

class WrongPasswordException extends Exception
{
    public function __construct(string $message = "Wrong password", int $code = 401)
    {
        parent::__construct(message: $message, code: $code);
    }
}
