@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.customized-trips.store' ) }}" method="POST" class="page-body">
        @csrf

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Create CustomizedTrip" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.customized-trips.index') }}">CustomizedTrips</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert />


                <div class="card">
                    <div class="card-body">
                        <x-dashboard.form.input-text error-key="date_type" name="date_type"  id="date_type" label-title="DateType"/>

<x-dashboard.form.input-text class="input-datepicker" error-key="date_from" name="date_from"  id="date_from" label-title="DateFrom"/>

<x-dashboard.form.input-text class="input-datepicker" error-key="date_to" name="date_to"  id="date_to" label-title="DateTo"/>

<x-dashboard.form.input-text error-key="month" name="month"  id="month" label-title="Month"/>

<x-dashboard.form.input-number error-key="days" name="days"  id="days" label-title="Days"/>

<x-dashboard.form.input-text error-key="first_name" name="first_name"  id="first_name" label-title="FirstName"/>

<x-dashboard.form.input-text error-key="last_name" name="last_name"  id="last_name" label-title="LastName"/>

<x-dashboard.form.input-text error-key="nationality" name="nationality"  id="nationality" label-title="Nationality"/>

<x-dashboard.form.input-text error-key="phone" name="phone"  id="phone" label-title="Phone"/>

<x-dashboard.form.input-text error-key="email" name="email"  id="email" label-title="Email"/>

<x-dashboard.form.input-number error-key="adults" name="adults"  id="adults" label-title="Adults"/>

<x-dashboard.form.input-number error-key="child" name="child"  id="child" label-title="Child"/>

<x-dashboard.form.input-text error-key="note" name="note"  id="note" label-title="Note"/>

<x-dashboard.form.input-number error-key="infant" name="infant"  id="infant" label-title="Infant"/>

<x-dashboard.form.input-number error-key="min_budget" name="min_budget"  id="min_budget" label-title="MinBudget"/>

<x-dashboard.form.input-number error-key="max_budget" name="max_budget"  id="max_budget" label-title="MaxBudget"/>
<div>
    <x-dashboard.form.input-select name="Destinations[]" multible :options="$relations['Destinations']" track-by="id"
    option-lable="title" label-title="Destinations" id="Destinations"
    error-key="Destinations" />
  

</div>

                        <x-dashboard.form.submit-button/>
                    </div>
                </div>


            </div>
        </div>
        <!-- Container-fluid Ends-->

    </form>
@endsection
