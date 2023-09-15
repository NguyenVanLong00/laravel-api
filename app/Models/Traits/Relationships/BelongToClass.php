<?php

namespace App\Models\Traits\Relationships;

use App\Models\Classes;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongToClass
{
    /**
     * @return BelongsTo
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id','id');
    }
}
