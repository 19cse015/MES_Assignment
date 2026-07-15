<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishedGoodsInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'available_quantity',
    ];

    protected $casts = [
        'available_quantity' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
