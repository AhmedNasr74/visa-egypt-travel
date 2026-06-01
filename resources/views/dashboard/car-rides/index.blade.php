@extends('layouts.dashboard.app')

@section('content')
    <div class="page-body">
        <x-dashboard.partials.breadcrumb title="Car ride">
            <li class="breadcrumb-item active">Car ride</li>
        </x-dashboard.partials.breadcrumb>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <x-dashboard.partials.message-alert />
                    <p class="text-muted mb-3">
                        Routes that include hourly / city-ride price tiers (Short Ride, Long Ride, full day packages).
                        <a href="{{ route('dashboard.car-routes.index') }}">View all car routes</a>
                    </p>
                    <div class="card">
                        <x-dashboard.partials.table-card-header model="car-route" />
                        <div class="card-body order-datatable overflow-x-auto">
                            {!! $dataTable->table(['class' => 'display']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
