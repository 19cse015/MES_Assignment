<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'code',
        'name',
        'unit',
    ];

    public function category()
    {
        return $this->belongsTo(MaterialCategory::class);
    }

    public function bomItems()
    {
        return $this->hasMany(BomItem::class);
    }

    public function inventory()
    {
        return $this->hasOne(RawMaterialInventory::class);
    }

    public function reservations()
    {
        return $this->hasMany(MaterialReservation::class);
    }

    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class);
    }
}
