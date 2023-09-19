<?php

namespace App\Exceptions\Auth;

use App\Exceptions\AppException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserNotExistAppException extends AppException
{
    public function __construct(string $message = "User not found", int $code = ResponseAlias::HTTP_NOT_FOUND)
    {
        parent::__construct(message: $message, code: $code);
    }
}
