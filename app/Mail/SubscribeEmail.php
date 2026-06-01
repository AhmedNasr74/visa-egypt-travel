<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscribeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $requestData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($requestData)
    {
        $this->requestData = $requestData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->requestData['subject'])
                    ->view('dashboard.subscribes.email-body')->with('requestData', $this->requestData);
    }
}
