<?php

namespace App\Models\Traits\Common;

trait Duration
{
    function dutation() :array {
        return [
            'start_at' => 'datetime:Y-m-d H:i:s',
            'end_at' => 'datetime:Y-m-d H:i:s',
        ];
    }
}
