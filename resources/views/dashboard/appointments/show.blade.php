@extends('layouts.dashboard.app')

@section('content')
    <div class="page-body">

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Edit Appointment" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.appointments.index') }}">Appointments</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert/>


                <div class="card">
                    <div class="card-body">

                        <x-dashboard.form.input-text :disabled="true" error-key="created_at" name="created_at"
                                                     :value="$appointment->created_at->toDateString()" id="created_at"
                                                     label-title="Created At"/>

                        <x-dashboard.form.input-text :disabled="true" error-key="name" name="name" :value="$appointment->full_name" id="name"
                                                     label-title="Name"/>

                        <x-dashboard.form.input-text :disabled="true" error-key="email" name="email" :value="$appointment->email"
                                                     id="email" label-title="Email"/>

                        <x-dashboard.form.input-text :disabled="true" error-key="phone" name="phone" :value="$appointment->phone_with_code"
                                                     id="phone" label-title="Phone"/>

                        <x-dashboard.form.input-text :disabled="true" error-key="meeting_language" name="meeting_language"
                                                     :value="$appointment->meeting_language" id="meeting_language"
                                                     label-title="Meeting Language"/>

                        <x-dashboard.form.input-text :disabled="true" error-key="meeting_date" name="meeting_date"
                                                     :value="$appointment->meeting_date->toDateString()" id="meeting_date"
                                                     label-title="Meeting Date"/>

                        <x-dashboard.form.input-text :disabled="true" error-key="meeting_hour" name="meeting_hour"
                                                     :value="$appointment->meeting_hour" id="meeting_hour"
                                                     label-title="Meeting Hour"/>

                        <x-dashboard.form.input-text :disabled="true" error-key="adults" name="adults" :value="$appointment->adults"
                                                     id="adults" label-title="Adults"/>

                        <x-dashboard.form.input-text :disabled="true" error-key="children" name="children"
                                                     :value="$appointment->children" id="children"
                                                     label-title="Children"/>

                        <x-dashboard.form.input-text :disabled="true" error-key="arrival_date" name="arrival_date"
                                                     :value="$appointment->arrival_date->toDateString()" id="arrival_date"
                                                     label-title="Arrival Date"/>

                        <x-dashboard.form.input-text :disabled="true" error-key="departure_date" name="departure_date"
                                                     :value="$appointment->departure_date->toDateString()" id="departure_date"
                                                     label-title="Departure Date"/>

                        <x-dashboard.form.input-text :disabled="true" error-key="days" name="days" :value="$appointment->days" id="days"
                                                     label-title="Number of days"/>

                        <x-dashboard.form.input-text :disabled="true" error-key="expected_budget" name="expected_budget"
                                                     :value="$appointment->expected_budget" id="expected_budget"
                                                     label-title="Expected Budget"/>

                        <x-dashboard.form.input-textarea :disabled="true" error-key="notes" name="notes" :value="$appointment->notes"
                                                     id="notes" label-title="Notes"/>

                    </div>
                </div>


            </div>
        </div>
        <!-- Container-fluid Ends-->

    </div>
@endsection
