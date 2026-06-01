@extends('layouts.dashboard.app')

@section('content')


    <div class="page-body">
        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Dashboard">
            <li class="breadcrumb-item active">Dashboard</li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Cards -->
        <div class="row">
            <x-dashboard.partials.box-card permission="users.list" title="Users" :count="\App\Models\User::count()" icon="users"
                color="danger" />

            <x-dashboard.partials.box-card permission="tours.list" title="Tours" :count="\App\Models\Tour::count()" icon="grid"
                color="secondary" />

            <x-dashboard.partials.box-card permission="destinations.list" title="Destinations" :count="\App\Models\Destination::count()"
                icon="globe" color="warning" />

            <x-dashboard.partials.box-card permission="categories.list" title="Categories" :count="\App\Models\Category::count()"
                icon="book-open" color="primary" />

            <x-dashboard.partials.box-card permission="tour-options.list" title="Tour Options" :count="\App\Models\TourOption::count()"
                icon="check-square" color="primary" />

            <x-dashboard.partials.box-card permission="bookings.list" title="New Bookings" :count="\App\Models\Booking::query()->whereBetween('created_at', [today()->startOfDay(), today()->endOfDay()])->count()" icon="edit-3"
                color="warning" />

        </div>

        <!-- Tables -->
        <div class="row">
            @canany(['bookings.index', 'bookings.show'])
                <div class="col-xl-12 xl-100">
                    <div class="card">
                        <div class="card-header">
                            <h5>Latest Bookings</h5>
                        </div>
                        <div class="card-body">
                            <div class="user-status table-responsive latest-order-table">
                                <table class="table table-bordernone">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Total Price</th>
                                            <th scope="col">Created At</th>
                                            @can('bookings.show')
                                                <th scope="col"></th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse(\App\Models\Booking::latest('id')->limit(5)->get() as $booking)
                                            <tr>
                                                <td>{{ $booking->client?->name ?? $booking->name }}</td>
                                                <td class="digits">{{ number_format($booking->total_price, 2) }}</td>
                                                @if ($booking->created_at)
                                                    <td class="digits">{{ $booking->created_at->format('M Y, d') }}</td>
                                                @endif
                                                @can('bookings.show')
                                                    <td class="digits"><a
                                                            href="{{ route('dashboard.bookings.show', $booking) }}">View</a>
                                                    </td>
                                                @endcan
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No Bookings Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <a href="{{ route('dashboard.bookings.index') }}" class="btn btn-primary mt-4">View All
                                    Bookings</a>
                            </div>

                        </div>
                    </div>
                </div>
            @endcanany



            @canany(['car-rentals.list', 'car-rentals.show'])
                <div class="col-xl-6 xl-100">
                    <div class="card">
                        <div class="card-header">
                            <h5>Latest Rentals</h5>
                        </div>
                        <div class="card-body">
                            <div class="user-status table-responsive latest-order-table">
                                <table class="table table-bordernone">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Total Price</th>
                                            <th scope="col">Created At</th>
                                            @can('car-rentals.show')
                                                <th scope="col"></th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse(\App\Models\CarRental::latest('id')->limit(5)->get() as $carRental)
                                            <tr>
                                                <td>{{ $carRental->name }}</td>
                                                <td class="digits">
                                                    {{ $carRental->currency?->symbol }}{{ number_format($carRental->currency_exchange_rate * ($carRental->car_route_price + $carRental->stops->sum('price')), 2) }}
                                                </td>
                                                <td class="digits">{{ $carRental->created_at->format('M Y, d') }}</td>
                                                @can('car-rentals.show')
                                                    <td class="digits">
                                                        <a href="{{ route('dashboard.car-rentals.show', $carRental) }}">View</a>
                                                    </td>
                                                @endcan
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No Rentals Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <a href="{{ route('dashboard.car-rentals.index') }}" class="btn btn-primary mt-4">View All
                                    Rentals</a>
                            </div>

                        </div>
                    </div>
                </div>
            @endcanany


        </div>
    </div>
@endsection
