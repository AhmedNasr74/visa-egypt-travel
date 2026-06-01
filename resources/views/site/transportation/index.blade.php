@extends('layouts.site.app')

@section('content')
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area jarallax"
         style="background-image:url({{ asset('assets/site/img/banner/1.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <h1 class="page-title">{{ __('main.Transportation') }}</h1>
                        <ul class="page-list">
                            <li><a href="{{ route('site.home') }}">{{ __('main.home') }}</a></li>
                            <li>{{ __('main.Transportation') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area End -->

    <!-- contact area End -->
    <div class="contact-area pd-top-108">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-lg-center text-left">
                        <h2 class="title">{{ __('main.get-in-touch') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-xl-12 col-lg-12">
                    <form class="tp-form-wrap">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="single-input-wrap style-two">
                                    <span class="single-input-title">{{ __('main.name') }}</span>
                                    <input type="text">
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="single-input-wrap style-two">
                                    <span class="single-input-title">{{ __('main.number') }}</span>
                                    <input type="text">
                                </label>
                            </div>
                            <div class="col-lg-12">
                                <label class="single-input-wrap style-two">
                                    <span class="single-input-title">{{ __('main.email') }}</span>
                                    <input type="text">
                                </label>
                            </div>
                            <div class="col-lg-12">
                                <label class="single-input-wrap style-two">
                                    <span class="single-input-title">{{ __('main.message') }}</span>
                                    <textarea></textarea>
                                </label>
                            </div>
                            <div class="col-12">
                                <a class="btn btn-yellow" href="#">{{ __('main.send-message') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area End -->

    <!-- contact info area End -->
    <div class="contact-info-area pd-top-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 order-lg-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3455.2841708980714!2d31.17354927505957!3d29.999995720676182!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145846765e2334ff%3A0x29022126e13689c5!2sAl%20Haram%2C%20Giza%20Governorate!5e0!3m2!1sen!2seg!4v1689598449309!5m2!1sen!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-xl-4 col-lg-5 order-lg-1">
                    <div class="contact-info bg-gray">
                        <p>
                            <i class="fa fa-map-marker"></i>
                            <span>{{ __('main.haram-s') }} <br> {{ __('main.giza-egypt') }}</span>
                        </p>
                        <p>
                            <i class="fa fa-clock-o"></i>
                            <span>{{ __('main.office-hours') }} 9:00 to 7:00 {{ __('main.sunday') }} 10:00 to 5:00</span>
                        </p>
                        <p>
                            <i class="fa fa-envelope"></i>
                            <span>{{ __('main.email') }}: <span>info@sacredegypttours.com</span></span>
                        </p>
                        <p>
                            <i class="fa fa-phone"></i>
                            <span>
                            <span>(+20) 11 2040 4440</span> <br>
                        </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact info area End -->

@endsection
