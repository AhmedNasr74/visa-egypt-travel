<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'nickname',
        'name',
        'email',
        'country_phone_code',
        'nationality',
        'hotel_choice',
        'phone',
        'adults',
        'children',
        'arrival_date',
        'departure_date',
        'days',
        'age_range',
        'notes',
        'hear_about_us',
        // Nile Cruise specific fields
        'cruise_type',
        'cruise_pick_drop_off',
        'cruise_duration',
        'budget_range'
    ];

    protected $casts = [
        'arrival_date' => 'date',
        'departure_date' => 'date'
    ];

    public function fullName(): Attribute
    {
        return new Attribute(get: fn() => $this->nickname . '. ' . $this->name);
    }
    public function phoneWithCode(): Attribute
    {
        return new Attribute(get: fn() => '('. $this->country_phone_code . ') ' . $this->phone);
    }
}
