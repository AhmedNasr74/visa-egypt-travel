<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Models\AutoTranslate;

class TourDay extends Model
{
    use Translatable, AutoTranslate;
    protected $fillable=[
        'tour_day_image',
        'tour_id',
    ];

    public array $translatedAttributes = [
        'title',
        'description',
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }
}
