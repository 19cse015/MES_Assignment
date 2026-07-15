<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     use HasFactory;

    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'specification',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function boms()
    {
        return $this->hasMany(Bom::class);
    }

    public function productionOrders()
    {
        return $this->hasMany(ProductionOrder::class);
    }

    public function finishedGoodsInventory()
    {
        return $this->hasOne(FinishedGoodsInventory::class);
    }

    public function batches()
    {
        return $this->hasMany(FinishedGoodBatch::class);
    }

    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class);
    }
}
