<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    protected $fillable = [
        'title',
        'description'
    ];}
