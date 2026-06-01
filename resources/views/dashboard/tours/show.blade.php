@extends('layouts.dashboard.app')

@section('content')
    <div class="page-body">
        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Tour">
            <li class="breadcrumb-item active">Tour</li>
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
                                            <h3>Tour Number <span>#{{ $tour->id }}</span></h3>
                                            <h3>Tour Type <span>{{ $tour->tour_for }}</span></h3>
                                        </div>
                                        <div class="table-responsive table-details">
                                            @if($tour->days)
                                                <table class="table cart-table table-bbookingless">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th style="padding-left: 15px;">Tour</th>
                                                    <th>Members</th>
                                                    <th>Day</th>
                                                </tr>
                                                </thead>

                                                <tbody>


                                                    @foreach([$tour->days] as $day)
                                                        <tr>
                                                            <td>
                                                                <a target="_blank"
                                                                   ><img
                                                                        style="margin-left: 6px"
                                                                        alt="" width="80"></a>
                                                            </td>
                                                            <td valign="top" style="padding-left: 15px; max-width: 100px">


                                                            </td>

                                                            <td valign="top" style="padding-left: 15px;">
                                                                <h5 style="font-size: 14px; color:#444;margin-top:15px">
                                                                    <p style="font-weight: bold"> Adults
                                                                        ({{  $tour->adults_count }}) x
                                                                        ${{ number_format($tour->adult_price) }}</p>
                                                                    <p style="font-weight: bold"> Children
                                                                        ({{  $tour->children_count }}) x
                                                                        ${{ number_format($tour->child_price) }}</p>
                                                                </h5>
                                                            </td>


                                                        </tr>
                                                    @endforeach


                                                </tbody>

                                                <tfoot>

                                                </tfoot>
                                            </table>
                                            @else
                                                <h3>No Tours Found!</h3>
                                            @endif
                                        </div>

                                        <hr>


                                    </div>

                                    <div class="col-xl-3">
                                        <div class="row g-4">
                                            <!-- Button trigger modal -->
                                            {{-- <div class="col-12">
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
                                            </div> --}}

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

@endpush
