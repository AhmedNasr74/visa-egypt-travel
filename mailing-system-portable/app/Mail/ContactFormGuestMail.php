<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormGuestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array $data,
        public bool $isBooking = true
    ) {}

    public function build(): self
    {
        $subject = $this->isBooking
            ? 'We Received Your Booking Inquiry - Egypt In Style Tours'
            : 'We Received Your Message - Egypt In Style Tours';

        return $this
            ->subject($subject)
            ->view('emails.contact_form_guest')
            ->with('data', $this->data);
    }
}
