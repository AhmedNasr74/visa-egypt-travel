<?php

namespace App\Mail;

use App\Models\CustomizedTrip;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomizedTripAdminMail extends Mailable
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
            ->subject('New Customize Your Trip Request - Egypt In Style Tours')
            ->view('emails.customized_trip_admin')
            ->with('data', $this->data);
    }
}
