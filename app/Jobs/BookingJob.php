<?php

namespace App\Jobs;
use App\Mail\NewBookingEmailMail;
use App\Models\Booking;
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
        try {
            \Mail::to($this->booking->email)->send(new NewBookingEmailMail($this->booking));
        } catch (\Throwable $throwable) {
        }
    }
}
