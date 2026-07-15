<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'capacity',
        'operating_status',
        'maintenance_status',
    ];

    public function assignments()
    {
        return $this->hasMany(ProductionAssignment::class);
    }
}
