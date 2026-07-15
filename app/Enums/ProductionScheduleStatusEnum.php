<?php

namespace App\Enums;

enum ProductionScheduleStatusEnum:string
{
    case PENDING='pending';

    case SCHEDULED='scheduled';

    case RUNNING='running';

    case COMPLETED='completed';

    case CANCELLED='cancelled';
}
