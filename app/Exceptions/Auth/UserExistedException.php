<?php

namespace App\Exceptions\Auth;

use App\Exceptions\AppException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserExistedException extends AppException
{
    public function __construct(string $message = "User existed", int $code = ResponseAlias::HTTP_BAD_REQUEST)
    {
        parent::__construct(message: $message, code: $code);
    }
}
