<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'birth_date',
        'email',
        'address',
        'total_points',
    ];

    /**
     * Get all of the pointHistories for the Customer
     */
    public function pointHistories(): HasMany
    {
        return $this->hasMany(PointHistory::class);
    }

    /**
     * Get all of the redeemHistories for the Customer
     */
    public function redeemHistories(): HasMany
    {
        return $this->hasMany(RedeemHistory::class);
    }

    /**
     * Get all of the customerVouchers for the Customer
     */
    public function customerVouchers(): HasMany
    {
        return $this->hasMany(CustomerVoucher::class);
    }
}
