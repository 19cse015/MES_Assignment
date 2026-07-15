<?php

namespace App\Enums;

enum RoleEnum:string
{
    case SYSTEM_ADMIN='system_admin';

    case PRODUCTION_MANAGER='production_manager';

    case WAREHOUSE_MANAGER='warehouse_manager';

    case MACHINE_OPERATOR='machine_operator';

    case QUALITY_INSPECTOR='quality_inspector';
}
