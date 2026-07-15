<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_order_id',
        'material_id',
        'reserved_quantity',
        'status',
        'reserved_at',
    ];

    protected $casts = [
        'reserved_quantity' => 'decimal:2',
        'reserved_at'       => 'datetime',
    ];

    public function productionOrder()
    {
        return $this->belongsTo(ProductionOrder::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
