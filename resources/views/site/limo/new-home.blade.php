@extends('layouts.site.app')

@section('document_title', 'New Home — Limo')

@section('content')
    <div class="limo-font antialiased">
        @include('site.limo._new_home_body', [
            'limoAirportLocations' => $limoAirportLocations,
            'limoTravelLocations' => $limoTravelLocations,
            'limoCityLocations' => $limoCityLocations,
            'limoHasAirport' => $limoHasAirport,
            'limoHasTravel' => $limoHasTravel,
            'limoHasCity' => $limoHasCity,
            'limoDefaultTab' => $limoDefaultTab,
            'cityRidePrices' => $cityRidePrices,
            'limoTripRouteRules' => $limoTripRouteRules,
            'limoCityRouteRules' => $limoCityRouteRules,
            'limoGlobalMaxPassengers' => $limoGlobalMaxPassengers,
        ])
    </div>
@endsection

@push('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/site/limo/css/output.css') }}">
@endpush

@push('js')
    <script>
        window.LIMO_CITY_PRICES = @json($cityRidePrices ?? []);
        window.LIMO_CITY_ROUTE_RULES = @json($limoCityRouteRules ?? []);
        window.LIMO_DEFAULT_TAB = @json($limoDefaultTab ?? 'airport');
        window.LIMO_TRIP_ROUTE_RULES = @json($limoTripRouteRules ?? []);
        window.LIMO_GLOBAL_MAX_PASSENGERS = @json((int) ($limoGlobalMaxPassengers ?? 50));
        window.LIMO_PRICE_MESSAGES = {
            unavailable: @json(__('site.limo_price_placeholder')),
            noTier: @json(__('site.limo_price_no_tier')),
        };
        window.LIMO_COMPLETING_BOOKING_URL = @json(route('site.limo.completing-booking'));
        window.LIMO_SEARCH_MESSAGES = {
            missing_fields: @json(__('site.limo_search_missing_fields')),
            route_not_found: @json(__('site.limo_search_route_not_found')),
            no_price_tier: @json(__('site.limo_search_no_price_tier')),
            invalid_pax: @json(__('site.limo_search_invalid_pax')),
        };
    </script>
    <script src="{{ asset('assets/site/limo/js/new-home.js') }}"></script>
@endpush
