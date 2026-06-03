<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewBookingEmailMail extends Mailable
{
    use Queueable, SerializesModels;


    private Booking $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function build(): self
    {
        return $this->markdown('emails.book_tour_email', [
            'booking' => $this->booking,
        ])->subject('Booking Receipt');
    }
}
