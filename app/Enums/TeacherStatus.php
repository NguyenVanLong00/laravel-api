<?php

namespace App\Enums;


enum TeacherStatus: int
{
    case INACTIVE = 0;
    case ACTIVE = 1;
    case PENDING = 2;
}
