<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable=[
        'name',
        'image',
        'title',
        'mail_link',
        'facebook_link',
        'twitter_link',
        'insta_link',
        'linkedin_link',
    ];
}
