<?php

namespace App\Models;

use App\Traits\Models\AutoTranslate;
use App\Traits\Models\HasSeo;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * @property string $title
 * @property string $description
 * @property string $slug
 */
class Category extends Model
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
        'banner',
        'featured_image',
        'parent_id',
        'gallery',
        'order_id',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'featured' => 'boolean',
        'gallery' => 'array',
    ];

    public function destinations(): Collection
    {
        $toursInDestinations = DB::table('tour_categories')->select('tour_id')
            ->where('category_id', $this->id)->get()->pluck('tour_id')
            ->toArray();

        return Destination::whereHas('tours', fn($q) => $q->whereIn('id', $toursInDestinations))
            ->get();
    }

    public function tours(): BelongsToMany
    {
        return $this->belongsToMany(Tour::class, 'tour_categories');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function isParent(): bool
    {
        return is_null($this->parent_id);
    }
    public function discount(): BelongsToMany
    {
        return $this->belongsToMany(Discount::class, 'discount_categories');
    }
    public function raise(): BelongsToMany
    {
        return $this->belongsToMany(Raise::class, 'raise_categories');
    }
}
