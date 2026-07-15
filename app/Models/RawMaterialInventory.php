<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialInventory extends Model
{
     use HasFactory;

    protected $fillable = [
        'material_id',
        'available_quantity',
        'reserved_quantity',
    ];

    protected $casts = [
        'available_quantity' => 'decimal:2',
        'reserved_quantity'  => 'decimal:2',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
