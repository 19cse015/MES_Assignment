<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'product_id',
        'bom_id',
        'created_by',
        'quantity',
        'status',
        'remarks',
        'planned_at',
        'released_at',
        'started_at',
        'completed_at',
        'closed_at',
        'cancelled_at',
    ];

    protected $casts = [
        'planned_at'    => 'datetime',
        'released_at'   => 'datetime',
        'started_at'    => 'datetime',
        'completed_at'  => 'datetime',
        'closed_at'     => 'datetime',
        'cancelled_at'  => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function bom()
    {
        return $this->belongsTo(Bom::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function schedule()
    {
        return $this->hasOne(ProductionSchedule::class);
    }

    public function productionAssignments()
    {
        return $this->hasMany(ProductionAssignment::class);
    }

    public function materialReservations()
    {
        return $this->hasMany(MaterialReservation::class);
    }

    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class);
    }

    public function batches()
    {
        return $this->hasMany(FinishedGoodBatch::class);
    }

    public function qualityInspection()
    {
        return $this->hasOne(QualityInspection::class);
    }
}
