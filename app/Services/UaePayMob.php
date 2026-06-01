<?php

namespace App\Services;

use App\Interface\PaymentGatewayInterface;
use Illuminate\Http\Request;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use GuzzleHttp\Client;




class UaePayMob implements PaymentGatewayInterface
{

    public function UaePay($total_price)
    {
        try {
            $token = Http::withHeaders(['Content-Type' => 'application/json'])->post(config('paymob.UAE_TOKEN'), [
                'username' => config('paymob.UAE_PAYMOB_USER'),
                'password' => config('paymob.UAE_PAYMOB_PASS')
            ])->json('token');
            $PayLink=$this->token($token ,$total_price);
            return $PayLink ;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

   public function token($token ,$total_price){
    $amount=$total_price*100;
    $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token,])->post(config('paymob.UAE_PAY_LINK'), [
        'is_live' => 'false',
        'payment_methods' => [config('paymob.UAE_PAYMOB_ID')],
        'amount_cents'=>$amount,
    ])->json();
        return $response;
   }

   public function EgyPay($total_price)
    {
        try {
            $token = Http::withHeaders(['Content-Type' => 'application/json'])->post(config('paymob.EGY_TOKEN'), [
                'username' => config('paymob.EGY_PAYMOB_USER'),
                'password' => config('paymob.EGY_PAYMOB_PASS')
            ])->json('token');
            $PayLink=$this->Egytoken($token ,$total_price);
            return $PayLink ;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

   public function Egytoken($token ,$total_price){
    $amount=$total_price*100;
    $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token,])->post(config('paymob.EGY_PAY_LINK'), [
        'is_live' => 'false',
        'payment_methods' => [config('paymob.EGY_PAYMOB_ID')],
        'amount_cents'=>$amount,
    ])->json();


        return $response;
   }
}
