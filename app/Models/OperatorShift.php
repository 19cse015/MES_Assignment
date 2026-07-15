<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatorShift extends Model
{
    use HasFactory;

    protected $fillable = [
        'operator_id',
        'shift_id',
        'work_date',
    ];

    protected $casts = [
        'work_date' => 'date',
    ];

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
