<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class TourDayTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title', 'description'
    ];
}
