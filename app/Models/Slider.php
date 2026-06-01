<?php

namespace App\Models;

use App\Traits\Models\Activated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Slider extends Model
{
    use Activated;

    protected $fillable = [
        'title',
        'key',
        'active',
    ];

    protected $with = ['slides'];

    public function slides(): HasMany
    {
        return $this->hasMany(Slide::class);
    }

    public function scopeKey($q, $k)
    {
        return $q->where('key', $k);
    }
}
