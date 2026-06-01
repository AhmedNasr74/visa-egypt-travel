<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property string $description
 */
class TourOption extends Model
{
    use Translatable, SoftDeletes;

    protected $fillable = [
        'price',
        'option_type',
        'icon',
    ];

    public array $translatedAttributes = [
        'name',
        'description',
    ];

    protected $casts = [
        'translated_at' => 'datetime',
    ];

    protected $hidden = [
        'translated_at'
    ];

    public function tours(): BelongsToMany
    {
        return $this->belongsToMany(Tour::class, 'tour_option_tours');
    }
}
