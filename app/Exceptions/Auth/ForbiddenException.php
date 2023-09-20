<?php

namespace App\Exceptions\Auth;

use App\Exceptions\AppException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ForbiddenException extends AppException
{
    public function __construct(string $message = "forbidden", int $code = ResponseAlias::HTTP_FORBIDDEN)
    {
        parent::__construct(message: $message, code: $code);
    }
}
