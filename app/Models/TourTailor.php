<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourTailor extends Model
{
   protected $fillable = [
    'name',
    'email',
    'phone',
    'adults',
    'nationality',
    'childs',
    'infants',
    'budget',
    'info',
];
    use HasFactory;
}
