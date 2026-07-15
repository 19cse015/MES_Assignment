<?php

namespace App\Enums;

enum AssignmentStatusEnum:string
{
    case ASSIGNED='assigned';

    case IN_PROGRESS='in_progress';

    case RELEASED='released';

    case COMPLETED='completed';
}
