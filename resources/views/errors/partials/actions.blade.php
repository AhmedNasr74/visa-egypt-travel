@php
    $homeUrl = \Illuminate\Support\Facades\Route::has('site.home') ? route('site.home') : url('/');
    $contactUrl = \Illuminate\Support\Facades\Route::has('site.contact') ? route('site.contact') : $homeUrl;
@endphp
<a href="{{ $homeUrl }}" class="btn mainBtn px-4 py-2">
    <i class="bx bx-home-alt me-1"></i>{{ __('site.error_back_home') }}
</a>
<button type="button" class="btn btn-outline-secondary px-4 py-2" onclick="window.history.back()">
    <i class="bx bx-arrow-back me-1"></i>{{ __('site.error_go_back') }}
</button>
@hasSection('show_contact')
    <a href="{{ $contactUrl }}" class="btn btn-outline-secondary px-4 py-2">
        <i class="bx bx-envelope me-1"></i>{{ __('site.error_contact_support') }}
    </a>
@endif
