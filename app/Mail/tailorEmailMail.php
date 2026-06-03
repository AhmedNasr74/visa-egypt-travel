<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class serviceEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $phone;
    private $email;
    private $tour_name;
    private $phone_code;
    private $nationality;
    private $adults;
    private $childs;
    private $infants;
    private $average_budget;
    private $info;

    public function __construct( $name, $phone ,$tour_name,$phone_code ,$adults,$childs,$infants,$average_budget,$info)
    {
        $this->name            = $name;
        $this->phone           = $phone;
        $this->email           = $email;
        $this->tour_name       = $tour_name;
        $this->phone_code      = $phone_code;
        $this->nationality     = $nationality;
        $this->adults          = $adults;
        $this->childs          = $childs;
        $this->infants         = $infants;
        $this->average_budget  = $average_budget;
        $this->info            = $info;
    }

    public function build(): self
    {
        return $this->view('emails.tailor_email', [
            'name'         => $this->name,
            'content'      => $this->content,
            'booking'      => $this->booking,
            'phone'        => $this->phone,
            'nationality'  => $this->nationality,
            'adults'       => $this->adults,
            'childs'       => $this->childs,
            'infants'      => $this->infants,
            'average_budget' => $this->average_budget,
            'info'         => $this->info,
        ])->subject( $this->tour_name);
    }
}
