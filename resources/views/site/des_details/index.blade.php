@extends('layouts.site.app')

@section('content')
   <style>
        .banner figure {
            background: linear-gradient(150deg, #00000093 40%, #00000018 70%),
            url("{{$des->banner ?? ''}}");
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat !important;
            height: 50vh;
            transition: all 1s;
        }

        .banner figcaption {
            top: 80%;
            left: 50%;
            transform: translate(-50%, -80%);
        }

     

        .text-brown {
            color: #5c3b16;
        }

        /* Hover animation for image */
        .tour-card-img {
            transition: transform 0.4s ease;
        }

        .tour-card:hover .tour-card-img {
            transform: scale(1.05);
        }

        .card-hover {
            transition: box-shadow 0.3s ease;
        }

        .card-hover:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
        }
    </style>
    <!-- ============ Banner ============ -->
    <section class="banner">
        <div class="container-fluid">
            <figure class="position-relative">
                <figcaption class="position-absolute">
                    <div class="text-capitalize">
                        <h2 class="text-white">{{ $des->title }}</h2>
                        <p class="text-white">
                            <a href="{{ route("site.home") }}">
                                <span class="textMainColor me-1">{{ __('site.home') }}</span>
                            </a>
                            > {{ $des->title }}
                        </p>
                    </div>
                </figcaption>
            </figure>
        </div>
    </section>

    <!-- ============ Description & Tours ============ -->
    <section class="tourDetails py-5">
        <div class="container">
            <div class="row justify-content-center g-4">
                <div class="col-lg-12">
                    <div class="descriptionTour">
                        <!-- Description -->
                        <div class="mb-8 bg-white rounded-md p-6 shadow-sm border-l-4 border-second-color">
                            <div class="flex items-center mb-3">
                                <i class="fa fa-edit text-second-color text-xl mr-2"></i>
                                <h5 class="text-lg font-semibold capitalize">{{ __('site.description') }}</h5>
                            </div>
                            <div class="text-zinc-600 leading-7">
                                {!! $des->description !!}
                            </div>
                        </div>

                        <!-- Gallery -->
                        @if($des->gallery)
                            <div id="t_gallery" class="my-5">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fa fa-images me-2"></i>
                                    <h5 class="fw-semibold mb-0">{{ __('site.gallery') }}</h5>
                                </div>

                                <div id="default-carousel" class="relative w-full" data-carousel="slide">
                                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                                        @forelse ($des->gallery as $i => $pic)
                                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                                <img src="{{ $pic }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                                            </div>
                                        @empty
                                            <h3>{{ __('site.no_available_gallery') }}</h3>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Tours -->
                        @if ($des->tours->isNotEmpty())
                            <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-11">
                                @foreach ($des->tours as $tour)
                                <div class="border rounded-md h-full" data-aos="fade-up">
                                    <figure class="rounded-md overflow-hidden relative">
                                        <a href="{{ route('site.tour_details',$tour->slug) }}">
                                            <img src="{{ $tour->featured_image }}" class="w-full imageAnimation" style="height: 195px !important" alt="{{ $tour->title }}">
                                        </a>
                                        <div class="flex justify-between absolute top-3 left-3 right-3">
                                            <span class="uppercase bg-main-color hover:bg-second-color text-white px-2 py-1 rounded-md transition-time">{{ __('site.featured') }}</span>
                                            <span class="bg-black/45 size-8 rounded-md text-white center cursor-pointer"><i class="fa fa-heart"></i></span>
                                        </div>
                                    </figure>

                                    <figcaption class="capitalize p-4 hover:shadow-lg transition-time">
                                        <a href="{{ route('site.tour_details',$tour->slug) }}">
                                            <h3 class="text-xl text-main-color hover:text-second-color font-semibold">{{ $tour->title }}</h3>
                                        </a>
                                        <div class="my-3">
                                            {{ __('site.from') }}
                                            <span class="text-second-color font-semibold">{{ $tour->start_from_price . user_currency()->symbol }}</span>
                                        </div>
                                        <div class="between bg-amber-50/55 p-2">
                                            <div class="between">
                                                <div class="me-2">
                                                    <i class='fa fa-clock text-second-color' ></i>
                                                    <span class="text-zinc-500">{{ $tour->days()->count() }} {{ __('site.days') }}</span>
                                                </div>
                                                <div class="me-2">
                                                    <i class='fa fa-users text-second-color' ></i>
                                                    <span class="text-zinc-500">{{ $tour->guests }} </span>
                                                </div>
                                            </div>
                                            <a href="{{ route('site.tour_details',$tour->slug) }}" class="text-main-color hover:text-second-color">{{ __('site.explore') }} <i class='fa fa-arrow-right' ></i></a>
                                        </div>
                                    </figcaption>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <h3>{{ __('site.no_tours_found') }}</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('assets/site/js/main.js') }}"></script>
@endpush
