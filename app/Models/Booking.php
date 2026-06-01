<?php

namespace App\Models;

use App\Jobs\BookingJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PHPUnit\Exception;

class Booking extends Model
{
    protected $fillable = [
        'tour_operator_id',
        'date',
        'tour_options',
        'name',
        'nickname',
        'country_phone_code',
        'email',
        'phone',
        'nationality',
        'tour_id',
        'adult_price',
        'child_price',
        'adults_count',
        'children_count',
        'total_price',
        'notes',
        'payment_status',
        'order_id',
        'client_id',
        'remaining_amount',
        'currency_code',
        'type'

    ];

    protected $casts = [
        'date' => 'date',
        'tour_options' => 'collection',
        'child_price' => 'float',
        'adults_count' => 'integer',
        'children_count' => 'integer',
        'total_price' => 'float',
    ];

    public static function boot(): void
    {
        parent::boot();
        static::created(function (Booking $booking) {
            try {
                BookingJob::dispatch($booking);
            } catch (Exception $exception) {

            }
        });
    }

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function tour_operator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tour_operator_id');
    }

    public function payment(): HasMany
    {
        return $this->HasMany(Payment::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

}
