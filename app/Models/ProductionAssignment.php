<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionAssignment extends Model
{
     use HasFactory;

    protected $fillable = [
        'production_order_id',
        'machine_id',
        'workstation_id',
        'operator_id',
        'status',
        'assigned_at',
        'released_at',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'released_at' => 'datetime',
    ];

    public function productionOrder()
    {
        return $this->belongsTo(ProductionOrder::class);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function workstation()
    {
        return $this->belongsTo(Workstation::class);
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }
}
