<?php

namespace App\Jobs;

use App\Mail\NewBookingEmailMail;
use App\Models\Booking;
use App\Services\DualEmailSender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BookingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Booking $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function handle(): void
    {
        DualEmailSender::sendGuest(
            $this->booking->email,
            new NewBookingEmailMail($this->booking),
            'tour_booking_job',
            ['booking_id' => $this->booking->id]
        );
    }
}
