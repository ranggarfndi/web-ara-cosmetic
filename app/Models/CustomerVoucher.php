<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerVoucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'voucher_code',
        'description',
        'expiry_date',
        'is_used',
    ];

    /**
     * Get the customer that owns the CustomerVoucher
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
