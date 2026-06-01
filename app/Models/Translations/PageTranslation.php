<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    protected $fillable = [
        'content',
    ];
    protected $casts=[
        'content'=>'array'
    ];

}
