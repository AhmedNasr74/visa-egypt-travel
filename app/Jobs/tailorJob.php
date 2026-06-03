<?php

namespace App\Jobs;

use App\Mail\tailorEmailMail;
use App\Services\DualEmailSender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class serviceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $name;
    private $phone;
    private $email;
    private $nationality;
    private $adults;
    private $childs;
    private $infants;
    private $budget;
    private $info;

    public function __construct(
        $name,
        $phone,
        $email,
        $nationality,
        $adults,
        $childs,
        $infants,
        $budget,
        $info
    )
    {
        $this->name            = $name;
        $this->phone           = $phone;
        $this->email           = $email;
        $this->nationality     = $nationality;
        $this->adults          = $adults;
        $this->childs          = $childs;
        $this->infants         = $infants;
        $this->budget          = $budget;
        $this->info            = $info;
    }

    public function handle()
    {
        DualEmailSender::sendGuest(
            $this->email,
            new serviceEmailMail(
                $this->name,
                $this->phone,
                $this->email,
                $this->nationality,
                $this->adults,
                $this->childs,
                $this->infants,
                $this->budget,
                $this->info
            ),
            'tailor_service_job',
            ['email' => $this->email]
        );
    }
}
