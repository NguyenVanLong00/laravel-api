<?php

namespace App\Http\Services\Interfaces\Traits;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\Paginator;

trait Resource
{
    public function toResource($record): JsonResource {
        $class = $this->resource();

        return new $class($record);
    }

    public function toCollection($collection): ResourceCollection {
        $class = $this->collection();

        return new $class($collection);
        
    }

    // public function toPagiate($pagianate): Paginator {
    //     $class = $this->collection();

    //     $collection =  new $class($pagianate);
        
    //     return [

    //     ]; 
    // }
}
