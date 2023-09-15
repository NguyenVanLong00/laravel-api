<?php

namespace App\Models;

use App\Enums\TeacherStatus;
use App\Models\Traits\Relationships\BelongToUniversity;
use App\Models\Traits\Relationships\BelongToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Teacher extends Model
{
    use HasFactory;

    use BelongToUser, BelongToUniversity;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => TeacherStatus::class,
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position',
        'status',
        'start_at',
        'end_at'
    ];

    /**
     * Start relationships
     */

    /**
     * @return BelongsToMany
     */
    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(Classes::class, ClassTeacher::class);
    }

    /**
     * @return HasManyThrough
     */
    public function transcripts(): HasManyThrough
    {
        return $this->hasManyThrough(Transcript::class, ClassTeacher::class,
            'teacher_id',
            'class_teacher_id',
            'id',
            'id');
    }

    /**
     * End relationships
     */
}
