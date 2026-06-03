<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Helpers\EmailHelper;
use Illuminate\Support\Facades\Mail;
use PDF;
class GenerateInvoicePDF implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $booking;
    protected $payment;
    public function __construct($booking,$payment)
    {
        $this->booking = $booking;
        $this->payment = $payment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $data['booking']= $this->booking;
        $data['payment']= $this->booking;

        $pdf = PDF::loadView('site.tour_details.invoice', $data);
        $pdfData = $pdf->output(); // Get raw PDF data

        $recipients = EmailHelper::getNotificationRecipientEmails();
        $title = "Invoice";
        $body = "Please find attached the invoice.";

        Mail::send([], [], function ($message) use ($recipients, $title, $body, $pdfData) {
            $message->to($recipients)
                    ->subject($title)
                    ->attachData($pdfData, 'invoice.pdf', [
                        'mime' => 'application/pdf',
                    ]);
            $message->text($body);
        });
    }
}
