<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'phone',
        'nationality',
        'birthdate',
        'blocked',
        'google_id',
        'avatar',
        'note',
        'reward_points'
    ];

    protected $casts = [
        'blocked' => 'boolean',
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(ClientAddress::class);
    }
    public function book():HasMany{
        return $this->HasMany(Booking::class);

    }
    public function comments():HasMany
    {
        return $this->HasMany(Comment::class);
    }
    public function wishlist(): BelongsToMany
    {
        return $this->belongsToMany(Tour::class, 'client_wishlist');
    }

}
