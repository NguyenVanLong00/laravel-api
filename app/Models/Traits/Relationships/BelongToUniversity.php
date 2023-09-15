<?php

namespace App\Models\Traits\Relationships;

use App\Models\University;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongToUniversity
{
    /**
     * @return BelongsTo
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }
}
