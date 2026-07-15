<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefreshToken extends Model
{
    protected $fillable = [

        'user_id',

        'device_name',

        'token',

        'expires_at',

        'last_used_at',

        'revoked'

    ];

    protected $casts = [

        'expires_at'=>'datetime',

        'last_used_at'=>'datetime',

        'revoked'=>'boolean'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
