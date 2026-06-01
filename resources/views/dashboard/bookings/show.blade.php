@extends('layouts.dashboard.app')

@section('content')
    <div class="page-body">
        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Bookings">
            <li class="breadcrumb-item active">Bookings</li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">

                <x-dashboard.partials.message-alert/>

                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="bg-inner cart-section order-details-table">
                                <div class="row g-4">
                                    <div class="col-xl-9">
                                        <div class="card-details-title">
                                            <h3>Booking Number <span>#{{ $booking->id }}</span></h3>
                                        </div>

                                        <div class="table-responsive table-details">
                                            @if($booking->tour)
                                                <table class="table cart-table table-bbookingless">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th style="padding-left: 15px;">Tour</th>
                                                    <th>Members</th>
                                                    <th>Extra Options</th>
                                                </tr>
                                                </thead>

                                                <tbody>


                                                    @foreach([$booking->tour] as $tour)
                                                        <tr>
                                                            <td>
                                                                <a target="_blank"
                                                                   href="{{ route('dashboard.tours.edit',$tour) }}"><img
                                                                        style="margin-left: 6px"
                                                                        src="{{ $tour->featured_image }}"
                                                                        alt="" width="80"></a>
                                                            </td>
                                                            <td valign="top" style="padding-left: 15px; max-width: 100px">
                                                                <h5 style="margin-top: 15px;"><a target="_blank"
                                                                                                 @if(!is_null($booking->tour->deleted_at)) title="Tour is removed" @endif
                                                                                                 @class(['text-danger' => !is_null($tour->deleted_at),
                                                                                                 'text-dark' => is_null($tour->deleted_at)])
                                                                                                 href="{{ route('dashboard.tours.edit',$tour) }}">{{$tour->title}}</a>
                                                                </h5>
                                                            </td>

                                                            <td valign="top" style="padding-left: 15px;">
                                                                <h5 style="font-size: 14px; color:#444;margin-top:15px">
                                                                    <p style="font-weight: bold"> Adults
                                                                        ({{  $booking->adults_count }}) x
                                                                        ${{ number_format($booking->adult_price) }}</p>
                                                                    <p style="font-weight: bold"> Children
                                                                        ({{  $booking->children_count }}) x
                                                                        ${{ number_format($booking->child_price) }}</p>
                                                                </h5>
                                                            </td>

                                                            <td valign="top" style="padding-left: 15px; max-width: 100px">
                                                                <ul style="list-style-type: dot">
                                                                    @forelse($booking->tour_options ?? [] as $option)
                                                                        <li class="d-block">{{ $option['name'] }} - {{ $option['price'] }}$</li>
                                                                    @empty
                                                                        <li class="d-block">N/A</li>
                                                                    @endforelse
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    @endforeach


                                                </tbody>

                                                <tfoot>
                                                <tr class="table-booking">
                                                    <td colspan="2">
                                                        <h4 class="theme-color fw-bold">Total Price :</h4>
                                                    </td>
                                                    <td>
                                                        <h4 class="theme-color fw-bold">
                                                            <b>${{ number_format($booking->total_price, 2) }}</b>
                                                        </h4>
                                                    </td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            @else
                                                <h3>No Tours Found!</h3>
                                            @endif
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <x-dashboard.form.input-select
                                                        :options="\App\Models\User::all(['id', 'name'])"
                                                        track-by="id"
                                                        option-lable="name"
                                                        id="tour_operator"
                                                        name="tour_operator"
                                                        :value="$booking->tour_operator_id"
                                                        label-title="Choose Tour Operator"
                                                    />
                                                </div>
                                                @if($booking->tour_operator_id)
                                                    <h4 class="theme-color fw-bold">Tour Operator
                                                        : <span id="operator-name">{{ $booking->tour_operator->name }}</span></h4>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3">
                                        <div class="row g-4">
                                            <!-- Button trigger modal -->
                                            <div class="col-12">
                                                <div class="order-success">
                                                    <h4>Summery</h4>
                                                    <ul class="order-details">
                                                        <li>Booking ID: {{ $booking->id }}</li>
                                                        <li>Client: {{$booking->nickname . '. '. $booking->name}}</li>
                                                        <li>Email: {{$booking->email}}</li>
                                                        <li>
                                                            Phone: {{ '('. $booking->country_phone_code . ') '. $booking->phone}}</li>
                                                        <li>Country: {{$booking->nationality ?? 'N/A'}}</li>
                                                        <li>Created
                                                            Date: {{ $booking->created_at->format('F,d, Y') }} </li>
                                                        <li>Booking
                                                            Date: {{ optional($booking->date)->format('F,d, Y') ?? 'N/A' }} </li>
                                                        <li>Total Price:
                                                            ${{ number_format($booking->total_price, 2) }}</li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- section end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection

@push('js')
    <script>
        let UPDATE_URL = "{{ route('dashboard.bookings.update', $booking) }}"
        $('#tour_operator').on('change', function () {
            axios.put(UPDATE_URL, {
                _token: "{{ csrf_token() }}",
                tour_operator_id: $(this).val()
            }).then(res => {
                toastr.success(res.data.message)
                $('#operator-name').text(res.data.operator)
            }).catch(error => {
                toastr.error(error?.response?.data?.message || 'Something went wrong, please try again later')
                console.log(error)
            })
        })
    </script>
@endpush
