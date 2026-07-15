<?php

namespace App\Enums;

enum InventoryTransactionTypeEnum:string
{
    case MATERIAL_RECEIVED='material_received';

    case MATERIAL_RESERVED='material_reserved';

    case MATERIAL_CONSUMED='material_consumed';

    case MATERIAL_RETURNED='material_returned';

    case FINISHED_GOODS_PRODUCED='finished_goods_produced';

    case MANUAL_ADJUSTMENT='manual_adjustment';
}
