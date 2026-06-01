</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body{
background:#eee;
margin-top:20px;
}
.text-danger strong {
        	color: #9f181c;
		}
		.receipt-main {
			background: #ffffff none repeat scroll 0 0;
			border-bottom: 12px solid #333333;
			border-top: 12px solid #9f181c;
			margin-top: 50px;
			margin-bottom: 50px;
			padding: 40px 30px !important;
			position: relative;
			box-shadow: 0 1px 21px #acacac;
			color: #333333;
			font-family: open sans;
		}
		.receipt-main p {
			color: #333333;
			font-family: open sans;
			line-height: 1.42857;
		}
		.receipt-footer h1 {
			font-size: 15px;
			font-weight: 400 !important;
			margin: 0 !important;
		}
		.receipt-main::after {
			background: #414143 none repeat scroll 0 0;
			content: "";
			height: 5px;
			left: 0;
			position: absolute;
			right: 0;
			top: -13px;
		}
		.receipt-main thead {
			background: #414143 none repeat scroll 0 0;
		}
		.receipt-main thead th {
			color:#fff;
		}
		.receipt-right h5 {
			font-size: 16px;
			font-weight: bold;
			margin: 0 0 7px 0;
		}
		.receipt-right p {
			font-size: 12px;
			margin: 0px;
		}
		.receipt-right p i {
			text-align: center;
			width: 18px;
		}
		.receipt-main td {
			padding: 9px 20px !important;
		}
		.receipt-main th {
			padding: 13px 20px !important;
		}
		.receipt-main td {
			font-size: 13px;
			font-weight: initial !important;
		}
		.receipt-main td p:last-child {
			margin: 0;
			padding: 0;
		}
		.receipt-main td h2 {
			font-size: 20px;
			font-weight: 900;
			margin: 0;
			text-transform: uppercase;
		}
		.receipt-header-mid .receipt-left h1 {
			font-weight: 100;
			margin: 34px 0 0;
			text-align: right;
			text-transform: uppercase;
		}
		.receipt-header-mid {
			margin: 24px 0;
			overflow: hidden;
		}

		#container {
			background-color: #dcdcdc;
		}
    </style>
</head>
<body>

    p 3.3.7 included, to get the result that you can see in the preview selection

    <div class="col-md-12">
     <div class="row">

            <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                <div class="row">
                    <div class="receipt-header">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="receipt-left">
                                    @if ($status)
                                    <img class="img-responsive" alt="iamgurdeeposahan" src="{{logo()}}" style="width: 71px; border-radius: 43px;">
                                    @endif

                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                            <div class="receipt-right">
                                <h5>{{ __('site.just_fly_tours') }}</h5>
                                <p>+1 3649-6589 <i class="<div class="receipt-left">
                                    @if ($status)
                                    <img class="img-responsive" alt="iamgurdeeposahan" src="{{logo()}}" style="width: 71px; border-radius: 43px;">
                                    @endif                                </div><iclass="fa fa-phone"></iclass=></p>
                                <p>{{ __('site.company_email') }} <i class="fa fa-envelope-o"></i></p>
                                <p>{{ __('site.usa') }} <i class="fa fa-location-arrow"></i></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="receipt-header receipt-header-mid">
                        <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                            <div class="receipt-right">
                                @php
                                    foreach($booking as $book){
                                        $client=$book;
                                    }
                                @endphp
                                @if ($booking->isEmpty())
                                     <h2 class="text-danger

                                     "> {{ __('site.error_please_call_us') }}</h2>
                                @endif
                                <h5>{{ __('site.customer_name') }} {{$client->name}}</h5>
                                <p><b>{{ __('site.mobile') }} :</b> {{$client->country_phone_code}}{{$client->phone}}</p>
                                <p><b>{{ __('site.email') }} :</b> {{$client->email}}</p>
                                <p><b>{{ __('site.address') }} :</b>{{$client->nationality}}</p>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="receipt-left">
                                <h3>{{ __('site.invoice') }} # {{$client->order_id}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div>

                @foreach($booking as $book)
                    @php
                        $payment=App\Models\Payment::where('booking_id',$book->id)->first();
                        $amount=($book->remaining_amount)+($book->total_price)
                    @endphp
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('site.description') }}</th>
                                <th>{{ __('site.amount') }}</th>
                            </tr>
                        </thead>
                        <tbody>


                            <tr>
                                <td class="text-right">
                                <p>
                                    <strong>{{ __('site.payment_id') }}: </strong>
                                </p>
                                <p>
                                    <strong>{{ __('site.order_id') }}: </strong>
                                </p>
                                <p>
                                    <strong>{{ __('site.date') }}: </strong>
                                </p>
                                <p>
                                    <strong>{{ __('site.adults_count') }}: </strong>
                                </p>
                                <p>
                                    <strong>{{ __('site.children_count') }}: </strong>
                                </p>
                                <p>
                                    <strong>{{ __('site.payment_status') }}: </strong>
                                </p>
                                <p>
                                    <strong>{{ __('site.remaining_amount') }}: </strong>
                                </p>
                                <p>
                                    <strong>{{ __('site.payable_amount') }}: </strong>
                                </p>
                                <p>
                                    <strong>{{ __('site.total_amount') }}: </strong>
                                </p>

                                </td>
                                <td>
                                <p>
                                    <strong><i class="fa fa-inr"></i> {{$payment->payment_id}}</strong>
                                </p>
                                <p>
                                    <strong><i class="fa fa-inr"></i>{{$payment ->order_id}}</strong>
                                </p>
                                <p>
                                    <strong><i class="fa fa-inr"></i>{{$book->date}}</strong>
                                </p>
                                <p>
                                    <strong><i class="fa fa-inr"></i> {{$book->adults_count}}</strong>
                                </p>
                                <p>
                                    <strong><i class="fa fa-inr"></i> {{$book->children_count ? $book->children_count : 0}}</strong>
                                </p>
                                <p>
                                    <strong><i class="fa fa-inr"></i> {{$payment->status}}</strong>
                                </p>
                                <p>
                                    <strong><i class="fa fa-inr"></i>{{$book->remaining_amount  ? $book->remaining_amount  : 0}}</strong>
                                </p>
                                <p>
                                    <strong><i class="fa fa-inr"></i> {{$book->total_price}}</strong>
                                </p>
                                <p>
                                    <strong><i class="fa fa-inr"></i>
                                        {{$amount}}
                                    </strong>
                                </p>
                                </td>
                            </tr>
                            <tr>

                                <td class="text-right"><h2><strong>{{ __('site.total') }}: </strong></h2></td>
                                <td class="text-left text-danger"><h2><strong><i class="fa fa-inr"></i> {{$amount}}</strong></h2></td>
                            </tr>
                        </tbody>
                    </table>
                    @endforeach
                </div>
                <div class="row">
                    <div class="receipt-header receipt-header-mid receipt-footer">
                        <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                            <div class="receipt-right">
                                <p><b>{{ __('site.date') }} :</b> {{$payment->created_at}}</p>
                                <h5 style="color: rgb(140, 140, 140);">{{ __('site.thanks_for_shopping') }}</h5>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="receipt-left">
                                <h1>{{ __('site.stamp') }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
               @if ($status)
               <form action="{{route('download-invoice')}}" method="post">
                @csrf
                <input type="hidden" value="{{$client->order_id}}" name="order_id">
                <input type="email" name="email">
                <button type="submit">{{ __('site.send_invoice') }}</button>
                </form>
               @endif
            </div>
        </div>
    </div>
</body>
</html>
