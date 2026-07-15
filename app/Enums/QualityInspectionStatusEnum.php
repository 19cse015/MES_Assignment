<?php

namespace App\Enums;

enum QualityInspectionStatusEnum: string
{
    case PENDING = 'pending';

    case INSPECTED = 'inspected';

    case APPROVED = 'approved';

    case REJECTED = 'rejected';

    case REWORK = 'rework';
}
