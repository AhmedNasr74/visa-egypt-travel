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
                <div class="col-sm-12">
                    <x-dashboard.partials.message-alert />
                    <div class="card">
                 @php
                 $tours = \App\Models\Tour::all();
                 $tourData = $tours->map(function ($tour) {
                     $slug = $tour->slug ?? ($tour->translate()?->slug ?? (method_exists($tour, 'getTranslation') ? $tour->getTranslation('slug', app()->getLocale()) : null));
                     return ['slug' => $slug, 'id' => $tour->id];
                 })->filter(fn($t) => !empty($t['slug']))->values()->toArray();
                 @endphp

                 <x-dashboard.partials.table-card-header model="booking" />
                    <div class="date">
                        <label for="from_date">From:</label>
                        <input type="date" id="from_date">

                        <label for="to_date">To:</label>
                        <input type="date" id="to_date">

                        <button class="btn btn-success" id="Date">Apply Filter</button>
                    </div>
                 <x-dashboard.form.input-select name="tourData[]" :options="$tourData" track-by="id"
                                    option-lable="slug" label-title="Select Tour" id="tourData"
                                    error-key="" />
                        <div class="card-body order-datatable overflow-x-auto">
                            <div class="filter-buttons">
                                    <ul class="list-inline" style="display:flex;">
                                    <li class="list-inline-item">
                                        <button style="padding:0px" class="btn btn-sm filter-btn" data-filter="payment_status" value="Waiting For Approve">Waiting For Approve</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button style="padding:0px" class="btn btn-sm filter-btn" data-filter="payment_status" value="Canceled">Canceled</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button style="padding:0px" class="btn btn-sm filter-btn" data-filter="payment_status" value="Rejected">Rejected</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button style="padding:0px" class="btn btn-sm filter-btn" data-filter="payment_status" value="Departed">Departed</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button style="padding:0px" class="btn btn-sm filter-btn" data-filter="payment_status" value="Deposit Paid">Deposit Paid</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button style="padding:0px" class="btn btn-sm filter-btn" data-filter="payment_status" value="Online Payed">Online Payed</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button style="padding:0px" class="btn btn-sm filter-btn" data-filter="payment_status" value="Submitted">Submitted</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button style="padding:0px" class="btn btn-sm filter-btn" data-filter="payment_status" value="Approved">Approved</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button style="padding:0px" class="btn btn-sm filter-btn" data-filter="payment_status" value="Pending">Pending</button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button style="padding:0px" class="btn btn-sm clear-filters-btn">Clear Filters</button> <!-- New button -->
                                    </li>
                                </ul>
                            </div>
                            <div class="">
                                {!! $dataTable->table(['class'=>'display']) !!}
                            </div>
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
$(document).ready(function () {
    $('#Date').click(function () {
        var fromDate = $('#from_date').val();
        var toDate = $('#to_date').val();
        console.log(fromDate , toDate)
        $('#data-table').DataTable().columns('date:name').search(fromDate + ',' + toDate).draw();
    });
    $('#tourData').change(function (){
        let Tourid=$(this).val()
        searchTour(Tourid);
    })
    $('.filter-btn[data-filter="payment_status"]').click(function () {
        var value = $(this).val();
        applyFilter(value, $(this));
    });

    $('.clear-filters-btn').click(function () {
        clearFilters();
    });

    function applyFilter(filterValue, button) {
        var keyword = filterValue;
        console.log(keyword);
        console.log(button);
        $('#data-table').DataTable().search('').columns().search('').draw();
        $('#data-table').DataTable().column('payment_status:name').search(keyword).draw();
    }

    function clearFilters() {
        $('.filter-btn').removeClass('active');
        $('#data-table').DataTable().search('').columns().search('').draw();
    }
    function searchTour(tour){
        console.log(tour)
        $('#data-table').DataTable().column('tour:name').search(tour).draw();
    }
});

</script>

@endpush
