<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\AutoTranslate;
use App\Traits\Models\HasSeo;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Blog extends Model
{
    use Translatable, HasSeo, AutoTranslate;
    public array $translatedAttributes = [
        'title',
        'description',
    ];
    protected $fillable = [
        'enabled',
        'slug',
        'featured_image',
        'gallery',
        'tags'

    ];

    protected $casts = [
        'enabled' => 'boolean',
        'gallery' => 'array',

    ];
    public function category() : BelongsToMany
    {
        return $this->BelongsToMany(BlogCategory::class, 'blog_ctaegory_pivot');

    }
    public function comments():HasMany
    {
        return $this->HasMany(Comment::class);
    }
}
