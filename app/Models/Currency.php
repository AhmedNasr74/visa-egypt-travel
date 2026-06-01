<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'name',
        'symbol',
        'exchange_rate',
        'default',
    ];

    protected $casts = [
        'default' => 'boolean'
    ];

    public function name(): Attribute
    {
        return new Attribute(
            get: fn($value) => strtoupper($value),
            set: fn($value) => strtoupper($value),
        );
    }
}
