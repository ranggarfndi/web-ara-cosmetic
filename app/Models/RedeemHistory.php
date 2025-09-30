<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RedeemHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'redeem_option_id',
        'points_spent',
        'redeem_date',
    ];

    /**
     * Get the customer that owns the RedeemHistory
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the redeemOption that for the RedeemHistory
     */
    public function redeemOption(): BelongsTo
    {
        return $this->belongsTo(RedeemOption::class);
    }
}
