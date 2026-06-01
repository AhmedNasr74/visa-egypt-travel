<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Discount extends Model
{
    protected $fillable = [
        'type',
        'value',
        'count',
    ];
    public function tours(): BelongsToMany
    {
        return $this->belongsToMany(Tour::class, 'discount_tours');
    }
    public function destinations(): BelongsToMany
    {
        return $this->belongsToMany(Destination::class, 'discount_destinations');
    }
public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'discount_categories');
    }

}
