<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizedCategoryTranslation extends Model
{
    protected $fillable = [
        'title',
    ];
    public $timestamps = false;
}
