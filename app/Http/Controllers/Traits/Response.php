<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait Response
{
    public function response($data = null, string $message = "", int $code = ResponseAlias::HTTP_OK): JsonResponse
    {
        return response()->json(
            data: [
                'data' => $data,
                'message' => $message
            ],
            status: $code);
    }
}