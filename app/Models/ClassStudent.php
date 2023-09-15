<?php

namespace App\Models;

use App\Models\Traits\Relationships\BelongToClass;
use App\Models\Traits\Relationships\BelongToStudent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassStudent extends Model
{
    use HasFactory;

    use BelongToStudent, BelongToClass;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_at',
        'end_at'
    ];

    /**
     * Start relationships
     */

    /**
     * End relationships
     */
}
