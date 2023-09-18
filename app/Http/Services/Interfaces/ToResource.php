<?php

namespace App\Http\Services\Interfaces;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\Paginator;

interface ToResource
{
    public function resource(): string;

    public function collection(): string;

    public function toResource($record): JsonResource;

    public function toCollection($collection): ResourceCollection;

    // public function toPagiate($pagianate): Paginator;
}
