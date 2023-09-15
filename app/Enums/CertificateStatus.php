<?php

namespace App\Enums;


enum CertificateStatus: int
{
    case VALID = 0;
    case EXPIRED = 1;
    case PENDING = 2;
}
