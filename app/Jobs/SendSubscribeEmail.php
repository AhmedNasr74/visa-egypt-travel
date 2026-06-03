<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\SubscribeEmail;
use App\Services\DualEmailSender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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
            DualEmailSender::sendGuest(
                $client['email'] ?? null,
                new SubscribeEmail($this->requestData),
                'newsletter_subscribe',
                ['client_id' => $client['id'] ?? null]
            );
        }
    }
}

