@extends('layouts.site.app')

@section('content')
    <!-- ================= Banner Section ========================= -->
    <section class="banner position-relative">
        <div class="container-fluid p-0">
            <figure class="position-relative m-0">
                <img 
                    src="{{ asset('assets/site/img/banner.png') }}" 
                    class="w-100 banner-img" 
                    alt="Terms & Conditions banner"
                >
                <div class="banner-overlay"></div>
                <figcaption class="position-absolute top-50 start-50 translate-middle text-center">
                    <h2 class="text-white fw-bold display-5 mb-3">
                        {{ __('site.terms_conditions') }}
                    </h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('site.home') }}" class="textMainColor">
                                    {{ __('main.home') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-white" aria-current="page">
                                {{ __('site.terms_conditions') }}
                            </li>
                        </ol>
                    </nav>
                </figcaption>
            </figure>
        </div>
    </section>

    <!-- ================= Terms Content ========================= -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    @php
                        $terms = setting(App\Enums\SettingKey::TERMS_AND_CONDITIONS->value);
                    @endphp
                    <div class="terms-content p-4 bg-white shadow-sm rounded" data-aos="fade-up">
                        {!! $terms[0] !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
<style>
    .banner-img {
        height: 300px;
        object-fit: cover;
    }
    .banner-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
    }
    .breadcrumb a {
        text-decoration: none;
        font-weight: 500;
    }
    .terms-content {
        font-size: 1rem;
        line-height: 1.8;
        color: #333;
    }
</style>
@endpush

@push('js')
    <script src="{{ asset('assets/site/js/aboutSlider.js') }}"></script>
@endpush
