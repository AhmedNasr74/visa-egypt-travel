<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $type;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @param string $type
     */
    public function __construct($data, $type = 'contact')
    {
        $this->data = $data;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->type === 'booking' 
            ? 'New Booking Contact Form - Egypt In Style Tours'
            : 'New Contact Form Submission - Egypt In Style Tours';

        $view = $this->type === 'booking' 
            ? 'emails.contact_form_admin'
            : 'email';

        return $this->subject($subject)
                    ->view($view)
                    ->with('data', $this->data);
    }
}
