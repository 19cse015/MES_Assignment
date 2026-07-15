<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_order_id',
        'planned_start',
        'planned_end',
        'priority',
        'status',
    ];

    protected $casts = [
        'planned_start' => 'datetime',
        'planned_end'   => 'datetime',
    ];

    public function productionOrder()
    {
        return $this->belongsTo(ProductionOrder::class);
    }
}
