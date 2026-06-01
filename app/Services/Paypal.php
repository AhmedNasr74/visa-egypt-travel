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




abstract class Paypal implements PaymentGatewayInterface
{
    public function success(Request $request)
    {
        $paypalToken = $this->getAccessToken();
        $response = $this->capturePaymentOrder($request->input('token'));

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return [
                'status' => 'success',
                'message' => 'Payment Success'
            ];
        } else {
            return $this->cancel($request);
        }
    }

    public function cancel(Request $request)
    {
        return [
            'status' => 'failed',
            'message' => 'Payment Failed'
        ];
    }

}
namespace App\Services;

use Illuminate\Http\Request;

class PayPalClient implements PayPalServiceInterface
{



}
