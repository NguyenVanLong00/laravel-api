<?php

namespace App\Models;

use App\Enums\CertificateStatus;
use App\Models\Traits\Relationships\BelongToStudent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Certificate extends Model
{
    use HasFactory;

    use BelongToStudent;


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => CertificateStatus::class,
        'grant_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'grant_at',
    ];

    /**
     * Start relationships
     */


    /**
     * @return BelongsTo
     */
    public function certification(): BelongsTo
    {
        return $this->belongsTo(Certification::class);
    }

    /**
     * @return BelongsToMany
     */
    public function transcripts() : BelongsToMany{
        return $this->belongsToMany(Transcript::class, CertificateTranscript::class);
    }

    /**
     * End relationships
     */
}
