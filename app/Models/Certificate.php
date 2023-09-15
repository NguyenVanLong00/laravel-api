<?php

namespace App\Models;

use App\Models\Traits\Relationships\BelongToStudent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    use BelongToStudent;
}
