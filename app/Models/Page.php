<?php

namespace App\Models;


use App\Traits\Models\AutoTranslate;
use App\Traits\Models\HasSeo;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Translatable, HasSeo, AutoTranslate;

    public array $translatedAttributes = [
        'content',
    ];
    protected $fillable = [
        'key',
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function scopeByKey($query, $key)
    {
        return $query->where('key', $key);
    }
}
