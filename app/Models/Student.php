<?php

namespace App\Models;

use App\Models\Traits\Relationships\BelongToUniversity;
use App\Models\Traits\Relationships\BelongToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    use BelongToUser, BelongToUniversity;
}
