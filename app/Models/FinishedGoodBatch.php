<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishedGoodBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'production_order_id',
        'product_id',
        'batch_number',
        'quantity',
        'manufactured_at',
    ];

    protected $casts = [
        'quantity'        => 'decimal:2',
        'manufactured_at' => 'datetime',
    ];

    public function productionOrder()
    {
        return $this->belongsTo(ProductionOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
