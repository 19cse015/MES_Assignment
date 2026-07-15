<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workstation extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'capacity',
    ];

    public function assignments()
    {
        return $this->hasMany(ProductionAssignment::class);
    }
}
