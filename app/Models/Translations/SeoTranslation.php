<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class SeoTranslation extends Model
{
    public $timestamps = false;

    protected $table = 'seo_translations';

    protected $fillable =  [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
    ];
}
