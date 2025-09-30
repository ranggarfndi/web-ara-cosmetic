<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PointHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'purchase_amount',
        'points_earned',
        'transaction_date',
    ];

    /**
     * Get the customer that owns the PointHistory
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
