@extends('layouts.site.app')

@section('content')
    <section>
        <figure class="h-full">
            <img src="{{ $tour->banner ?? 'https://m.media-amazon.com/images/I/71qfFkUjroL.jpg' }}"
                 alt="Tour Banner"
                 class="w-full h-30" alt="tour image"/>
        </figure>
    </section>

    <!-- breadcrumb area start -->
    @if ($count_discount)
        <input type="text" hidden id="count_discount" value="{{ $count_discount }}">
        <input type="text" hidden id="netEffect" value="{{ $netEffect }}">
    @endif
    @if ($count_raise)
        <input type="text" hidden id="count_raise" value="{{ $count_raise }}">
        <input type="text" hidden id="netEffect" value="{{ $netEffect }}">
    @endif

    <main>
        <div class="container">
            <div class="grid  lg:grid-cols-[25%_minmax(0,1fr)] grid-cols-1">
                <!-- side bar -->
                <aside class="sticky top-0 z-10  h-fit hidden lg:block">
                    <ul class="list-none bg-main-color p-2  h-full">
                        <a href="#t_details">
                            <li class="sidebarList titleActive">
                                <i class="bx bx-list-ul me-2"></i>
                                <span>{{ __('site.tour_details') }}</span>
                            </li>
                        </a>
                        <a href="#inclusions">
                            <li class="sidebarList">
                                <i class="bx bx-check-circle me-2"></i>
                                <span>{{ __('site.inclusions_exclusions') }}</span>
                            </li>
                        </a>

                        <a href="#itinerary">
                            <li class="sidebarList">
                                <i class="bx bx-map me-2"></i>
                                <span>{{ __('site.itinerary') }}</span>
                            </li>
                        </a>
                        @if($tour->tour_for === \App\Enums\TourPricingType::PACKAGE_GROUP->value  && !empty($tour->seasons))
                            <a href="#t_price">

                                <li class="sidebarList">
                                    <i class="bx bx-dollar-circle me-2"></i>
                                    <span>{{ __('site.tour_prices') }}</span>
                                </li>
                            </a>
                        @endif

                        <a href="#t_gallery">

                            <li class="sidebarList">
                                <i class="bx bx-images me-2"></i>
                                <span>{{ __('site.gallery') }}</span>
                            </li>
                        </a>
                        <a href="#t_review">

                            <li class="sidebarList">
                                <i class="bx bxs-star me-2"></i>
                                <span>{{ __('site.tour_reviews') }}</span>
                            </li>
                        </a>
                        <a href="#essential">
                            <li class="sidebarList">
                                <i class="bx bx-file me-2"></i>
                                <span>{{ __('site.essential_trip_information') }}</span>
                            </li>
                        </a>

                        <a href="#t_booking">

                            <li class="sidebarList">
                                <i class="bx bx-credit-card me-2"></i>
                                <span>{{ __('site.booking_now') }}</span>
                            </li>
                        </a>

                        <a href="#t_read">

                            <li class="sidebarList">
                                <i class="bx bx-book-open me-2"></i>
                                <span>{{ __('site.read_before_you_go') }}</span>
                            </li>
                        </a>
                        <a href="#t_related">

                            <li class="sidebarList">
                                <i class="bx bxs-plane-alt me-2"></i>
                                <span>{{ __('site.related_tours') }}</span>
                            </li>
                        </a>

                        <li
                            class="text-white cursor-pointer font-semibold capitalize my-2 px-3 py-2 rounded-md bg-second-color"
                        >
                            <span>{{ __('site.send_a_request_for_this_tour') }}</span>
                        </li>

                        <li
                            class="text-white cursor-pointer font-semibold capitalize my-2 px-3 py-2 rounded-md bg-second-color"
                        >
                            <span>{{ __('site.click_to_whatsapp') }}</span>
                        </li>
                    </ul>
                </aside>

                <!-- tour information , details -->
                <article class="description mt-10 p-3">
                    <!-- tour details -->
                    <div id="t_details">
                        <div class="capitalize flex flex-wrap lg:flex-nowrap flex-grow justify-between">
                            <h2 class="font-semibold text-main-color text-2xl py-3 flex-grow xl:w-1/3">

                                {{ $tour->title }}
                            </h2>
                            <div class="flex items-center flex-wrap justify-between flex-grow lg:ps-5">
                                <button class="mainBtn me-1 mb-2 text-center w-full xl:w-auto">
                                    {{ __('site.from') }}: US$ <span>{{ $tour->startFrom }}</span>
                                </button>
                                <a href="#" class="mainBtn me-1 mb-2 text-center max-[430px]:flex-grow">
                                    {{ __('site.send_to_a_friend') }}
                                </a>
                                <a href="#" class="mainBtn me-1 mb-2 text-center max-[430px]:flex-grow">
                                    {{ __('site.send_an_inquiry') }}
                                </a>
                            </div>
                        </div>

                        <div class="bg-[#F2FCFF] p-2 py-4 shadow-md rounded-lg mb-3">
                            <h2>
                                <i class="bx bx-paper-plane text-main-color me-2 text-lg"></i>
                                <span class="text-2xl capitalize font-semibold">{{ __('site.tour_details') }}</span>
                            </h2>
                            <table class="table-auto border border-zinc-300 w-full capitalize mt-4 max-[440px]:text-xs">
                                <tr class="">
                                    <td class="p-2">
                                        <i class="bx bxs-hourglass-bottom me-1"></i>
                                        <span class="text-slate-500 font-semibold">{{ __('site.duration') }}</span>
                                    </td>
                                    <td class="p-2">
                                        <span class="text-slate-500 font-semibold">{{ $tour->duration }}</span>
                                    </td>
                                </tr>
                                <tr class="bg-[#E7F9FF]">
                                    <td class="p-2">
                                        <i class="bx bxs-map-alt me-1"></i>
                                        <span class="text-slate-500 font-semibold">{{ __('site.tour_location') }}</span>
                                    </td>
                                    <td class="p-2">
                                <span class="text-slate-500 font-semibold">
                                    @foreach ($tour->destinations as $i => $des)
                                        @if ($i > 0)
                                            /
                                        @endif
                                        {{ $des->title }}
                                    @endforeach
                                </span>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td class="p-2">
                                        <i class="bx bxs-calendar me-1"></i>
                                        <span class="text-slate-500 font-semibold">{{ __('site.tour_availability') }}</span>
                                    </td>
                                    <td class="p-2">
                                        <span class="text-slate-500 font-semibold">{{ __('site.everyday') }}</span>
                                    </td>
                                </tr>
                                <tr class="bg-[#E7F9FF]">
                                    <td class="p-2">
                                        <i class="bx bx-map me-1"></i>
                                        <span class="text-slate-500 font-semibold">{{ __('site.pick_up_drop_off') }}</span>
                                    </td>
                                    <td class="p-2">
                                        <span class="text-slate-500 font-semibold">{{ __('site.cairo_airport') }}</span>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td class="p-2">
                                        <i class="bx bx-planet me-1"></i>
                                        <span class="text-slate-500 font-semibold">{{ __('site.tour_type') }}</span>
                                    </td>
                                    <td class="p-2">
                                        <span class="text-slate-500 font-semibold">{{ __('site.classic_tour') }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="bg-[#F2FCFF] p-2 py-4 shadow-md rounded-lg mb-3">
                            <h2 class="text-2xl capitalize font-semibold text-main-color">
                                {{ $tour->title }}
                            </h2>
                            <p class="text-zinc-500 my-3">
                                {!! $tour->overview !!}
                            </p>
                        </div>
                    </div>

                    @include('site.tour_details.sections.inclusion-exclusions')

                    @include('site.tour_details.sections.days')


                    @if($tour->tour_for === \App\Enums\TourPricingType::PACKAGE_GROUP->value && !empty($tour->seasons))
                        @include('site.tour_details.sections.prices')
                    @endif



                    <!-- about tour  -->
{{--                    <div class="bg-slate-100 px-3 py-6 rounded-md mb-4">--}}
{{--                        <div class="text-2xl text-main-color flex">--}}
{{--                            <i class="bx bxs-plane-alt me-2"></i>--}}
{{--                            <h5 class="capitalize font-semibold">--}}
{{--                                what you will love about this tour?--}}
{{--                            </h5>--}}
{{--                        </div>--}}

{{--                        <ul class="my-5 list-none">--}}
{{--                            <li class="mb-4">--}}
{{--                                <i class="bx bxs-bookmark-heart text-red-500 text-2xl"></i>--}}
{{--                                <span class="font-light"--}}
{{--                                >Lorem ipsum dolor sit amet consectetur adipisicing elit.--}}
{{--                      Tempore odio minima placeat culpa reiciendis veritatis!--}}
{{--                      Distinctio, dolores voluptatum asperiores minima autem--}}
{{--                      harum?</span--}}
{{--                                >--}}
{{--                            </li>--}}
{{--                            <li class="mb-4">--}}
{{--                                <i class="bx bxs-bookmark-heart text-red-500 text-2xl"></i>--}}
{{--                                <span class="font-light"--}}
{{--                                >Lorem ipsum dolor sit amet consectetur adipisicing elit.--}}
{{--                      Tempore odio minima placeat culpa reiciendis veritatis!--}}
{{--                      Distinctio, dolores voluptatum asperiores minima autem--}}
{{--                      harum?</span--}}
{{--                                >--}}
{{--                            </li>--}}
{{--                            <li class="mb-4">--}}
{{--                                <i class="bx bxs-bookmark-heart text-red-500 text-2xl"></i>--}}
{{--                                <span class="font-light"--}}
{{--                                >Lorem ipsum dolor sit amet consectetur adipisicing elit.--}}
{{--                      Tempore odio minima placeat culpa reiciendis veritatis!--}}
{{--                      Distinctio, dolores voluptatum asperiores minima autem--}}
{{--                      harum?</span--}}
{{--                                >--}}
{{--                            </li>--}}
{{--                            <li class="mb-4">--}}
{{--                                <i class="bx bxs-bookmark-heart text-red-500 text-2xl"></i>--}}
{{--                                <span class="font-light"--}}
{{--                                >Lorem ipsum dolor sit amet consectetur adipisicing elit.--}}
{{--                      Tempore odio minima placeat culpa reiciendis veritatis!--}}
{{--                      Distinctio, dolores voluptatum asperiores minima autem--}}
{{--                      harum?</span--}}
{{--                                >--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}

                    @include('site.tour_details.sections.gallery')

                    <!-- tour review -->

                    <div id="t_review" class="bg-slate-50 my-7 py-7 px-3">
                        <div class="text-2xl text-main-color mb-3 text-center">

                            <h5 class="capitalize font-semibold">
                                {{ $tour->title }} - {{ __('site.clients') }} <span class="text-second-color">{{ __('site.reviews') }}</span>
                            </h5>
                            <a href="#" class="text-base capitalize">{{ __('site.show_more') }}</a>
                        </div>

                        <div class="reviewSlider owl-carousel owl-theme">
                            @forelse ($tour->comments as $com )
                                <div class="border rounded-md p-2">
                                    <div class="bg-slate-100 p-3 rounded-md ">
                                        <div class="flex capitalize mb-2">
                                            <span class="bg-white text-second-color px-2">{{ __('site.tour_rated') }}:</span>
                                            <div class="ms-3">
                                                <i class='bx bxs-star text-yellow-400'></i>
                                                <i class='bx bxs-star text-yellow-400'></i>
                                                <i class='bx bxs-star text-yellow-400'></i>
                                                <i class='bx bxs-star text-yellow-400'></i>
                                                <i class='bx bxs-star text-yellow-400'></i>
                                            </div>
                                        </div>
                                        <div class="flex capitalize bg-white mb-2">
                                            <span class=" text-second-color px-2">{{ __('site.experience_date') }}:</span>
                                            <span class="ms-3">
                                    {{ $com->created_at->format("d/m/Y") }}
                                </span>
                                        </div>
                                        <p class="text-zinc-500 my-3">
                                            {{ $com->comment }}
                                        </p>
                                        <a href="#" class="text-main-color hover:text-second-color">{{ __('site.read_more') }}</a>

                                        <div class="flex items-center justify-between my-3">
                                            <div class="flex items-center">
                                                <figure class="size-16 me-3"><img
                                                        src="{{ asset("assets/site/img/tripadvisor-logo.png") }}"
                                                        class="w-full h-full" alt=""></figure>
                                                <h6 class="text-lg capitalize text-main-color hover:text-second-color">
                                                    jenna t</h6>
                                            </div>
                                            <figure class="size-16"><img src="{{ asset("assets/site/img/quote.png") }}"
                                                                         class="w-full h-full" alt=""></figure>
                                        </div>
                                    </div>

                                </div>

                            @empty

                            @endforelse

                        </div>


                    </div>

                    <!-- essentail trip information  -->
{{--                    <div id="essential" class="bg-slate-100 px-3 py-6 rounded-md mb-4 text-center">--}}
{{--                        <div class="text-2xl text-main-color">--}}
{{--                            <i class="bx bxs-edit me-2 text-6xl"></i>--}}
{{--                            <h5 class="capitalize font-semibold">--}}
{{--                                essentail trip information--}}
{{--                            </h5>--}}
{{--                        </div>--}}

{{--                        <p class="text-zinc-500 my-6">--}}
{{--                            Lorem ipsum, dolor sit amet consectetur adipisicing elit.--}}
{{--                            Architecto neque officia quisquam in ipsa enim laboriosam cum,--}}
{{--                            sit et? Omnis, totam blanditiis.--}}
{{--                        </p>--}}
{{--                        <a href="#" class="mainBtn">view essentail trip information</a>--}}
{{--                    </div>--}}

                    @include('site.tour_details.sections.booking')

                    <!-- read befour you go  -->
                    <div id="t_read" class="bg-slate-100 px-3 py-6 rounded-md mb-4">
                        <div class="text-2xl text-main-color flex">
                            <figure class="size-7 me-2">
                                <img src="{{ asset("assets/site/img/light-bulb.png") }}" class="w-full" alt=""/>
                            </figure>
                            <h5 class="capitalize font-semibold">{{ __('site.read_before_you_go') }}</h5>
                        </div>

                        <div
                            class="newsSlider owl-carousel owl-theme grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-11">
                            @forelse ($last_blogs as $blog )
                                <div class="border rounded-md h-full">
                                    <figure class="rounded-md overflow-hidden relative">
                                        <a href="{{ route("site.blog-details",$blog->id) }}">
                                            <img src="{{ $blog->featured_image }}" class="w-full imageAnimation"
                                                 alt="tour image">
                                        </a>
                                        <div
                                            class=" absolute bottom-0 right-0 text-center font-bold px-3 py-1 rounded-s-md transition-time size-14 uppercase hover:bg-main-color bg-second-color text-white">
                                            08<br> dec
                                        </div>
                                    </figure>

                                    <figcaption class="capitalize p-4 hover:shadow-lg transition-time">
                                        <div class="flex items-center lg:text-[13px] xl:text-sm">
                                            <div class="me-3">
                                                <i class='bx bx-user-circle text-second-color'></i>
                                                <span class="text-zinc-500 uppercase ">{{ __('site.admin') }}</span>
                                            </div>
                                            <div class="me-3">
                                                <i class='bx bx-message-rounded-dots text-second-color'></i>
                                                <span class="text-zinc-500 uppercase ">{{ $blog->comments()->count() }} {{ __('site.comments') }}</span>
                                            </div>
                                        </div>
                                        <a href="{{ route("site.blog-details",$blog->id) }}">
                                             <h3 class="text-xl text-main-color hover:text-second-color font-semibold">{{ $blog->title }}</h3>

                                        </a>
                                      <p class="my-3 text-zinc-500">
                                                        {{substr(strip_tags($blog->description), 0, 100) }}.....</p>
                                        <a href="{{ route("site.blog-details",$blog->id) }}"
                                           class="hover:text-main-color text-second-color uppercase ">{{ __('site.read_more') }} <i
                                                class='bx bx-right-arrow-alt bx-tada bx-flip-horizontal'></i></a>
                                    </figcaption>
                                </div>

                            @empty

                            @endforelse


                        </div>
                    </div>
                </article>
            </div>
        </div>
    </main>
@endsection


<!-- tour details area End -->
@push('js')

    <script>
        const stars = document.querySelectorAll('input[type="radio"]');
        const labels = document.querySelectorAll('label');
        const rattingInput = $("input[name='ratingResult']");

        let rating = 0;

        stars.forEach((star, index) => {
            star.addEventListener('change', () => {
                rating = index + 1;
                for (let i = 0; i <= index; i++) {
                    labels[i].classList.add('yellow');
                    rattingInput.val(rating);
                }
                for (let i = index + 1; i < stars.length; i++) {
                    labels[i].classList.remove('yellow');
                }
            });
        });
    </script>
    <script>
        $("#book-tour").on('submit', function (e) {
            e.preventDefault()
            let submitBtn = $(this).find('button')
            submitBtn.attr('disabled', true)
            axios.post($(this).attr('action'), $(this).serialize()).then((res) => {
                toastr.success(res.data.success);
                setTimeout(() => {
                    location.reload();
                }, 1000)
            }).catch(error => {
                toastr.error(error.response.data.error ?? '{{ __('main.unexpected-error') }}')
                submitBtn.attr('disabled', false)
            }).finally()
        })

        try {
            $('.select2').select2()
        } catch (e) {

        }
    </script>
@endpush
@push('js')
    <script>
        $("#Book").on('submit', function (e) {
            e.preventDefault()
            axios.post($(this).attr('action'), $(this).serialize()).then((res) => {
                toastr.success(res.data.message);
                // setTimeout(() => {
                //     window.location.href = res.data.route;
                // }, 1000);
            }).catch(error => {
                console.log(error);
                if (error.response.data.message) {
                    toastr.error(error.response.data.message ?? '{{ __('main.unexpected-error') }}')
                } else {
                    toastr.error(error.response.data.error ?? '{{ __('main.unexpected-error') }}')
                }
            }).finally()
        })
    </script>
@endpush
@push('js')
    <script>
        $('#Comment').on('submit', function (e) {
            e.preventDefault()
            axios.post($(this).attr('action'), $(this).serialize()).then((res) => {
                toastr.success(res.data.message);
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            }).catch(error => {
                console.log(error);
                if (error.response.data.message) {
                    toastr.error(error.response.data.message ?? '{{ __('main.unexpected-error') }}')
                } else {
                    toastr.error(error.response.data.error ?? '{{ __('main.unexpected-error') }}')
                }
            }).finally()
        })
    </script>
@endpush
@push('js')
    <script>
        $('.tourDetailsNav ul li a').on('click', function (e) {
            e.preventDefault()
            const target = $(this).data('target')
            if (target) {
                const targetOffset = $(target).offset().top;
                // Smoothly scroll to the target offset
                $('html, body').animate({
                    scrollTop: targetOffset
                }, 800); // 800 is the
            }
        })
    </script>
@endpush
