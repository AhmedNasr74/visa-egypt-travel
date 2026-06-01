<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\SubscribeEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSubscribeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $users;
    protected $requestData;

    public function __construct($users, $requestData)
    {
        $this->users = $users;
        $this->requestData = $requestData;
    }

    public function handle()
    {   $clients=$this->users;
        foreach ($clients as $key => $client) {
            Mail::to($client['email'])->send(new SubscribeEmail($this->requestData));
        }
    }
}

