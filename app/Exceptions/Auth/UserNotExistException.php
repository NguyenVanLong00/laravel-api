<?php

namespace App\Exceptions\Auth;

use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserNotExistException extends Exception
{
    public function __construct(string $message = "User not found", int $code = ResponseAlias::HTTP_NOT_FOUND)
    {
        parent::__construct(message: $message, code: $code);
    }
}
