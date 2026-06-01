@extends('layouts.site.app')
@section('content')

    <section>
        <div style="background-image: url('{{ asset('storage/media/day-tours.webp') }}')"
             class="capitalize flex justify-between px-4 h-[50vh] bg-cover bg-center bg-no-repeat"
        >
            <span class="self-center text-4xl font-semibold text-white">{{ __('site.day_tour') }}</span>

            <!-- Breadcrumb -->
            <nav
                class="flex self-end px-5 py-3 text-gray-700 border border-gray-200 rounded-t-lg bg-white"
                aria-label="Breadcrumb"
            >
                <ol
                    class="inline-flex flex-wrap items-center space-x-1 md:space-x-2 rtl:space-x-reverse"
                >
                    <li class="inline-flex items-center">
                        <a
                            href="{{ route('site.home') }}"
                            class="inline-flex items-center text-sm font-medium text-main-color hover:text-second-color"
                        >
                            <svg
                                class="w-3 h-3 me-2.5"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"
                                />
                            </svg>
                            {{ __('site.home') }}
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg
                                class="rtl:rotate-180 w-3 h-3 mx-1 text-main-color"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 6 10"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m1 9 4-4-4-4"
                                />
                            </svg>
                            <span class="ms-1 text-sm font-medium text-second-color md:ms-2"
                            >{{ __('site.day_tour') }}</span
                            >
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="my-20">
        <div class="container">
            <!-- section title -->
            <div class="text-center" data-aos="fade-up">
                <span class="text-2xl font-dancingFont text-second-color capitalize ">{{ __('site.categories_lists') }}</span>
                <h2 class="text-3xl sm:text-5xl font-semibold capitalize">{{ __('site.go_exotic_places') }}</h2>
            </div>

            <div class="grid md:grid-cols-4 grid-cols-1 gap-4 my-11">
                @forelse ($destinations as $i=>$des)
                    <a href="{{ route('site.des-details',$des->slug ?? $des->id) }}" data-aos="
          @if ($i%2)
              fade-right
              @else
              fade-left
          @endif
          "
                        @class(['col-span-2' => !in_array($i, [0, 2 , 5, 6, 8])])
                    >
                        <figure class="h-60 relative rounded-md overflow-hidden">
                            <img src="{{ $des->featured_image }}" class="w-full h-full imageAnimation" alt="{{ __('site.tour_image') }}">
                            <span
                                class="absolute top-2 right-2 uppercase bg-second-color text-white px-2 rounded-md hover:bg-main-color"><b
                                    class="me-1">{{ $des->tours()->count() }}</b>{{ __('site.tours') }}</span>
                            <div class="absolute bottom-4 left-4 capitalize">
                                <h3 class="text-xl text-white  font-bold">{{ $des->title }}</h3>
                            </div>
                        </figure>
                    </a>
                @empty

                @endforelse


            </div>
            <section class="my-20">
                <div class="container">
                    <!-- section title -->
                    <div class="text-center" data-aos="fade-up">
                        <span class="text-2xl font-dancingFont text-second-color capitalize ">{{ __('site.featured_tours') }}</span>
                        <h2 class="text-3xl sm:text-5xl font-semibold capitalize">{{ __('site.choose_from_the_best_of_egypt_tours') }}</h2>
                    </div>

                    <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-11">
                        @forelse ($tours as $i=>$tour)
                            <div class="border rounded-md h-full" data-aos="fade-up">
                                <figure class="rounded-md overflow-hidden relative">
                                    <a href="{{ route('site.tour_details',$tour->slug) }}">
                                        <img src="{{ $tour->featured_image }}" class="w-full imageAnimation"
                                             style="height: 195px !important" alt="{{ $tour->title }}">
                                    </a>
                                    <div class="flex justify-between absolute top-3 left-3 right-3">
                                        <span
                                            class="uppercase bg-main-color hover:bg-second-color text-white px-2 py-1 rounded-md transition-time">{{ __('site.featured') }}</span>
                                        <span class="bg-black/45 size-8 rounded-md text-white center cursor-pointer"><i
                                                class="bx bx-heart"></i></span>
                                    </div>
                                </figure>

                                <figcaption class="capitalize p-4 hover:shadow-lg transition-time">
                                    <a href="{{ route('site.tour_details',$tour->slug) }}">
                                        <h3 class="text-xl text-main-color hover:text-second-color font-semibold">{{ $tour->title }}</h3>
                                    </a>
                                    {{-- <div class="my-3">
                                        <i class='bx bx-map text-second-color' ></i>
                                        <span class="text-zinc-500">Lorem ipsum dolor sit.</span>
                                    </div> --}}
                                    <div class="my-3">
                                        {{ __('site.from') }}
                                        <span
                                            class="text-second-color font-semibold">{{ $tour->start_from_price . user_currency()->symbol }}</span>
                                    </div>
                                    <div class="between bg-amber-50/55 p-2">
                                        <div class="between">
                                            <div class="me-2">
                                                <i class='bx bx-time-five text-second-color'></i>
                                                <span class="text-zinc-500">{{ $tour->days()->count() }} {{ __('site.days') }}</span>
                                            </div>
                                            <div class="me-2">
                                                <i class='bx bx-group text-second-color'></i>
                                                <span class="text-zinc-500">{{ $tour->guests }} </span>
                                            </div>
                                        </div>
                                        <a href="{{ route('site.tour_details',$tour->slug) }}"
                                           class="text-main-color hover:text-second-color">{{ __('site.explore') }} <i
                                                class='bx bx-right-arrow-alt bx-tada bx-flip-horizontal'></i></a>
                                    </div>
                                </figcaption>
                            </div>
                        @empty
                        @endforelse

                    </div>
                </div>
            </section>

            <section class="mt-20 bg-black/80 py-14 bg-[url('../image/bg-line.png')] bg-center bg-cover bg-no-repeat">
                <div class="container flex flex-wrap gap-6 justify-between items-center">
                    <!-- section title -->
                    <div>
                        <span class="text-2xl font-dancingFont text-second-color capitalize">{{ __('site.plan_your_trip_with_us') }}</span>
                        <h2 class="text-3xl sm:text-5xl font-semibold capitalize text-white">
                            {{ __('site.learn_more_before_you_travel') }}
                        </h2>
                    </div>

                    <a href="{{ route('site.blog') }}" class="mainBtn uppercase">{{ __('site.read_our_blogs') }}</a>
                </div>



            </section>

        </div>
    </section>


@endsection
