@extends('layouts.site.app')

@section('content')

    <!-- ================= Day Tour start ========================= -->
    <section class="banner">
        <div class="container-fluid">
            <figure class="position-relative">
                <!-- <img
                        src="{{ asset('assets/site/img/banner.png') }}"
                        class="w-100 h-75"
                        alt="about us banner image"
                      /> -->
                <figcaption class="position-absolute">
                    <div class="text-capitalize">
                        <h2 class="text-white h1">Privacy Policy</h2>
                        <p class="text-white">
                            <a href="{{route("site.home")}}">
                                <span class="textMainColor me-1">{{ __('main.home') }}</span>
                            </a> >Privacy Policy
                        </p>
                    </div>
                </figcaption>
            </figure>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row">
                @php
                $privacy = setting(App\Enums\SettingKey::PRIVACY->value);
               @endphp
            {!!$privacy[0]!!}
            </div>
        </div>
    </section>

    <!-- ========================= End Day Tour Section ============ -->
@endsection
@push('js')
    <script src="{{ asset('assets/site/js/aboutSlider.js') }}"></script>
@endpush
