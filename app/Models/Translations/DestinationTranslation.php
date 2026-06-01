<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class DestinationTranslation extends Model
{
    protected $fillable = [
        'title',
        'description',
        'slug',
    ];

    public $timestamps = false;
}
