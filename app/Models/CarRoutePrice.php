<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarRoutePrice extends Model
{
    protected $fillable = [
        'car_route_id',
        'price_group_index',
        'car_type',
        'from',
        'to',
        'oneway_price',
        'rounded_price',
        'limo_city_hours',
    ];


    protected $casts = [
        'price_group_index' => 'integer',
        'from' => 'integer',
        'to' => 'integer',
        'oneway_price' => 'float',
        'rounded_price' => 'float',
    ];

    /**
     * City-ride duration rows (dashboard + public limo city tab), not airport/travel pax bands.
     */
    public function isLimoCityPackage(): bool
    {
        if ($this->limo_city_hours !== null && $this->limo_city_hours !== '') {
            return true;
        }

        $tierTypes = array_keys(config('car_transport.car_ride_tier_hours', []));

        return in_array($this->car_type, $tierTypes, true);
    }

    public function carRoute(): BelongsTo
    {
        return $this->belongsTo(CarRoute::class);
    }
}
