@extends('layouts.site.app')

@section('content')
    <div class="min-h-screen bg-zinc-100 font-[Inter,system-ui,sans-serif] antialiased">
        @include('site.limo._completing_booking_body')
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
        window.LIMO_COMPLETING_PREFILL = @json($limoPrefill ?? null);
        window.LIMO_BOOKING_STORE_URL = @json(route('site.limo.complete-booking.store'));
        window.LIMO_HOME_URL = @json(route('site.limo.home'));
        window.LIMO_BOOKING_SUCCESS_MSG = @json(__('site.limo_booking_recorded'));
    </script>
    <script src="{{ asset('assets/site/limo/js/completing-booking.js') }}"></script>
@endpush
