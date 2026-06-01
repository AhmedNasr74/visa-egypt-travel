<?php

namespace App\Services;

use App\Interface\PaymentGatewayInterface;
use Illuminate\Http\Request;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;




class ZiinaPay implements PaymentGatewayInterface
{

    public function ziina($book)
    {
        $book_id=$book->id;
        $TotalPrice=$book->total_price;
        try {
            $client = new \GuzzleHttp\Client();
            $value = floatval($TotalPrice)*100;
            $response = $client->request('POST', 'https://api-v2.ziina.com/api/payment_intent', [
                'body' => '{"amount":'.$value.',
                    "message":"'.$book_id.'",
                    "currency_code":"AED",
                    "success_url":"http://127.0.0.1:8000/callback?pay_id={PAYMENT_INTENT_ID}",
                    "test":true}',
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Bearer DpwqIOS1uidcgwg96LRsFBAwz50rHzZ8j+rgLHw3m+AO9yy2iuktQ5Hpp2NBj79C',
                    'content-type' => 'application/json',
                ],
            ]);
            $redirect_url = json_decode($response->getBody());
            return $redirect_url;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

public function callback($pay_id){
$client = new \GuzzleHttp\Client();
$Url='https://api-v2.ziina.com/api/payment_intent/'.$pay_id;
$response = $client->request('GET', $Url, [
  'headers' => [
    'accept' => 'application/json',
    'authorization' => 'Bearer DpwqIOS1uidcgwg96LRsFBAwz50rHzZ8j+rgLHw3m+AO9yy2iuktQ5Hpp2NBj79C',

  ],
]);

$response = json_decode($response->getBody());
return $response;
}
    public function refund($transactionId, $amount)
    {
        // Implement refund logic here
    }
}
