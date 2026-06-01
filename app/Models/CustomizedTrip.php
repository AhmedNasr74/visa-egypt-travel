<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CustomizedTrip extends Model
{
    protected $fillable = [
        'date_type',
        'destination',
        'date_from',
        'date_to',
        'month',
        'days',
        'first_name',
        'nationality',
        'phone',
        'codePhone',
        'email',
        'adults',
        'child',
        'note',
        'infant',
        'request',
        'age_range',
        'travel_to',
        'accommodation_choices',
        'how_did_you_hear_about_us',
        'children_ages',
    ];

    protected $casts = [
        'children_ages' => 'array',
        'date_from' => 'date',
        'date_to' => 'date',
    ];

    protected $translationForeignKey = 'trip_id';

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(CustomizedCategory::class, 'category_for_trip');
    }
}
