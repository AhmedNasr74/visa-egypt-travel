<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'title',
        'code',
        'active',
        'value',
        'discount_type',
        'start_date',
        'end_date',
        'limit_per_usage',
        'limit_per_customer',
    ];

    protected $casts=[
        'active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
