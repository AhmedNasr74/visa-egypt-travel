<!-- tour prices -->
<div id="t_price" class="my-5">
    <h2 class="text-2xl capitalize font-semibold text-main-color">
        <i class="bx bx-purchase-tag-alt me-2"></i>Tour Prices</h2>
    <!-- accommodation toggle button -->
    <div class="flex justify-between shadow-sm bg-zinc-100 rounded-md w-fit p-2 my-3">
        <label id="switch-price" class="flex items-center relative w-max cursor-pointer select-none">
            <input id="accommodations" type="checkbox" class="appearance-none transition-colors cursor-pointer w-14 h-7 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-black bg-red-500"/>
            <span class="absolute font-medium text-xs uppercase right-1 text-white">OFF</span>
            <span class="absolute font-medium text-xs uppercase right-8 text-white">ON</span>
            <span class="size-7 right-7 absolute rounded-full transform transition-transform bg-gray-200"></span>
        </label>
        <span class="text-lg ms-3 capitalize">Exclude Accommodations</span>
    </div>

    <!-- price type -->
    <div id="price-with-accommodation">
        @foreach($tour->accommodation as $type => $details)
            <div class="border shadow-md rounded-md overflow-hidden pb-3 mb-4">
                <div class="priceHead bg-main-color p-2 center">
                    <figure class="mb-0 size-7 bg-white rounded-full center">
                        <img
                            src="{{ asset("assets/site/img/star.png") }}"
                            class="w-3/4 h-w-3/4"
                            alt=""
                        />
                    </figure>
                    <h4 class="text-xl font-semibold uppercase text-white ms-2">
                        {{ ucfirst($type) }} ({{ $loop->iteration+3 }} star)
                    </h4>
                </div>

                <div class="grid gap-1 grid-cols-1 md:grid-cols-1 xl:grid-cols-1 p-4">
                    <div>
                        <!-- details -->
                        <div class="priceDetails border border-orange-300 rounded-md p-3 bg-gray-50">
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">solo</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">(PAX)</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{ $details['solo'] }}$</span>
                                    <sub class="font-normal text-sm">/Person</sub>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">2-4</span>
                                    <sub class="text-zinc-500 font-normal text-sm  ml-1">(PAX)</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{ $details['2-4'] }}$</span>
                                    <sub class="font-normal text-sm">/Person</sub>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">5-8</span>
                                    <sub class="text-zinc-500 font-normal text-sm  ml-1">
                                        (PAX)
                                    </sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{ $details['5-8'] }}$</span>
                                    <sub class="font-normal text-sm">/Person</sub>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">9-16</span>
                                    <sub class="text-zinc-500 font-normal text-sm  ml-1">(PAX)</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{ $details['9-16'] }}$</span>
                                    <sub class="font-normal text-sm">/Person</sub>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

    <!-- price type -->
    <div id="price-without-accommodation" class="hidden">
        <!-- Hotel Samples Note -->
<!-- Hotel Samples Note -->
<div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-md">
    <h3 class="text-lg font-semibold text-yellow-800 mb-4">Note: These are examples of our hotels</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 text-sm text-gray-700">
        <div>
            <p class="font-semibold mb-1">4-Star Hotels</p>
            <ul class="list-disc list-inside space-y-1">
                <li>Barcelo Cairo Pyramids</li>
                <li>Sarai Pyramids Hotel</li>
                <li>Cairo Pyramids Hotel</li>
                <li>Jaz Pyramids Cairo</li>
            </ul>
        </div>
        <div>
            <p class="font-semibold mb-1">5-Star Standard Hotels (Gold)</p>
            <ul class="list-disc list-inside space-y-1">
                <li>Steigenberger Pyramids Cairo</li>
                <li>Pyramisa Suites Hotel Cairo</li>
                <li>Ramses Hilton Hotel</li>
                <li>Safir Hotel Cairo</li>
            </ul>
        </div>
        <div>
            <p class="font-semibold mb-1">5-Star Luxury Hotels (Diamond)</p>
            <ul class="list-disc list-inside space-y-1">
                <li>Semiramis InterContinental Cairo</li>
                <li>Hyatt Regency Cairo West</li>
                <li>Sheraton Cairo Hotel & Casino</li>
                <li>Conrad Cairo Hotel</li>
                <li>Fairmont Nile City</li>
            </ul>
        </div>
        <div>
            <p class="font-semibold mb-1">5-Star High Luxury Hotels (Premium)</p>
            <ul class="list-disc list-inside space-y-1">
                <li>The St. Regis Cairo</li>
                <li>The Nile Ritz-Carlton Cairo</li>
                <li>Marriott Mena House, Cairo</li>
                <li>Four Seasons Hotel Cairo at Nile Plaza</li>
                <li>Kempinski Nile Hotel Garden City Cairo</li>
            </ul>
        </div>
    </div>
</div>


        @foreach($tour->without_accommodation as $type => $details)
            <div class="border shadow-md rounded-md overflow-hidden pb-3 mb-4">
                <div class="priceHead bg-main-color p-2 center">
                    <figure class="mb-0 size-7 bg-white rounded-full center">
                        <img
                            src="{{ asset("assets/site/img/star.png") }}"
                            class="w-3/4 h-w-3/4"
                            alt=""
                        />
                    </figure>
                    <h4 class="text-xl font-semibold uppercase text-white ms-2">
                        {{ ucfirst($type) }} ({{ $loop->iteration+3 }} star)
                    </h4>
                </div>

                <div class="grid gap-1 grid-cols-1 md:grid-cols-1 xl:grid-cols-1 p-4">
                    <div>
                        <!-- details -->
                        <div class="priceDetails border border-orange-300 rounded-md p-3 bg-gray-50">
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">solo</span>
                                    <sub class="text-zinc-500 font-normal text-sm ml-1">(PAX)</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{ $details['solo'] }}$</span>
                                    <sub class="font-normal text-sm">/Person</sub>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">2-4</span>
                                    <sub class="text-zinc-500 font-normal text-sm  ml-1">(PAX)</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{ $details['2-4'] }}$</span>
                                    <sub class="font-normal text-sm">/Person</sub>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">5-8</span>
                                    <sub class="text-zinc-500 font-normal text-sm  ml-1">
                                        (PAX)
                                    </sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{ $details['5-8'] }}$</span>
                                    <sub class="font-normal text-sm">/Person</sub>
                                </p>
                            </div>
                            <div
                                class="flex justify-around capitalize text-main-color text-lg font-semibold shadow p-1 mb-3">
                                <p class="flex">
                                    <span class="font-bold flex-shrink-0">9-16</span>
                                    <sub class="text-zinc-500 font-normal text-sm  ml-1">(PAX)</sub>
                                </p>
                                <p class="flex">
                                    <span class="font-bold">{{ $details['9-16'] }}$</span>
                                    <sub class="font-normal text-sm">/Person</sub>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

</div>
@push('js')
    <script>
        $(document).ready(function () {
            $('#accommodations').on('change', function () {
                let val = $(this).is(':checked') ?  'without_accommodation' : 'with_accommodation';
                $('#accommodation_type').val(val)
                document.getElementById('accommodation_type').dispatchEvent(new Event("change"));
                $('#price-with-accommodation').toggleClass('hidden')
                $('#price-without-accommodation').toggleClass('hidden')
            })
        })
    </script>
@endpush
