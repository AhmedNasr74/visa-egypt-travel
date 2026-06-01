@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.bookings.store' ) }}" method="POST" class="page-body">
        @csrf

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Create Booking" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.bookings.index') }}">Bookings</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert/>


                <div class="card">
                    <div class="card-body">
                        <x-dashboard.form.input-select :options="['Mr', 'Mrs']"
                                                       error-key="nickname"
                                                       name="nickname"
                                                       id="nickname"
                                                       label-title="Client Nickname"/>

                        <x-dashboard.form.input-text error-key="name" name="name" id="name" label-title="Client Name"/>

                        <x-dashboard.form.input-text error-key="email" name="email" id="email" label-title="Email"/>

                        <x-dashboard.form.input-select :options="$countries->pluck('phone_code')->toArray()"
                                                       error-key="country_phone_code"
                                                       name="country_phone_code"
                                                       id="country_phone_code"
                                                       label-title="Country Phone Code"/>

                        <x-dashboard.form.input-text error-key="phone" name="phone" id="phone"
                                                     label-title="Phone Number"/>

                        <x-dashboard.form.input-select :options="$countries"
                                                       error-key="nationality"
                                                       track-by="name"
                                                       option-lable="name"
                                                       name="nationality"
                                                       id="nationality"
                                                       label-title="Nationality"/>

                        <x-dashboard.form.input-text error-key="date" class="input-datepicker allow-past" name="date"
                                                     id="date" label-title="Date"/>

                        <x-dashboard.form.input-select :options="$tours"
                                                       error-key="tour_id"
                                                       track-by="id"
                                                       option-lable="title"
                                                       name="tour_id"
                                                       id="tour_id"
                                                       label-title="Tour"/>

                        <x-dashboard.form.input-select :options="[]"
                                                       error-key="tour_options"
                                                       multible
                                                       id="tour_options"
                                                       name="tour_options[]"
                                                       label-title="Tour Options"/>

                        <x-dashboard.form.input-text error-key="adults_count" name="adults_count" id="adults_count"
                                                     label-title="Adults"/>

                        <x-dashboard.form.input-text error-key="child_count" name="child_count"
                                                     id="children" label-title="Children"/>

                        <x-dashboard.form.input-textarea error-key="notes" name="notes" id="notes"
                                                         label-title="Notes"/>

                        <x-dashboard.form.submit-button/>
                    </div>
                </div>


            </div>
        </div>
        <!-- Container-fluid Ends-->

    </form>
@endsection
@push('js')

    <script>
        $("#tour_id").on('change', function () {
            let tour_id = $(this).val()
            if (!tour_id) {
                return;
            }
            $('label[for="tour_options"]').append(`<i class="fa fa-spin fa-spinner tour-options-loading-spinner"></i>`)
            axios.get("{{ route('dashboard.tours.options') }}", {params: {tour_id}})
                .then(response => {
                    $("#tour_options option").remove()
                    response.data.options.forEach(option => {
                        $("#tour_options").append(`<option value="${option['id']}">${option['name']} - ${option['price']}$</option>`)
                    })
                    $('#tour_options').select2('destroy').select2();

                }).finally(() => {
                $('.tour-options-loading-spinner').remove()
            })
        })
    </script>

@endpush
