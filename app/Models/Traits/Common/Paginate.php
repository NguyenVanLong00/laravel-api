<?php

namespace App\Models\Traits\Common;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

trait Paginate
{
    /**
     * @param Builder $builder
     * @param array $params
     * @return void
     */
    public function scopePaginate(Builder $builder, array $params): void
    {
        $page = Arr::get($params, 'page', 1);
        $perPage = Arr::get($params, 'per_page', 15);

        $builder->simplePaginate(perPage: $perPage, page: $page);
    }
}