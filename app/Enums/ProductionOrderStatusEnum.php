<?php

namespace App\Enums;

enum ProductionOrderStatusEnum:string
{
    case DRAFT='draft';

    case PLANNED='planned';

    case RELEASED='released';

    case IN_PRODUCTION='in_production';

    case COMPLETED='completed';

    case CLOSED='closed';

    case CANCELLED='cancelled';
}
