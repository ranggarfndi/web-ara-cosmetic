<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedeemOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'points_required',
        'is_active',
    ];
}
