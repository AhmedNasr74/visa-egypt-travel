<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Payment extends Model
{
    use HasFactory;
    protected $fillable=[
        'payment_id',
        'amount',
        'currency_code',
        'status',
        'response',
        'booking_id',
    ];
    public function book(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
