@extends('layouts.site.app')
@section('content')

    <section>
        <div
            style="background-image: url('{{ $nile_cruise->banner ?? asset('assets/site/img/banner-bg.jpg') }}')"
                class="capitalize flex justify-between px-4 h-[50vh] bg-cover bg-center bg-no-repeat"
        >
            <span class="self-center text-4xl font-semibold text-white">{{ $nile_cruise->title }}</span>

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
                                href="{{ route("site.home") }}"
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
                            >{{$nile_cruise->title}}</span
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
                @forelse ($nile_cruise->children as $i=>$sub_category)
                    <a href="{{ route('site.package',$sub_category->slug ?? $sub_category->id) }}"
                       data-aos="{{ $i%2 ? 'fade-right' : 'fade-left' }}"
                            @class(['col-span-2' => $i==1])>

                        <figure class="h-60 relative rounded-md overflow-hidden">
                            <img src="{{ $sub_category->featured_image }}" class="w-full h-full imageAnimation"
                                 alt="tour image">
                            <span
                                    class="absolute top-2 right-2 uppercase bg-second-color text-white px-2 rounded-md hover:bg-main-color">
                                <b class="me-1">{{ $sub_category->tours()->count() }}</b>{{ __('site.tours') }}</span>
                            <div class="absolute bottom-4 left-4 capitalize">
                                <h3 class="text-xl text-white  font-bold">{{ $sub_category->title }}</h3>
                            </div>
                        </figure>
                    </a>
                @empty

                @endforelse


            </div>
        </div>
    </section>

    <section class="my-20">
        <div class="container">
            <div class="text-center" data-aos="fade-up">
                <span class="text-2xl font-dancingFont text-second-color capitalize ">{{ __('site.featured_tours') }}</span>
                <h2 class="text-3xl sm:text-5xl font-semibold capitalize">{{ __('site.best_chosen_luxury_nile_river_cruise') }}</h2>
            </div>
            <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-11">
                @forelse ($tours as $i=>$tour)
                    <div class="border rounded-md h-full" data-aos="fade-up">
                        <figure class="rounded-md overflow-hidden relative">
                            <a href="{{ route('site.tour_details',$tour->slug) }}">
                                <img src="{{ $tour->featured_image }}" class="w-full imageAnimation" style="height: 195px !important" alt="{{ $tour->title }}">
                            </a>
                            <div class="flex justify-between absolute top-3 left-3 right-3">
                                <span class="uppercase bg-main-color hover:bg-second-color text-white px-2 py-1 rounded-md transition-time">{{ __('site.featured') }}</span>
                                <span class="bg-black/45 size-8 rounded-md text-white center cursor-pointer"><i class="bx bx-heart"></i></span>
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
                                <a href="{{ route('site.tour_details',$tour->slug) }}" class="text-main-color hover:text-second-color">{{ __('site.explore') }} <i class='bx bx-right-arrow-alt bx-tada bx-flip-horizontal' ></i></a>
                            </div>
                        </figcaption>
                    </div>
                @empty
                @endforelse

            </div>
        </div>
    </section>

    <section
            class="mt-20 bg-black/80 py-14 bg-[url('../image/bg-line.png')] bg-center bg-cover bg-no-repeat"
    >
        <div class="container flex flex-wrap gap-6 justify-between items-center">
            <!-- section title -->
            <div>
    <span class="text-2xl font-dancingFont text-second-color capitalize"
    >{{ __('site.plan_your_trip_with_us') }}</span
    >
                <h2 class="text-3xl sm:text-5xl font-semibold capitalize text-white">
                    {{ __('site.ready_for_an_unforgettable_tour') }}
                </h2>
            </div>

            <a href="#" class="mainBtn uppercase"> {{ __('site.book_tour_now') }}</a>
        </div>
    </section>



@endsection


@extends('layouts.site.app')


@section('content')
    <!-- ================= Day Tour start ========================= -->

    <!-- banner  -->
    <section>
        <div class="capitalize flex justify-between px-4 h-[50vh] bg-cover bg-center bg-no-repeat" style="background-image: url('{{ $nile_cruise->banner }}')">
            <span class="self-center text-4xl font-semibold text-white">{{ $nile_cruise->title }}</span>

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
                            href="{{ route("site.home") }}"
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
                            >{{ $nile_cruise->title }}</span
                            >
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- sub categories -->
    <section class="my-20">
        <div class="container">
            <!-- section title -->
            <div class="text-center">
                <span class="text-2xl font-dancingFont text-second-color capitalize">{{ __('main.category-list') }}</span>
            </div>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 grid-cols-1 gap-6 my-11">
                @foreach ($nile_cruise->children as $cat )
                    <a href="{{ route('site.nile-cruise-tours', $cat->slug ) }}">
                        <figure class="h-80 relative rounded-md overflow-hidden  group">
                            <img src="{{ $cat->featured_image }}" class="w-full h-full imageAnimation" alt="tour image">
                            <div class="absolute bottom-0 left-0 right-0 bg-black/45 py-2 text-center capitalize text-white translate-y-9 group-hover:translate-y-0 transition-time">
                                <h3 class="text-xl mb-5 group-hover:mb-0 transition-time font-bold">{{ $cat->title }} </h3>
                                <p>{!! $cat->description !!}</p>
                            </div>
                        </figure>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="my-20">
        <div class="container">
            <div class="text-center" data-aos="fade-up">
                <span class="text-2xl font-dancingFont text-second-color capitalize ">{{ __('site.featured_tours') }}</span>
                <h2 class="text-3xl sm:text-5xl font-semibold capitalize">{{ __('site.best_chosen_luxury_nile_river_cruise') }}</h2>
            </div>
            <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-11">
                @forelse ($tours as $i=>$tour)
                    <div class="border rounded-md h-full" data-aos="fade-up">
                        <figure class="rounded-md overflow-hidden relative">
                            <a href="{{ route('site.tour_details',$tour->slug) }}">
                                <img src="{{ $tour->featured_image }}" class="w-full imageAnimation" style="height: 195px !important" alt="{{ $tour->title }}">
                            </a>
                            <div class="flex justify-between absolute top-3 left-3 right-3">
                                <span class="uppercase bg-main-color hover:bg-second-color text-white px-2 py-1 rounded-md transition-time">{{ __('site.featured') }}</span>
                                <span class="bg-black/45 size-8 rounded-md text-white center cursor-pointer"><i class="bx bx-heart"></i></span>
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
                                <a href="{{ route('site.tour_details',$tour->slug) }}" class="text-main-color hover:text-second-color">{{ __('site.explore') }} <i class='bx bx-right-arrow-alt bx-tada bx-flip-horizontal' ></i></a>
                            </div>
                        </figcaption>
                    </div>
                @empty
                @endforelse

            </div>
        </div>
    </section>

    <!-- plan your trip -->
    <section class="mt-20 bg-black/80 py-14 bg-[url('../image/bg-line.png')] bg-center bg-cover bg-no-repeat">
        <div class="container flex flex-wrap gap-6 justify-between items-center">
            <!-- section title -->
            <div>
          <span class="text-2xl font-dancingFont text-second-color capitalize"
          >{{ __('site.plan_your_trip_with_us') }}</span
          >
                <h2 class="text-3xl sm:text-5xl font-semibold capitalize text-white">
                    {{ __('site.ready_for_an_unforgettable_tour') }}
                </h2>
            </div>

            <a href="#" class="mainBtn uppercase"> {{ __('site.book_tour_now') }}</a>
        </div>
    </section>

    <!-- ========================= End Day Tour Section ============ -->
@endsection

@push('js')
    <script>
        $('.select2').select2()
        $("#tailor-form").on('submit', function (e) {
            console.log('done');
            e.preventDefault()
            let submitBtn = $(this).find('button')
            submitBtn.attr('disabled', true)
            axios.post($(this).attr('action'), $(this).serialize())
                .then((res) => {
                    toastr.success(res.data.message)
                    $(this).trigger("reset");
                }).catch(error => {
                toastr.error(error.response.data.message)
            }).finally(() => {
                submitBtn.attr('disabled', false)

            })
        })
    </script>
@endpush

