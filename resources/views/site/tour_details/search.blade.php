@extends('layouts.site.app')

@section('content')

    @php
        if(request('type')){
            $img=App\Models\Category::find(request('type'))->banner;
        }else{
            $img =App\Models\Setting::firstWhere('option_key', \App\Enums\SettingKey::SEARCH_IMG->value)?->option_value[0] ??'';
        }
    @endphp
    <style>
        .select2-container .select2-selection--single {
            max-width: 61px;
            height: 50px;
        }
        .banner figure {
            background-position: center center;
            background-size: cover !important;
            background-repeat: no-repeat !important;
            height: 50vh;
            transition: all 1s;
            background: linear-gradient(150deg, #00000093 40%, #00000018 70%),
                url("{{ $img }}");

        }

        .banner figcaption {
            top: 80%;
            left: 50%;
            transform: translate(-50%, -80%);
        }

        .banner figure:hover {
            background-position: center center;
            background-size: cover !important;
            background-repeat: no-repeat !important;
            background: linear-gradient(150deg, #00000018 40%, #00000018 70%),
                url("{{ $img }}");
        }
    </style>
    <section class="banner">
        <div class="container-fluid">
<figure class="position-relative" style="background: linear-gradient(150deg, #00000093 40%, #00000018 70%), url('{{ $category->banner ?? asset("storage/media/siwa (78).png") }}') !important; background-size: cover; background-position: center; background-repeat: no-repeat;">
                <figcaption class="position-absolute">
                    <div class="text-capitalize">
                        <h2 class="text-white h1">{{ $category->title }}</h2>
                        <p class="text-white">
                            <span class="textMainColor me-1">{{ __('main.home') }}</span>
                            > {{ $category->title }}
                        </p>
                    </div>
                </figcaption>
            </figure>
        </div>
    </section>

    <section class="my-5 filterTour">
        <div class="container">
                @if ($tours->isNotEmpty())
                    <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-11">
                        @foreach ($tours as $tour)
                        <div class="border rounded-md h-full" data-aos="fade-up">
                            <figure class="rounded-md overflow-hidden relative">
                                <a href="{{ route('site.tour_details', $tour->slug ?? $tour->id) }}">
                                    <img src="{{ $tour->featured_image }}" class="w-full imageAnimation" style="height: 195px !important" alt="{{ $tour->title }}">
                                </a>
                                <div class="flex justify-between absolute top-3 left-3 right-3">
                                    <span class="uppercase bg-main-color hover:bg-second-color text-white px-2 py-1 rounded-md transition-time">{{ __('site.featured') }}</span>
                                    <span class="bg-black/45 size-8 rounded-md text-white center cursor-pointer"><i class="bx bx-heart"></i></span>
                                            </div>
                                        </figure>
                
                            <figcaption class="capitalize p-4 hover:shadow-lg transition-time">
                                <a href="{{ route('site.tour_details', $tour->slug ?? $tour->id) }}">
                                    <h3 class="text-xl text-main-color hover:text-second-color font-semibold">{{ $tour->title }}</h3>
                                </a>
                                <div class="my-3">
                                    {{ __('site.from') }}
                                    <span class="text-second-color font-semibold">{{ $tour->start_from_price . user_currency()->symbol }}</span>
                                </div>
                                <div class="between bg-amber-50/55 p-2">
                                    <div class="between">
                                        <div class="me-2">
                                            <i class='bx bx-time-five text-second-color' ></i>
                                            <span class="text-zinc-500">{{ $tour->days()->count() }} {{ __('site.days') }}</span>
                                        </div>
                                        <div class="me-2">
                                            <i class='bx bx-group text-second-color' ></i>
                                            <span class="text-zinc-500">{{ $tour->guests }} </span>
                                        </div>
                                    </div>
                                    <a href="{{ route('site.tour_details', $tour->slug ?? $tour->id) }}" class="text-main-color hover:text-second-color">{{ __('site.explore') }} <i class='bx bx-right-arrow-alt bx-tada bx-flip-horizontal' ></i></a>
                                </div>
                            </figcaption>
                            </div>
                        @endforeach

                    </div>
                
        @else
            <h3>{{ __('site.tours') }}</h3>
            @endif
        </div>
    </section>
@endsection
@push('js')
    <script>{{ __('site.duration') }}</script>
@endpush
