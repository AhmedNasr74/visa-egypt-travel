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



class BlogCategory extends Model
{
    use Translatable, HasSeo, AutoTranslate;
    public array $translatedAttributes = [
        'title',
    ];

    protected $fillable = [
        'enabled',
        'featured_image',
        'slug'
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];
    public $timestamps = false;

    public function blogs() : BelongsToMany
    {
        return $this->BelongsToMany(Blog::class, 'blog_ctaegory_pivot');

    }


}
