<?php

namespace App\Enums;

enum Token: string
{
    case ACCESS_TOKEN = 'access_token';
    case REFRESH_TOKEN = 'refresh_token';
}
