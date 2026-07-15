<?php

namespace App\Enums;

enum BomStatusEnum:string
{
    case DRAFT='draft';

    case APPROVED='approved';

    case ARCHIVED='archived';
}
