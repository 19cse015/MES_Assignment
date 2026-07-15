<?php

namespace App\Enums;

enum MaterialReservationStatusEnum:string
{
    case PENDING='pending';

    case RESERVED='reserved';

    case CONSUMED='consumed';

    case RELEASED='released';

    case CANCELLED='cancelled';
}
