<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\AutoTranslate;
use App\Traits\Models\HasSeo;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class CustomizedCategory extends Model
{
    use Translatable;
    protected $fillable=[
        'featured_image'
    ];

    public array $translatedAttributes = [
        'title',
    ];
    protected $translationForeignKey = 'category_id';
    public function trip(): BelongsToMany
    {
        return $this->belongsToMany(CustomizedTrip::class, 'category_for_trip');
    }
}
