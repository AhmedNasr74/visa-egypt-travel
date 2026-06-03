<?php

namespace App\Mail;

use App\Models\CustomizedTrip;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomizedTripGuestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public CustomizedTrip $trip,
        public array $data = []
    ) {
        $this->trip->loadMissing('categories');
    }

    public function build(): self
    {
        return $this
            ->subject('Your Customize Trip Request - Visa Egypt Travel')
            ->view('emails.customized_trip_guest')
            ->with('data', $this->data);
    }
}
