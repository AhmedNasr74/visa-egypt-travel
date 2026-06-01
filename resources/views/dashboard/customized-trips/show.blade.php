@extends('layouts.dashboard.app')

@section('content')
    <div class="page-body">
        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="customizedTrips">
            <li class="breadcrumb-item active">customizedTrips</li>
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
                                            <h3>customizedTrip Number <span>#{{ $customizedTrip->id }}</span></h3>
                                        </div>

                                        <div class="table-responsive table-details">
                                            <table class="table">


                                                <tbody>
                                                    <tr class="border-bottom">
                                                        <td>Destination</td>
                                                        <td>{{$customizedTrip->destination }}</td>
                                                    </tr>
                                                    <tr class="border-bottom">
                                                        <td>Type</td>
                                                        <td>{{ ucfirst(str_replace('_', ' ', $customizedTrip->date_type)) }}</td>
                                                    </tr>
                                                    @if ($customizedTrip->date_type == 'Exact Dates')
                                                        <tr class="border-bottom">
                                                            <td>Start Date</td>
                                                            <td>{{ $customizedTrip->date_from }}</td>
                                                        </tr>
                                                        <tr class="border-bottom">
                                                            <td>End Date</td>
                                                            <td>{{ $customizedTrip->date_to }}</td>
                                                        </tr>
                                                    @else
                                                        <tr class="border-bottom">
                                                            <td>Duration</td>
                                                            <td>{{ $customizedTrip->days }}</td>
                                                        </tr>
                                                        <tr class="border-bottom">
                                                            <td>Month</td>
                                                            <td>{{ $customizedTrip->month }}</td>
                                                        </tr>
                                                    @endif

                                                    <tr class="border-bottom">
                                                        <td>Adults</td>
                                                        <td>{{ $customizedTrip->adults }}</td>
                                                    </tr>
                                                    <tr class="border-bottom">
                                                        <td>Children</td>
                                                        <td>{{ $customizedTrip->child }}</td>
                                                    </tr>
                                                    <tr class="border-bottom">
                                                        <td>Infants</td>
                                                        <td>{{ $customizedTrip->infant }}</td>
                                                    </tr>
                                                    <tr class="border-bottom">
                                                        <td>Notes</td>
                                                        <td>{{ $customizedTrip->note }}</td>
                                                    </tr>
                                                    <tr class="border-bottom">
                                                        <td>Created At</td>
                                                        <td>{{ $customizedTrip->created_at }}</td>
                                                    </tr>
                                                    <tr >
                                                        <td>Updated At</td>
                                                        <td>{{ $customizedTrip->updated_at }}</td>
                                                    </tr>

                                            </table>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3">
                                        <div class="row g-4">
                                            <!-- Button trigger modal -->
                                            <div class="col-12">
                                                <div class="order-success">
                                                    <h4>Summary</h4>
                                                    <ul class="order-details">
                                                        <li>customizedTrip ID: {{ $customizedTrip->id }}</li>
                                                        <li>Client: {{$customizedTrip->first_name . '. '. $customizedTrip->last_name}}</li>
                                                        <li>Email: {{$customizedTrip->email}}</li>
                                                        <li>
                                                            Phone: {{$customizedTrip->phone}}</li>
                                                        <li>Country: {{$customizedTrip->nationality ?? 'N/A'}}</li>
                                                        <li>Created Date: {{ $customizedTrip->created_at->format('F,d, Y') }} </li>
                                                        <li>
                                                            Date Type: {{ $customizedTrip->date_type}} </li>


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
{{--
@push('js')
    <script>
        let UPDATE_URL = "{{ route('dashboard.customizedTrips.update', $customizedTrip) }}"
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
@endpush --}}
