<!-- tour prices -->
<div id="t_price" class="my-5">
    <h2 class="text-2xl capitalize font-semibold text-main-color">
        <i class="bx bx-purchase-tag-alt me-2"></i> {{ __('site.tour_prices') }}
    </h2>
    @php
        $seasons = [
            "From Jan " . now()->year ." to Apr " . now()->year,
            "From May " . now()->year ." to Sep " . now()->year,
            "From Oct " . now()->year ." to Dec " . now()->year,
            "Peak (23 Dec ". now()->year ." - 7 Jan ".(now()->year + 1).") / (14 - 23 Apr ". now()->year .")"
        ];
    @endphp
    <!-- accommodation toggle button -->
    <div class="flex justify-between shadow-sm bg-zinc-100 rounded-md w-fit p-2 my-3">
        <label class="flex items-center relative w-max cursor-pointer select-none">
            <input id="accommodations" type="checkbox"
                   class="appearance-none transition-colors cursor-pointer w-14 h-7 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-black bg-red-500"/>
            <span class="absolute font-medium text-xs uppercase right-1 text-white">{{ __('site.off') }}</span>
            <span class="absolute font-medium text-xs uppercase right-8 text-white">{{ __('site.on') }}</span>
            <span class="size-7 right-7 absolute rounded-full transform transition-transform bg-gray-200"></span>
        </label> <span class="text-lg ms-3 capitalize">{{ __('site.exclude_accommodations') }}</span>
    </div>

    @php
    $pricing_type = 'accommodation';
    @endphp
    <!-- price type -->
    <div id="price-with-accommodation">

        <div class="border shadow-md rounded-md overflow-hidden pb-3 mb-4">
            <div class="priceHead bg-main-color p-2 center">
                <figure class="mb-0 size-7 bg-white rounded-full center">
                    <img src="{{ asset("assets/site/img/star.png") }}" class="w-3/4 h-w-3/4" alt=""/>
                </figure>
                <h4 class="text-xl font-semibold uppercase text-white ms-2">
                    {{ __('site.standard') }} ({{ __('site.star_4') }})
                </h4>
            </div>

            <div class="grid gap-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-4 p-4">
                @foreach($tour->seasons ?? [] as $season)
                    <div>
                        <!-- title -->
                        <div class="text-main-color capitalize flex md:h-20 mb-3">
                        <span
                            class="flex-shrink-0 size-7 bg-red-800 text-white border-2 rounded-full border-orange-300 center me-2"><i
                                class="bx bx-calendar-check"></i>
                        </span>
                            <span
                                class="text-sm font-semibold">{{ $seasons[$loop->index] }}</span>
                        </div>
                        <!-- details -->
                        <div class="priceDetails border border-orange-300 rounded-md p-3 bg-gray-50">
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">{{ __('site.solo') }} </span>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{ $season[$pricing_type]['stander']['solo'] ?? '' }} US$</span>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">2-4</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['stander']['2-4'] ?? ''}} US$</span>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">5-8</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['stander']['5-8'] ?? ''}} US$</span>
                                </p>
                            </div>

                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">9-16</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['stander']['9-16'] ?? ''}} US$</span>
                                </p>
                            </div>

                        </div>

                    </div>

                @endforeach
            </div>
        </div>

        <div class="border shadow-md rounded-md overflow-hidden pb-3 mb-4">
            <div class="priceHead bg-main-color p-2 center">
                <figure class="mb-0 size-7 bg-white rounded-full center">
                    <img src="{{ asset("assets/site/img/Gold.png") }}" class="w-3/4 h-w-3/4" alt=""/>
                </figure>
                <h4 class="text-xl font-semibold uppercase text-white ms-2">
                    {{ __('site.gold') }} ({{ __('site.star_5_standard') }})
                </h4>
            </div>

            <div class="grid gap-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-4 p-4">

                @foreach($tour->seasons ?? [] as $season)
                    <div>
                        <!-- title -->
                        <div class="text-main-color capitalize flex md:h-20 mb-3">
                        <span
                            class="flex-shrink-0 size-7 bg-red-800 text-white border-2 rounded-full border-orange-300 center me-2"><i
                                class="bx bx-calendar-check"></i>
                        </span>
                            <span
                                class="text-sm font-semibold">{{ $seasons[$loop->index] }}</span>
                        </div>
                        <!-- details -->
                        <div class="priceDetails border border-orange-300 rounded-md p-3 bg-gray-50">
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">{{ __('site.solo') }} </span>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{ $season[$pricing_type]['gold']['solo'] ?? '' }} US$</span>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">2-4</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['gold']['2-4'] ?? ''}} US$</span>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">5-8</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['gold']['5-8'] ?? ''}} US$</span>
                                </p>
                            </div>

                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">9-16</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['gold']['9-16'] ?? ''}} US$</span>
                                </p>
                            </div>

                        </div>

                    </div>

                @endforeach
            </div>

        </div>

        <div class="border shadow-md rounded-md overflow-hidden pb-3 mb-4">
            <div class="priceHead bg-main-color p-2 center">
                <figure class="mb-0 size-7 bg-white rounded-full center">
                    <img src="{{ asset("assets/site/img/crown.png") }}" class="w-3/4 h-w-3/4" alt=""/>
                </figure>
                <h4 class="text-xl font-semibold uppercase text-white ms-2">
                    {{ __('site.luxury') }} ({{ __('site.star_5_luxury') }})
                </h4>
            </div>

            <div class="grid gap-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-4 p-4">

                @foreach($tour->seasons ?? [] as $season)
                    <div>
                        <!-- title -->
                        <div class="text-main-color capitalize flex md:h-20 mb-3">
                        <span
                            class="flex-shrink-0 size-7 bg-red-800 text-white border-2 rounded-full border-orange-300 center me-2"><i
                                class="bx bx-calendar-check"></i>
                        </span>
                            <span
                                class="text-sm font-semibold">{{ $seasons[$loop->index] }}</span>
                        </div>
                        <!-- details -->
                        <div class="priceDetails border border-orange-300 rounded-md p-3 bg-gray-50">
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">{{ __('site.solo') }} </span>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{ $season[$pricing_type]['luxury']['solo'] ?? '' }} US$</span>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">2-4</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['luxury']['2-4'] ?? ''}} US$</span>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">5-8</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['luxury']['5-8'] ?? ''}} US$</span>
                                </p>
                            </div>

                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">9-16</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['luxury']['9-16'] ?? ''}} US$</span>
                                </p>
                            </div>

                        </div>

                    </div>

                @endforeach
            </div>

        </div>

        <div class="border shadow-md rounded-md overflow-hidden pb-3 mb-4">
            <div class="priceHead bg-main-color p-2 center">
                <figure class="mb-0 size-7 bg-white rounded-full center">
                    <img src="{{ asset("assets/site/img/vip-card.png") }}" class="w-3/4 h-w-3/4" alt=""/>
                </figure>
                <h4 class="text-xl font-semibold uppercase text-white ms-2">
                    {{ __('site.platinum') }} ({{ __('site.star_5_high_luxury') }})
                </h4>
            </div>

            <div class="grid gap-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-4 p-4">
                @foreach($tour->seasons ?? [] as $season)
                    <div>
                        <!-- title -->
                        <div class="text-main-color capitalize flex md:h-20 mb-3">
                        <span
                            class="flex-shrink-0 size-7 bg-red-800 text-white border-2 rounded-full border-orange-300 center me-2"><i
                                class="bx bx-calendar-check"></i>
                        </span>
                            <span
                                class="text-sm font-semibold">{{ $seasons[$loop->index] }}</span>
                        </div>
                        <!-- details -->
                        <div class="priceDetails border border-orange-300 rounded-md p-3 bg-gray-50">
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">{{ __('site.solo') }} </span>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{ $season[$pricing_type]['platinum']['solo'] ?? '' }} US$</span>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">2-4</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['platinum']['2-4'] ?? ''}} US$</span>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">5-8</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['platinum']['5-8'] ?? ''}} US$</span>
                                </p>
                            </div>

                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">9-16</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['platinum']['9-16'] ?? ''}} US$</span>
                                </p>
                            </div>

                        </div>

                    </div>

                @endforeach
            </div>

        </div>
    </div>

    @php
        $pricing_type = 'without_accommodation';
    @endphp
        <!-- price type -->
    <div id="price-without-accommodation" class="hidden">

        <div class="border shadow-md rounded-md overflow-hidden pb-3 mb-4">
            <div class="priceHead bg-main-color p-2 center">
                <figure class="mb-0 size-7 bg-white rounded-full center">
                    <img src="{{ asset("assets/site/img/star.png") }}" class="w-3/4 h-w-3/4" alt=""/>
                </figure>
                <h4 class="text-xl font-semibold uppercase text-white ms-2">
                    {{ __('site.standard') }} ({{ __('site.star_4') }})
                </h4>
            </div>

            <div class="grid gap-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-4 p-4">
                @foreach($tour->seasons ?? [] as $season)
                    <div>
                        <!-- title -->
                        <div class="text-main-color capitalize flex md:h-20 mb-3">
                        <span
                            class="flex-shrink-0 size-7 bg-red-800 text-white border-2 rounded-full border-orange-300 center me-2"><i
                                class="bx bx-calendar-check"></i>
                        </span>
                            <span
                                class="text-sm font-semibold">{{ $seasons[$loop->index] }}</span>
                        </div>
                        <!-- details -->
                        <div class="priceDetails border border-orange-300 rounded-md p-3 bg-gray-50">
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">{{ __('site.solo') }} </span>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{ $season[$pricing_type]['stander']['solo'] ?? '' }} US$</span>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">2-4</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['stander']['2-4'] ?? ''}} US$</span>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">5-8</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['stander']['5-8'] ?? ''}} US$</span>
                                </p>
                            </div>

                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">9-16</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['stander']['9-16'] ?? ''}} US$</span>
                                </p>
                            </div>

                        </div>

                    </div>

                @endforeach
            </div>
        </div>

        <div class="border shadow-md rounded-md overflow-hidden pb-3 mb-4">
            <div class="priceHead bg-main-color p-2 center">
                <figure class="mb-0 size-7 bg-white rounded-full center">
                    <img src="{{ asset("assets/site/img/Gold.png") }}" class="w-3/4 h-w-3/4" alt=""/>
                </figure>
                <h4 class="text-xl font-semibold uppercase text-white ms-2">
                    {{ __('site.gold') }} ({{ __('site.star_5_standard') }})
                </h4>
            </div>

            <div class="grid gap-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-4 p-4">

                @foreach($tour->seasons ?? [] as $season)
                    <div>
                        <!-- title -->
                        <div class="text-main-color capitalize flex md:h-20 mb-3">
                        <span
                            class="flex-shrink-0 size-7 bg-red-800 text-white border-2 rounded-full border-orange-300 center me-2"><i
                                class="bx bx-calendar-check"></i>
                        </span>
                            <span
                                class="text-sm font-semibold">{{ $seasons[$loop->index] }}</span>
                        </div>
                        <!-- details -->
                        <div class="priceDetails border border-orange-300 rounded-md p-3 bg-gray-50">
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">{{ __('site.solo') }} </span>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{ $season[$pricing_type]['gold']['solo'] ?? '' }} US$</span>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">2-4</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['gold']['2-4'] ?? ''}} US$</span>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">5-8</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['gold']['5-8'] ?? ''}} US$</span>
                                </p>
                            </div>

                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">9-16</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['gold']['9-16'] ?? ''}} US$</span>
                                </p>
                            </div>

                        </div>

                    </div>

                @endforeach
            </div>

        </div>

        <div class="border shadow-md rounded-md overflow-hidden pb-3 mb-4">
            <div class="priceHead bg-main-color p-2 center">
                <figure class="mb-0 size-7 bg-white rounded-full center">
                    <img src="{{ asset("assets/site/img/crown.png") }}" class="w-3/4 h-w-3/4" alt=""/>
                </figure>
                <h4 class="text-xl font-semibold uppercase text-white ms-2">
                    {{ __('site.luxury') }} ({{ __('site.star_5_luxury') }})
                </h4>
            </div>

            <div class="grid gap-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-4 p-4">

                @foreach($tour->seasons ?? [] as $season)
                    <div>
                        <!-- title -->
                        <div class="text-main-color capitalize flex md:h-20 mb-3">
                        <span
                            class="flex-shrink-0 size-7 bg-red-800 text-white border-2 rounded-full border-orange-300 center me-2"><i
                                class="bx bx-calendar-check"></i>
                        </span>
                            <span
                                class="text-sm font-semibold">{{ $seasons[$loop->index] }}</span>
                        </div>
                        <!-- details -->
                        <div class="priceDetails border border-orange-300 rounded-md p-3 bg-gray-50">
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">{{ __('site.solo') }} </span>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{ $season[$pricing_type]['luxury']['solo'] ?? '' }} US$</span>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">2-4</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['luxury']['2-4'] ?? ''}} US$</span>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">5-8</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['luxury']['5-8'] ?? ''}} US$</span>
                                </p>
                            </div>

                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">9-16</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['luxury']['9-16'] ?? ''}} US$</span>
                                </p>
                            </div>

                        </div>

                    </div>

                @endforeach
            </div>

        </div>

        <div class="border shadow-md rounded-md overflow-hidden pb-3 mb-4">
            <div class="priceHead bg-main-color p-2 center">
                <figure class="mb-0 size-7 bg-white rounded-full center">
                    <img src="{{ asset("assets/site/img/vip-card.png") }}" class="w-3/4 h-w-3/4" alt=""/>
                </figure>
                <h4 class="text-xl font-semibold uppercase text-white ms-2">
                    {{ __('site.platinum') }} ({{ __('site.star_5_high_luxury') }})
                </h4>
            </div>

            <div class="grid gap-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-4 p-4">
                @foreach($tour->seasons ?? [] as $season)
                    <div>
                        <!-- title -->
                        <div class="text-main-color capitalize flex md:h-20 mb-3">
                        <span
                            class="flex-shrink-0 size-7 bg-red-800 text-white border-2 rounded-full border-orange-300 center me-2"><i
                                class="bx bx-calendar-check"></i>
                        </span>
                            <span
                                class="text-sm font-semibold">{{ $seasons[$loop->index] }}</span>
                        </div>
                        <!-- details -->
                        <div class="priceDetails border border-orange-300 rounded-md p-3 bg-gray-50">
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">{{ __('site.solo') }} </span>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{ $season[$pricing_type]['platinum']['solo'] ?? '' }} US$</span>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">2-4</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['platinum']['2-4'] ?? ''}} US$</span>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">5-8</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['platinum']['5-8'] ?? ''}} US$</span>
                                </p>
                            </div>

                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">9-16</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">{{ __('site.pax') }}</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{$season[$pricing_type]['platinum']['9-16'] ?? ''}} US$</span>
                                </p>
                            </div>

                        </div>

                    </div>

                @endforeach
            </div>

        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {
            $('#accommodations').on('change', function () {
                let val = $(this).is(':checked') ?  'without_accommodation' : 'accommodation';
                $('#accommodation_type').val(val)
                document.getElementById('accommodation_type').dispatchEvent(new Event("change"));
                $('#price-with-accommodation').toggleClass('hidden')
                $('#price-without-accommodation').toggleClass('hidden')
            })
        })
    </script>
@endpush
