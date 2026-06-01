@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.currencies.update' , $currency) }}" method="POST" class="page-body">
        @csrf
        @method('PUT')

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Edit Currency" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.currencies.index') }}">Currencies</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert/>


                <div class="card">
                    <div class="card-body">
                        <x-dashboard.form.input-text error-key="name" name="name" :value="$currency->name" id="name"
                                                     label-title="Name"/>

                        <x-dashboard.form.input-text error-key="symbol" name="symbol" :value="$currency->symbol"
                                                     id="symbol" label-title="Symbol"/>

                        <x-dashboard.form.input-text error-key="exchange_rate" name="exchange_rate"
                                                     :value="$currency->exchange_rate" id="exchange_rate"
                                                     label-title="Exchange Rate"/>

                        <x-dashboard.form.input-checkbox error-key="default" name="default" :value="$currency->default"
                                                     id="default" label-title="Default"/>


                        <x-dashboard.form.submit-button/>
                    </div>
                </div>


            </div>
        </div>
        <!-- Container-fluid Ends-->

    </form>
@endsection
