<?php

namespace App\Models;

use App\Models\Traits\Relationships\BelongToUniversity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    use BelongToUniversity;
}
