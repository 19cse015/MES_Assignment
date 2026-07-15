<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityInspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_order_id',
        'inspector_id',
        'status',
        'result',
        'defect_quantity',
        'remarks',
        'inspected_at',
    ];

    protected $casts = [
        'defect_quantity' => 'integer',
        'inspected_at' => 'datetime',
    ];

    public function productionOrder()
    {
        return $this->belongsTo(ProductionOrder::class);
    }

    public function inspector()
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }
}
