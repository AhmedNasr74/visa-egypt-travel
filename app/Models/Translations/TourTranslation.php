<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class TourTranslation extends Model
{
    protected $fillable = [
        'title',
        'overview',
        'highlights',
        'included',
        'excluded',
        'duration',
        'type',
        'run',
        'pickup_time',
        'prices',
        'pricing_policy',
        'children_policy',
        'cancellation_policy',
        'deposit_payment',
    ];

    public $timestamps = false;
}
