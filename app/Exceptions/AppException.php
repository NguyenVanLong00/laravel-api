<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AppException extends Exception
{
    public function __construct(string $message = "System Error", int $code = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR)
    {
        parent::__construct(message: $message, code: $code);
    }
}