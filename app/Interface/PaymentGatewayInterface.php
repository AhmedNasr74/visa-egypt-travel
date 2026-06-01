<?php

namespace App\Interface;
use Illuminate\Http\Request;


interface PaymentGatewayInterface
{
    public function setApiCredentials($config);
    public function getAccessToken();
    public function createOrder(array $data);
    public function capturePaymentOrder($token);
    public function success(Request $request);
    public function cancel(Request $request);
}
