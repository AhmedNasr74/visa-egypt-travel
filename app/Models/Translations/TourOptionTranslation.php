<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourOptionTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description'
    ];
}
