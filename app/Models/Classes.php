<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Classes extends Model
{
    use HasFactory;

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
        'name',
        'start_at',
        'end_at'
    ];

    /**
     * Start relationships
     */

    /**
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function classStudents(): HasMany
    {
        return $this->hasMany(ClassStudent::class, 'class_id', 'id');
    }

    public function students(){
        return $this->belongsToMany(Student::class,ClassStudent::class);
    }

    /**
     * @return HasManyThrough
     */
    public function transcripts(): HasManyThrough
    {
        return $this->hasManyThrough(Transcript::class, ClassStudent::class,
            'class_id',
            'class_student_id',
            'id',
            'id');
    }


    /**
     * End relationships
     */
}
