<?php

namespace App\Exceptions\Auth;

use App\Exceptions\AppException;

class WrongPasswordAppException extends AppException
{
    public function __construct(string $message = "Wrong password", int $code = 401)
    {
        parent::__construct(message: $message, code: $code);
    }
}
