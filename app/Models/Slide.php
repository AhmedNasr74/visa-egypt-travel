<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $translated_title
 * @property string $translated_description
 */
class Slide extends Model
{
    protected $fillable = [
        'slider_id',
        'image',
        'title',
        'description',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array'
    ];

    public function slider(): BelongsTo
    {
        return $this->belongsTo(Slider::class);
    }

    public function translatedTitle(): Attribute
    {
        return new Attribute(
            get: fn() => $this->title[app()->getLocale()] ?? $this->title['en'] ?? null
        );
    }

    public function translatedDescription(): Attribute
    {
        return new Attribute(
            get: fn() => $this->description[app()->getLocale()] ?? $this->description['en'] ?? null
        );
    }
}
