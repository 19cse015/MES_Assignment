<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'production_order_id',
        'material_id',
        'product_id',
        'transaction_type',
        'quantity',
        'remarks',
        'created_by',
        'created_at',
    ];

    protected $casts = [
        'quantity'   => 'decimal:2',
        'created_at' => 'datetime',

    ];

    public function productionOrder()
    {
        return $this->belongsTo(ProductionOrder::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
