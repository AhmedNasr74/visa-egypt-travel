<?php

namespace App\Models;

use App\Traits\Models\AutoTranslate;
use App\Traits\Models\HasSeo;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * @property string $title
 * @property string $description
 * @property string $slug
 */
class Destination extends Model
{

    use Translatable, SoftDeletes, AutoTranslate, HasSeo;

    public array $translatedAttributes = [
        'title',
        'description',
        'slug',
    ];

    protected $fillable = [
        'enabled',
        'featured',
        'country',
        'banner',
        'featured_image',
        'gallery',
        'order_id',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'featured' => 'boolean',
        'country' => 'boolean',
        'gallery' => 'array',
    ];

    public function categories(): Collection
    {
        $toursInDestinations = DB::table('tour_destinations')->select('tour_id')
            ->where('destination_id', $this->id)->get()->pluck('tour_id')
            ->toArray();

        return Category::whereHas('tours', fn($q) => $q->whereIn('id', $toursInDestinations))
            ->get()
            ->filter(fn(Category $category) => $category->isParent())
            ->sortBy('order');
    }

    public function tours(): BelongsToMany
    {
        return $this->belongsToMany(Tour::class, 'tour_destinations');
    }
    public function trip(): BelongsToMany
    {
        return $this->belongsToMany(CustomizedTrip::class, 'destination_for_trip');
    }
    public function discount(): BelongsToMany
    {
        return $this->belongsToMany(Discount::class, 'discount_destinations');
    }
    public function raise(): BelongsToMany
    {
        return $this->belongsToMany(Raise::class, 'raise_destinations');
    }
}
