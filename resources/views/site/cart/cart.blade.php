@extends('layouts.site.app')

@section('content')

<div class="container" style="margin-top: 150px">
    <h1>Your Cart</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                <!-- Cart items -->

                @foreach ($cart as $key=>$item )
                @php
                    $tour=App\Models\Tour::where('id',$item['tour_id'])->first();
                    $deposit=($tour->deposit)/100;
                    $discount=0;
                    $remain=0;
                    if($deposit){
                        $discount=($item['total_price']*$deposit);
                        $remain=$item['total_price']-($item['total_price']*$deposit);
                    }
                @endphp
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{$tour->featured_image}}" alt="{{$tour->title}}" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h5>{{$tour->title}}</h5>
                            <p>{!!$tour->description!!}</p>
                        </div>
                        <div class="col-md-3">
                            <p>{{$item['total_price']}}{{user_currency()->symbol}}</p>
                            <input type="text" hidden value="{{$discount}}" name="deposit">
                            <input type="text" hidden value="{{$remain}}" name="remain">
                            <form action="{{ route('site.cart-delete',$key) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                            </form>                        </div>
                    </div>
                    @endforeach

                    <!-- End Cart items -->


                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Summary</h5>
                    <hr>
                    <p>Total Items: {{count($cart)}}</p>
                    @php
                        $totalprice=0;
                        foreach ($cart as $item){
                            $totalprice += $item['total_price'];
                        }
                    @endphp
                    <p>Total Price: {{$totalprice}}</p>
                    <form action="{{route('site.checkout')}}" method="get" id="checkout">
                        @csrf
                        @foreach ($cart as $item)
                        <input type="hidden" name="cart[]" id="cart" value="{{ json_encode($item) }}">
                        @endforeach
                        <input type="text" hidden name="total_price" id="price" value="{{$totalprice}}">
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
<script>
$("#click").click( function(e) {

    if ($("#cart").length > 0) {
        toastr.error('Cart does not exist.');
    }
});
</script>
@endpush

