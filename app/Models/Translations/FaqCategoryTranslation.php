<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategoryTranslation extends Model
{

    protected $fillable = [
        'title',
    ];
    public $timestamps = false;


}
