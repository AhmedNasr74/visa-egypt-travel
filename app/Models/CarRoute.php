<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarRoute extends Model
{
    protected $fillable = [
        'pickup_location_id',
        'destination_id',
        'airport_limo',
        'travel_limo',
        'city_ride_limo',
    ];

    protected $casts = [
        'airport_limo' => 'boolean',
        'travel_limo' => 'boolean',
        'city_ride_limo' => 'boolean',
        'supports_one_way' => 'boolean',
        'supports_round_trip' => 'boolean',
    ];

    public function pickup(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'pickup_location_id');
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'destination_id');
    }

    public function prices(): HasMany
    {
        return $this->hasMany(CarRoutePrice::class);
    }

    public function stops(): HasMany
    {
        return $this->hasMany(CarRouteStop::class);
    }
}
