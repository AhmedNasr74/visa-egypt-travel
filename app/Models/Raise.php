<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Raise extends Model
{
    protected $fillable = [
        'type',
        'value',
        'count',
    ];
    public function tours(): BelongsToMany
    {
        return $this->belongsToMany(Tour::class, 'raise_tours');
    }
    public function destinations(): BelongsToMany
    {
        return $this->belongsToMany(Destination::class, 'raise_destinations');
    }
public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'raise_categories');
    }
}
