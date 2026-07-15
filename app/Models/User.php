<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable([
    'role_id',
    'name',
    'email',
    'password',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function productionOrders()
    {
        return $this->hasMany(ProductionOrder::class, 'created_by');
    }

    public function approvedBoms()
    {
        return $this->hasMany(Bom::class, 'approved_by');
    }

    public function productionAssignments()
    {
        return $this->hasMany(ProductionAssignment::class, 'operator_id');
    }

    public function operatorShifts()
    {
        return $this->hasMany(OperatorShift::class, 'operator_id');
    }

    public function qualityInspections()
    {
        return $this->hasMany(QualityInspection::class, 'inspector_id');
    }

    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class, 'created_by');
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }

    public function refreshTokens()
    {
        return $this->hasMany(
            RefreshToken::class
        );
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
