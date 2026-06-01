@extends('layouts.site.app')

@section('content')

<section id="makeTrip" class="my-5 pt-5" style="">
    <div class="container pt-5">
      <div class="row justify-content-between">
        <div class="col-lg-7">
          <h4>Billing Details</h4>
          <div class="row">
            <div class="col-12 col-md-6 mb-2">
              <div>

                <form action="{{route('site.book')}}" method="post" id="book_tour" novalidate>
                    @csrf
                    @if(Auth::guard('client')->user())
                    <input type="text" hidden value="{{Auth::guard('client')->user()->id}}" name="client_id">
                    @endif
                    @foreach ($data->cart as $item )
                    @if(Auth::guard('client')->user())
                    <input type="text" hidden name="book_id[]" value="{{$item['id']}}">
                    @endif
                    <input type="text" hidden name="tour_id" value="{{$item['tour_id']}}">
                    @endforeach

                <label>First Name *</label>
                <input
                  type="text"
                  name="FirstName"
                  id="name"
                  class="form-control valid w-100"
                  required
                  oninput="validateName()"
                />
                <label for="name" class="d-none"
                  >This field is required.</label
                >
              </div>
            </div>

            <div class="col-12 col-md-6">
              <div>
                <label>LastName *</label>
                <input
                  type="lastName"
                  name="lastName"
                  id="lastName"
                  class="form-control valid w-100"
                  required
                  oninput="validatelastName()"
                />
                <label for="lastName" class="d-none"
                  >This field is required.</label
                >
              </div>
            </div>
          </div>

          <div class="row my-3">
            <!-- nationality -->
            <div class="col-12 mb-2">
              <div>
                <label for="Nationality">Nationality *</label>
                <select
                  name="nationality"
                  id="Nationality"
                  class="form-control text-capitalize"
                  required
                >
                  <option selected="selected" value>
                    Select your nationality
                  </option>
                  @foreach ($relations['Country'] as $coun )

                  <option value="{{$coun->name}}">{{$coun->name}}{{$coun->flag}}</option>

                  @endforeach
                </select>
                <label for="Nationality" class="d-none"
                  >This field is required.</label
                >
              </div>
            </div>
          </div>

          <div class="row my-3">
            <!-- email -->
            <div class="col-12 col-md-6">
              <div>
                <label>Email *</label>
                <input
                  type="email"
                  name="email"
                  id="email"
                  class="form-control valid w-100"
                  required
                  oninput="validateEmail()"
                />
                <label for="email" class="d-none"
                  >This field is required.</label
                >
              </div>
            </div>
            <!-- mobile -->
            <div class="col-12 col-md-6">
              <label for="codePhone">Mobile *</label>

              <div>
                <input
                  type="tel"
                  class="form-control w-100"
                  name="phone"
                  placeholder="Mobile"
                  id="userPhone"
                  required
                  oninput="validatePhone()"
                />

                <label for="userPhone" class="d-none"
                  >This field is required.</label
                >
              </div>
            </div>
          </div>

          <!-- location name -->
          <div class="row my-5">
            <h4 class="mb-3">Pick Up Location</h4>
            <div class="col-12">
              <div class="location d-flex">
                <input
                  type="text"
                  name="location"
                  id="location"
                  class="form-control w-100 p-2"
                  placeholder="Pick Up Location..."
                />
              </div>
            </div>
          </div>
          <!-- Additional Information name -->
          <div class="row my-5">
            <h4 class="mb-3">Additional Information</h4>
            <p class="text-black">
              Order note <span class="text-muted">(optional)</span>
            </p>
            <div class="col-12">
              <div class="">
                <textarea
                  name="notes"
                  id="addInfo"
                  placeholder="Note about your order ........"
                  class="form-control w-100"
                ></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <h4 class="pb-3">Your Order</h4>

          <div class="payment my-4 border-top pt-3">
            <div class="subtotal d-flex justify-content-between mb-2">
              <span class="text-uppercase">subtotal</span>
              <span>{{$data->total_price}}{{user_currency()->symbol}}</span>
              <input type="text" hidden value="{{$data->total_price}}" name="subtotal"id="subtotal">
            </div>
            <div class="total text-mainColor d-flex justify-content-between">
              <span class="text-uppercase">total</span>
              <span id="Totalprice">{{$data->total_price}}{{user_currency()->symbol}}</span>
              <input type="text" hidden value="{{$data->total_price}}" name="total_price"id="total_price">
            </div>
          </div>
          @php
                $total_deposit=0;
                $remain=0;
                $points=0
          @endphp
          @foreach ($data->cart as $item )
            @php
                $tour=App\Models\Tour::where('id',$item['tour_id'])->first();
                $points+=$tour->reward_points;
                $deposit=($tour->deposit)/100;
                    if($deposit){
                        $total_deposit+=($item['total_price']*$deposit);
                        $remain+=$item['total_price']-($item['total_price']*$deposit);
                    }

                    @endphp
           @endforeach
          @if($deposit!=0)

          <input type="checkbox" id="depositCheckbox"name="depositCheckbox" class="me-1">
          <label for="depositCheckbox">Use Deposit: <span id="dep"></span> </label>
          <input type="hidden" id="depositVal" value="{{$total_deposit}}">
          <input type="text" hidden id="remaining_amount"name="remaining_amount" value="{{$remain}}" >

          @endif
          @if($points!=0)
          <input type="hidden" id="reward_points"name="reward_points" value="{{$points}}">
          @endif
          @if (Auth::guard('client')->user() && Auth::guard('client')->user()->reward_points)

          <input type="checkbox" class="me-1" id="PointsCheckBox"name="PointsCheckBox">
          <label for="PointsCheckBox">Use Your Poins: {{Auth::guard('client')->user()->reward_points}} Will total_deposit <span id="pointstotal_deposit"></span> </label>

          <input type="hidden" id="user_points" name="user_points" value="{{Auth::guard('client')->user()->reward_points}}">
          <input type="hidden" id="remaining_amount"name="remaining_amount" >
          @endif
                <div  id="coupon-form">
                    <div class="d-flex justify-content-between align-items-center my-3">
                        <label for="coupon">Coupon</label>
                        <input type="text" name="coupon" id="coupon">
                        <a id="applyCouponBtn" class="btn btn-yellow" style="margin-left: 10px; color:white">Apply <i class="fa fa-paper-plane" style="margin-left: 10px;" disabled="true"></i></a>
                    </div>
                </div>
          <h4 class="py-5" >Payment Method</h4>
            <div class="mt-2" id="cash-pay">
              <input
                type="radio"
                name="PaymentMethod"
                class="me-2"
                value="cash"
                id="cash"
              />
              <label for="cash">Cash Uppon Arrival</label>
            </div>
            <div class="mt-2" id="visa-pay">
              <input
                type="radio"
                name="PaymentMethod"
                class="me-2"
                value="visa"
                id="visa"
              />
              <label for="visa"> Visa-Mastercard</label>
            </div>
<div>

    <button class="btn mainBtn fs-5 w-100 my-5" style="height:52px" type="submit" id="submitBtn">
        Place Order

    </button>
</div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('js')
<script>
    $("#book_tour").on('submit', function(e) {
        e.preventDefault()
        let submitBtn = $("#submitBtn")
        submitBtn.attr('disabled', true)
        submitBtn.text("")
        submitBtn.html('<span class="loader"></span>');
        axios.post($(this).attr('action'), $(this).serialize()).then((res) => {
            toastr.success(res.data.success);
            setTimeout(() => {
                window.location.href=res.data.redirect;
            }, 1000);
        }).catch(error => {
            console.log(error);
            if(error.response.data.message){
                toastr.error(error.response.data.message ?? '{{ __('main.unexpected-error') }}')
            }else{
                toastr.error(error.response.data.error ?? '{{ __('main.unexpected-error') }}')
            }
            submitBtn.attr('disabled', false)
        }).finally()
    })
</script>
@endpush
@push('js')
<script>

</script>
@endpush
@push('js')
  <script>
function visa(){
    if(parseFloat($("#total_price").val())==0){
                    $('#visa-pay').hide()
                    $('#cash').prop("checked",true)
                    $('#cash-pay').hide()
                }else{
                    $('#visa-pay').show()
                    $('#cash').prop("checked",false)
                    $('#cash-pay').show()

                }
}
        function CalcDeposit(){
        let totalprice=parseFloat($("#Totalprice").text().replace("$",""))
        let Deposit=$("#dep")
        var Amount = parseFloat($("#depositVal").val());
        var Remain = parseFloat($('#remaining_amount').val());
        console.log(Remain)
        var useDeposit = $("#depositCheckbox").prop("checked");
        Deposit.text(Amount+ '{{user_currency()->symbol}}')
        $("#depositCheckbox").change(function(){
            if($("#depositCheckbox").prop("checked")){
                $("#total_price").val(Amount);
                $("#Totalprice").text(Amount+ '{{user_currency()->symbol}}')
                $('#remaining_amount').val(Remain)

            }else{
                $("#total_price").val(totalprice);
                $('#remaining_amount').val("")
                $("#Totalprice").text((totalprice)+ '{{user_currency()->symbol}}')

            }
        });

        }
        CalcDeposit();
        let points=parseFloat($('#user_points').val())
        let RewardVal=points/100;
        let total_price=parseFloat($("#total_price").val())
        $('#pointstotal_deposit').text(RewardVal+'{{user_currency()->symbol}}')
        $("#PointsCheckBox").change(function(){
            if($("#PointsCheckBox").prop("checked")){
                if(total_price >= RewardVal){
                $("#total_price").val((total_price-RewardVal));
                $('#user_points').val("");
                $("#Totalprice").text((total_price-RewardVal)+ '{{user_currency()->symbol}}')
                }
                else{
                $("#total_price").val((0));
                $('#user_points').val((RewardVal-total_price)*100);
                $("#Totalprice").text((0)+ '{{user_currency()->symbol}}')

                }
                visa();
                CalcDeposit();
            }else{
                $("#total_price").val(total_price);
                $("#Totalprice").text((total_price)+ '{{user_currency()->symbol}}')
                $('#user_points').val(points);
                visa();
                CalcDeposit();

            }
        });

        $('#applyCouponBtn').click(function() {
        var formData = $('#applyCoupon').serialize();
        let couponValue= $('#coupon').val();
        let coupon= $('#coupon');
        let totalprice=parseFloat($("#Totalprice").text().replace("$",""))
        let total_price=$("#total_price")
        console.log(totalprice);
        axios.post('{{ route('site.coupon') }}', { coupon: couponValue})
            .then((res) => {
                console.log(res)
                coupon.prop("readonly", true);
                if (res.data.coupon_type == "fixed") {
                total_price.val((totalprice - res.data.coupon_value));
                $("#Totalprice").text((totalprice - res.data.coupon_value) +' {{user_currency()->symbol}}')
                $('#applyCouponBtn').replaceWith('<button class="btn btn-yellow" style="margin-left: 10px; color:white;  background:#3CB212" disabled> Applied <i class="fa fa-paper-plane" style="margin-left: 10px;" ></i></button>');
                console.log(total_price)

            } else {
                let Val=res.data.coupon_value
                total_price.val((totalprice - (totalprice*(res.data.coupon_value/100))));
                console.log(total_price)
                $("#Totalprice").text((totalprice - (totalprice*(res.data.coupon_value/100))) + '{{user_currency()->symbol}}')
                $('#applyCouponBtn').replaceWith('<button class="btn btn-yellow" style="margin-left: 10px; color:white;  background:#3CB212" disabled> Applied <i class="fa fa-paper-plane" style="margin-left: 10px;" ></i></button>');

            }

            toastr.success(res.data.message);

            CalcDeposit()
                })
            .catch(error => {
                console.error(error);
                toastr.error(error.response.data.error ?? '{{ __('main.unexpected-error') }}')

            }).finally()

    });


  </script>
@endpush

