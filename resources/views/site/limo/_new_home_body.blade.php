@php
    $limoAirportLocations = $limoAirportLocations ?? collect();
    $limoTravelLocations = $limoTravelLocations ?? collect();
    $limoCityLocations = $limoCityLocations ?? collect();
    $limoHasAirport = $limoHasAirport ?? false;
    $limoHasTravel = $limoHasTravel ?? false;
    $limoHasCity = $limoHasCity ?? false;
    $limoDefaultTab = $limoDefaultTab ?? 'airport';
    $limoHasAnyCategory = $limoHasAirport || $limoHasTravel || $limoHasCity;
    $limoTripRouteRules = $limoTripRouteRules ?? [];
@endphp
<!-- overflow hidden -->
    <div class="overflow-hidden">
      <section
        class="limo-hero-bg relative min-h-[100svh] overflow-hidden text-white"
        aria-label="Book a limousine"
      >
        <div
          class="container relative z-10 mx-auto flex max-w-[1400px] flex-col gap-10 px-5 pb-12 pt-10 lg:flex-row lg:items-end lg:gap-12 lg:pb-16 lg:pt-14 xl:px-8"
        >

          <div
            data-aos="fade-right"
            data-aos-delay="120"
            data-aos-duration="800"
            data-aos-once="true"
            class="relative flex w-full flex-1 flex-col  lg:min-h-[min(85svh,760px)]"
          >
            <div
              class="relative z-10 max-w-xl lg:mb-6"
              data-aos="fade-up"
              data-aos-delay="180"
              data-aos-duration="700"
              data-aos-once="true"
            >
              <p class="mb-3 text-sm font-normal text-white/90 md:text-base">
                Are you frustrated by tedious car services?
              </p>
              <h1
                class=" font-bold leading-tight tracking-tight text-white text-3xl lg:text-[2.65rem] xl:text-5xl"
              >
                Revealing New Horizons of
              </h1>
              <span
                class="limo-accent-bg mt-2 inline-block rounded-sm px-1 py-0.5 font-bold text-white text-2xl  lg:text-[1.5rem] xl:text-[2rem]"
                >Luxurious &amp; Eco-Friendly Rides</span
              >
            </div>
            <div
              class="relative -mx-4 mt-6 w-[110%] max-w-none sm:mx-0 sm:w-full lg:absolute lg:bottom-0 lg:left-0 lg:mt-0 lg:w-[min(120%,900px)] lg:max-w-none lg:translate-x-[-8%]"
              data-aos="fade-up"
              data-aos-delay="260"
              data-aos-duration="900"
              data-aos-once="true"
            >
              <img
                src="{{ asset('assets/site/limo/image/visa/limo-hero.png') }}"
                alt="Luxury electric sedan"
                class="pointer-events-none w-full select-none object-contain object-left-bottom drop-shadow-2xl"
                width="900"
                height="520"
              />
            </div>
          </div>

          <!-- Right: booking card -->
          <div
            data-aos="fade-left"
            data-aos-delay="200"
            data-aos-duration="800"
            data-aos-once="true"
            class="relative z-20 w-full shrink-0 lg:mb-10 lg:max-w-[440px] xl:max-w-[460px]"
          >
            <div
              class="rounded-2xl bg-white p-5 shadow-[0_24px_60px_rgba(0,0,0,0.45)] sm:p-6"
              data-aos="zoom-in"
              data-aos-delay="280"
              data-aos-duration="750"
              data-aos-once="true"
            >
              @if (!$limoHasAnyCategory)
              <p class="px-2 py-6 text-center text-sm text-gray-600">{{ __('site.limo_no_booking_routes') }}</p>
              @else
              <!-- Tabs -->
              <div
                class="mb-5 flex border-b border-gray-200 text-center text-xs font-medium text-gray-500 sm:text-sm"
                role="tablist"
              >
                @if ($limoHasAirport)
                <button
                  type="button"
                  class="limo-tab flex flex-1 flex-col items-center gap-1 border-b-[3px] border-b-transparent pb-3 pt-1 transition-colors hover:text-gray-900 {{ ($limoHasTravel || $limoHasCity) ? 'border-r border-gray-200' : '' }} {{ $limoDefaultTab === 'airport' ? 'text-gray-900 font-semibold' : 'text-gray-600' }}"
                  style="border-bottom-color: {{ $limoDefaultTab === 'airport' ? '#1f2937' : 'transparent' }}"
                  data-tab="airport"
                  role="tab"
                  aria-selected="{{ $limoDefaultTab === 'airport' ? 'true' : 'false' }}"
                >
                  <img
                    src="{{ asset('assets/site/limo/image/visa/flight-land-round-24px%202.png') }}"
                    alt=""
                    class="h-6 w-6 object-contain"
                    width="24"
                    height="24"
                  />
                  <span>Airport Visa</span>
                </button>
                @endif
                @if ($limoHasTravel)
                <button
                  type="button"
                  class="limo-tab flex flex-1 flex-col items-center gap-1 border-b-[3px] border-b-transparent pb-3 pt-1 transition-colors hover:text-gray-900 {{ $limoHasCity ? 'border-r border-gray-200' : '' }} {{ $limoDefaultTab === 'travel' ? 'text-gray-900 font-semibold' : 'text-gray-600' }}"
                  style="border-bottom-color: {{ $limoDefaultTab === 'travel' ? '#1f2937' : 'transparent' }}"
                  data-tab="travel"
                  role="tab"
                  aria-selected="{{ $limoDefaultTab === 'travel' ? 'true' : 'false' }}"
                >
                  <img
                    src="{{ asset('assets/site/limo/image/visa/luggage-round-24px.png') }}"
                    alt=""
                    class="h-6 w-6 object-contain"
                    width="24"
                    height="24"
                  />
                  <span>Travel Limo</span>
                </button>
                @endif
                @if ($limoHasCity)
                <button
                  type="button"
                  class="limo-tab flex flex-1 flex-col items-center gap-1 border-b-[3px] border-b-transparent pb-3 pt-1 transition-colors hover:text-gray-900 {{ $limoDefaultTab === 'city' ? 'text-gray-900 font-semibold' : 'text-gray-600' }}"
                  style="border-bottom-color: {{ $limoDefaultTab === 'city' ? '#1f2937' : 'transparent' }}"
                  data-tab="city"
                  role="tab"
                  aria-selected="{{ $limoDefaultTab === 'city' ? 'true' : 'false' }}"
                >
                  <img
                    src="{{ asset('assets/site/limo/image/visa/limo.png') }}"
                    alt=""
                    class="h-6 w-6 object-contain"
                    width="24"
                    height="24"
                  />
                  <span>City Ride </span>
                </button>
                @endif
              </div>

              @if ($limoHasAirport)
              <!-- Airport panel -->
              <div
                id="panel-airport"
                class="limo-panel text-gray-900{{ $limoDefaultTab === 'airport' ? '' : ' hidden' }}"
                role="tabpanel"
                data-panel="airport"
                @if ($limoDefaultTab !== 'airport') hidden @endif
              >
                <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                  <h2 class="text-lg font-bold text-gray-900">Book Airport Limo</h2>
                  <div class="flex items-center gap-4 text-sm">
                    <label
                      class="limo-trip-mode-label inline-flex cursor-pointer items-center gap-2"
                      data-limo-trip-group="airport-trip"
                      data-limo-trip-value="round"
                    >
                      <input
                        type="radio"
                        name="airport-trip"
                        value="round"
                        class="trip-toggle h-4 w-4 border-gray-300 text-[var(--limo-color-primary)] focus:ring-[var(--limo-color-primary)]"
                        data-target="airport-return-date"
                      />
                      <span class="text-gray-700">Round Trip</span>
                    </label>
                    <label
                      class="limo-trip-mode-label inline-flex cursor-pointer items-center gap-2"
                      data-limo-trip-group="airport-trip"
                      data-limo-trip-value="one"
                    >
                      <input
                        type="radio"
                        name="airport-trip"
                        value="one"
                        class="trip-toggle h-4 w-4 border-gray-300 text-[var(--limo-color-primary)] focus:ring-[var(--limo-color-primary)]"
                        data-target="airport-return-date"
                        checked
                      />
                      <span class="text-gray-700">One Way</span>
                    </label>
                  </div>
                </div>

                <div class="relative space-y-3">
                  <button
                    type="button"
                    id="airport-swap"
                    class="absolute left-0 top-[2.85rem] z-10 flex h-9 w-9 -translate-x-1 items-center justify-center rounded-md border border-gray-200 bg-white shadow-sm hover:bg-gray-50 sm:left-0"
                    aria-label="Swap pickup and arrival"
                  >
                    <img
                      src="{{ asset('assets/site/limo/image/visa/compare-arrows-sharp-24px.183610cd.png') }}"
                      alt=""
                      class="h-5 w-5"
                      width="20"
                      height="20"
                    />
                  </button>

                  <div class="ps-10 sm:ps-11">
                    <label class="mb-1 block text-xs text-gray-500">Pickup From</label>
                    <div
                      class="flex overflow-hidden rounded-lg border border-gray-200 bg-white"
                    >
                      <div
                        class="flex shrink-0 items-center gap-2 border-r border-gray-200 bg-gray-50 px-3 py-2.5 text-xs text-gray-600 sm:text-sm"
                      >
                        <img
                          src="{{ asset('assets/site/limo/image/visa/pin-drop-twotone-24px.be943d97.png') }}"
                          alt=""
                          class="h-4 w-4"
                          width="16"
                          height="16"
                        />
                        <span>Airport</span>
                      </div>
                      <select
                        id="airport-pickup-location-id"
                        name="airport_pickup_location_id"
                        class="min-w-0 flex-1 border-0 bg-white py-2.5 pe-8 ps-3 text-sm text-gray-800 focus:ring-0"
                      >
                        @forelse ($limoAirportLocations as $loc)
                        <option value="{{ $loc->id }}" @selected($loop->first)>{{ $loc->name }}</option>
                        @empty
                        <option value="">{{ __('site.limo_no_locations') }}</option>
                        @endforelse
                      </select>
                    </div>
                  </div>

                  <div class="ps-10 sm:ps-11">
                    <label class="mb-1 block text-xs text-gray-500">Arrival To</label>
                    <div
                      class="flex overflow-hidden rounded-lg border border-gray-200 bg-white"
                    >
                      <div
                        class="flex shrink-0 items-center gap-2 border-r border-gray-200 bg-gray-50 px-3 py-2.5 text-xs text-gray-600 sm:text-sm"
                      >
                        <img
                          src="{{ asset('assets/site/limo/image/visa/pin-drop-twotone-24px.be943d97.png') }}"
                          alt=""
                          class="h-4 w-4"
                          width="16"
                          height="16"
                        />
                        <span>Address</span>
                      </div>
                      <select
                        id="airport-destination-location-id"
                        name="airport_destination_location_id"
                        class="min-w-0 flex-1 border-0 bg-white py-2.5 pe-8 ps-3 text-sm text-gray-800 focus:ring-0"
                      >
                        <option value="">{{ __('site.please_select') }}</option>
                        @foreach ($limoAirportDestinations as $loc)
                        <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div>
                    <label class="mb-1 block text-xs text-gray-500">Pickup Date</label>
                    <div
                      class="flex items-center gap-2 rounded-lg border border-gray-200 px-3 py-2.5"
                    >
                      <img
                        src="{{ asset('assets/site/limo/image/visa/date-range.d71bb31e.png') }}"
                        alt=""
                        class="h-5 w-5 shrink-0"
                        width="20"
                        height="20"
                      />
                      <input
                        type="date"
                        class="limo-date-picker flex-1 border-0 p-0 text-sm text-gray-800 focus:ring-0"
                        value="{{ now()->format('Y-m-d') }}"
                      />
                    </div>
                  </div>

                  <div id="airport-return-date" class="hidden">
                    <label class="mb-1 block text-xs text-gray-500">Return Date</label>
                    <div
                      class="flex items-center gap-2 rounded-lg border border-gray-200 px-3 py-2.5"
                    >
                      <img
                        src="{{ asset('assets/site/limo/image/visa/date-range.d71bb31e.png') }}"
                        alt=""
                        class="h-5 w-5 shrink-0"
                        width="20"
                        height="20"
                      />
                      <input
                        type="date"
                        class="limo-date-picker flex-1 border-0 p-0 text-sm text-gray-800 focus:ring-0"
                        value="{{ now()->addDay()->format('Y-m-d') }}"
                      />
                    </div>
                  </div>
                </div>

                <div class="mt-4 rounded-xl border border-gray-200 bg-gray-50/90 p-4">
                  <div class="grid gap-4 sm:grid-cols-2 sm:items-end">
                    <div>
                      <label class="mb-1 block text-xs text-gray-500" for="airport-pax">{{ __('site.limo_passengers') }}</label>
                      <input
                        id="airport-pax"
                        name="airport_passengers"
                        type="number"
                        min="1"
                        max="{{ $limoGlobalMaxPassengers ?? 50 }}"
                        value="2"
                        inputmode="numeric"
                        class="w-full max-w-[8rem] rounded-lg border border-gray-200 bg-white px-3 py-2.5 text-sm text-gray-900 focus:border-gray-300 focus:ring-1 focus:ring-gray-200"
                      />
                    </div>
                    <div>
                      <p class="mb-1 text-xs text-gray-500">{{ __('site.limo_estimated_price') }}</p>
                      <p id="airport-estimated-price" class="text-xl font-bold text-gray-900">{{ __('site.limo_price_placeholder') }}</p>
                      <p class="mt-1 text-xs text-gray-500">{{ __('site.limo_price_tier_hint') }}</p>
                    </div>
                  </div>
                </div>

                <div class="mt-6 flex justify-end">
                  <button
                    type="button"
                    id="limo-btn-search-airport"
                    class="limo-primary-bg inline-flex items-center justify-center rounded-xl px-10 py-3 text-sm font-bold uppercase tracking-wide text-white transition hover:opacity-95"
                  >
                    Search
                  </button>
                </div>
              </div>
              @endif

              @if ($limoHasTravel)
              <!-- Travel panel -->
              <div
                id="panel-travel"
                class="limo-panel text-gray-900{{ $limoDefaultTab === 'travel' ? '' : ' hidden' }}"
                role="tabpanel"
                data-panel="travel"
                @if ($limoDefaultTab !== 'travel') hidden @endif
              >
                <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                  <h2 class="text-lg font-bold text-gray-900">Book Travel Limo</h2>
                  <div class="flex items-center gap-4 text-sm">
                    <label
                      class="limo-trip-mode-label inline-flex cursor-pointer items-center gap-2"
                      data-limo-trip-group="travel-trip"
                      data-limo-trip-value="round"
                    >
                      <input
                        type="radio"
                        name="travel-trip"
                        value="round"
                        class="trip-toggle h-4 w-4 border-gray-300 text-gray-900 focus:ring-gray-900"
                        data-target="travel-return-date"
                      />
                      <span class="text-gray-700">Round Trip</span>
                    </label>
                    <label
                      class="limo-trip-mode-label inline-flex cursor-pointer items-center gap-2"
                      data-limo-trip-group="travel-trip"
                      data-limo-trip-value="one"
                    >
                      <input
                        type="radio"
                        name="travel-trip"
                        value="one"
                        class="trip-toggle h-4 w-4 border-gray-300 text-gray-900 focus:ring-gray-900"
                        data-target="travel-return-date"
                        checked
                      />
                      <span class="text-gray-700">One Way</span>
                    </label>
                  </div>
                </div>

                <div class="grid gap-3 sm:grid-cols-2">
                  <div class="sm:col-span-1">
                    <label class="mb-1 block text-xs text-gray-500">Travel From City</label>
                    <div
                      class="flex overflow-hidden rounded-lg border border-gray-200 bg-white"
                    >
                      <div
                        class="flex shrink-0 items-center border-r border-gray-200 bg-gray-50 px-2.5 py-2"
                      >
                        <img
                          src="{{ asset('assets/site/limo/image/visa/pin-drop-twotone-24px.be943d97.png') }}"
                          alt=""
                          class="h-4 w-4"
                          width="16"
                          height="16"
                        />
                      </div>
                      <select
                        id="travel-from-location-id"
                        name="travel_pickup_location_id"
                        class="min-w-0 flex-1 border-0 bg-white py-2.5 pe-2 ps-2 text-sm text-gray-800 focus:ring-0"
                      >
                        <option value="">{{ __('site.please_select') }}</option>
                        @foreach ($limoTravelLocations as $loc)
                        <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="sm:col-span-1">
                    <label class="mb-1 block text-xs text-gray-500">Choose Address</label>
                    <input
                      type="text"
                      class="w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-gray-300 focus:ring-1 focus:ring-gray-200"
                      placeholder="Enter a Location"
                    />
                  </div>
                  <div class="sm:col-span-1">
                    <label class="mb-1 block text-xs text-gray-500">Travel To City</label>
                    <div
                      class="flex overflow-hidden rounded-lg border border-gray-200 bg-white"
                    >
                      <div
                        class="flex shrink-0 items-center border-r border-gray-200 bg-gray-50 px-2.5 py-2"
                      >
                        <img
                          src="{{ asset('assets/site/limo/image/visa/pin-drop-twotone-24px.be943d97.png') }}"
                          alt=""
                          class="h-4 w-4"
                          width="16"
                          height="16"
                        />
                      </div>
                      <select
                        id="travel-to-location-id"
                        name="travel_destination_location_id"
                        class="min-w-0 flex-1 border-0 bg-white py-2.5 pe-2 ps-2 text-sm text-gray-800 focus:ring-0"
                      >
                        <option value="">{{ __('site.please_select') }}</option>
                        @foreach ($limoTravelLocations as $loc)
                        <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="sm:col-span-1">
                    <label class="mb-1 block text-xs text-gray-500">Choose Address</label>
                    <input
                      type="text"
                      class="w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-gray-300 focus:ring-1 focus:ring-gray-200"
                      placeholder="Enter a Location"
                    />
                  </div>
                </div>

                <div class="mt-3">
                  <label class="mb-1 block text-xs text-gray-500">Pickup Date</label>
                  <div
                    class="flex items-center gap-2 rounded-lg border border-gray-200 px-3 py-2.5"
                  >
                    <img
                      src="{{ asset('assets/site/limo/image/visa/date-range.d71bb31e.png') }}"
                      alt=""
                      class="h-5 w-5 shrink-0"
                      width="20"
                      height="20"
                    />
                    <input
                      type="date"
                      class="limo-date-picker flex-1 border-0 p-0 text-sm text-gray-800 focus:ring-0"
                      value="{{ now()->format('Y-m-d') }}"
                    />
                  </div>
                </div>

                <div id="travel-return-date" class="mt-3 hidden">
                  <label class="mb-1 block text-xs text-gray-500">Return Date</label>
                  <div
                    class="flex items-center gap-2 rounded-lg border border-gray-200 px-3 py-2.5"
                  >
                    <img
                      src="{{ asset('assets/site/limo/image/visa/date-range.d71bb31e.png') }}"
                      alt=""
                      class="h-5 w-5 shrink-0"
                      width="20"
                      height="20"
                    />
                    <input
                      type="date"
                      class="limo-date-picker flex-1 border-0 p-0 text-sm text-gray-800 focus:ring-0"
                      value="{{ now()->addDay()->format('Y-m-d') }}"
                    />
                  </div>
                </div>

                <div class="mt-4 rounded-xl border border-gray-200 bg-gray-50/90 p-4">
                  <div class="grid gap-4 sm:grid-cols-2 sm:items-end">
                    <div>
                      <label class="mb-1 block text-xs text-gray-500" for="travel-pax">{{ __('site.limo_passengers') }}</label>
                      <input
                        id="travel-pax"
                        name="travel_passengers"
                        type="number"
                        min="1"
                        max="{{ $limoGlobalMaxPassengers ?? 50 }}"
                        value="2"
                        inputmode="numeric"
                        class="w-full max-w-[8rem] rounded-lg border border-gray-200 bg-white px-3 py-2.5 text-sm text-gray-900 focus:border-gray-300 focus:ring-1 focus:ring-gray-200"
                      />
                    </div>
                    <div>
                      <p class="mb-1 text-xs text-gray-500">{{ __('site.limo_estimated_price') }}</p>
                      <p id="travel-estimated-price" class="text-xl font-bold text-gray-900">{{ __('site.limo_price_placeholder') }}</p>
                      <p class="mt-1 text-xs text-gray-500">{{ __('site.limo_price_tier_hint') }}</p>
                    </div>
                  </div>
                </div>

                <div class="mt-6 flex justify-end">
                  <button
                    type="button"
                    id="limo-btn-search-travel"
                    class="limo-primary-bg-alt w-full rounded-xl py-3 text-sm font-bold uppercase tracking-wide text-white transition hover:opacity-95 sm:w-auto sm:px-12"
                  >
                    Search
                  </button>
                </div>
              </div>
              @endif

              @if ($limoHasCity)
              <!-- City panel -->
              <div
                id="panel-city"
                class="limo-panel text-gray-900{{ $limoDefaultTab === 'city' ? '' : ' hidden' }}"
                role="tabpanel"
                data-panel="city"
                @if ($limoDefaultTab !== 'city') hidden @endif
              >
                <h2 class="mb-4 text-lg font-bold text-gray-900">Book City Limo</h2>

                <div class="mb-4">
                  <label class="mb-1 block text-xs text-gray-500">City</label>
                  <div class="inline-flex items-center gap-1 border-b border-dotted border-gray-800 pb-0.5">
                    <select
                      id="limo-city-location-id"
                      name="city_pickup_location_id"
                      class="limo-city-select cursor-pointer border-0 bg-transparent p-0 pe-6 text-sm font-medium text-gray-900 focus:ring-0"
                    >
                      @forelse ($limoCityLocations as $loc)
                      <option value="{{ $loc->id }}" @selected($loop->first)>{{ $loc->name }}</option>
                      @empty
                      <option value="">{{ __('site.limo_no_locations') }}</option>
                      @endforelse
                    </select>
                  </div>
                </div>

                <div class="mb-4">
                  <label class="mb-1 block text-xs text-gray-500" for="limo-city-pax">{{ __('site.limo_passengers') }}</label>
                  <input
                    id="limo-city-pax"
                    name="city_passengers"
                    type="number"
                    min="1"
                    max="{{ $limoGlobalMaxPassengers ?? 50 }}"
                    value="2"
                    inputmode="numeric"
                    class="w-full max-w-[8rem] rounded-lg border border-gray-200 bg-white px-3 py-2.5 text-sm text-gray-900 focus:border-gray-300 focus:ring-1 focus:ring-gray-200"
                  />
                  <p class="mt-1 text-xs text-gray-500">{{ __('site.limo_city_pax_price_hint') }}</p>
                </div>

                <p class="mb-2 text-xs font-medium text-gray-500">Choose Service</p>
                <div class="grid grid-cols-2 gap-2 sm:gap-3">
                  <label class="limo-service-card">
                    <input
                      type="radio"
                      name="city-service"
                      value="3"
                      class="peer sr-only"
                      checked
                    />
                    <span
                      class="limo-service-check absolute right-2 top-2 hidden h-4 w-4 items-center justify-center rounded-full text-[10px] font-bold text-white peer-checked:flex"
                      aria-hidden="true"
                      >✓</span
                    >
                    <span class="text-xs text-gray-500">Short Ride</span>
                    <span class="limo-service-price text-sm font-bold text-gray-800">3 Hours</span>
                  </label>
                  <label class="limo-service-card">
                    <input type="radio" name="city-service" value="6" class="peer sr-only" />
                    <span
                      class="limo-service-check absolute right-2 top-2 hidden h-4 w-4 items-center justify-center rounded-full text-[10px] font-bold text-white peer-checked:flex"
                      aria-hidden="true"
                      >✓</span
                    >
                    <span class="text-xs text-gray-500">Long Ride</span>
                    <span class="limo-service-price text-sm font-bold text-gray-800">6 Hours</span>
                  </label>
                  <label class="limo-service-card">
                    <input type="radio" name="city-service" value="8" class="peer sr-only" />
                    <span
                      class="limo-service-check absolute right-2 top-2 hidden h-4 w-4 items-center justify-center rounded-full text-[10px] font-bold text-white peer-checked:flex"
                      aria-hidden="true"
                      >✓</span
                    >
                    <span class="text-xs text-gray-500">Full Day Ride</span>
                    <span class="limo-service-price text-sm font-bold text-gray-800">8 Hours</span>
                  </label>
                  <label class="limo-service-card">
                    <input type="radio" name="city-service" value="12" class="peer sr-only" />
                    <span
                      class="limo-service-check absolute right-2 top-2 hidden h-4 w-4 items-center justify-center rounded-full text-[10px] font-bold text-white peer-checked:flex"
                      aria-hidden="true"
                      >✓</span
                    >
                    <span class="text-xs text-gray-500">Full Day Ride</span>
                    <span class="limo-service-price text-sm font-bold leading-snug text-gray-800"
                      >12 Hours (Full Day)</span
                    >
                  </label>
                </div>

                <div class="mt-4">
                  <label class="mb-1 block text-xs text-gray-500">Choose Pickup Date</label>
                  <div
                    class="flex items-center gap-2 rounded-lg border border-gray-200 px-3 py-2.5"
                  >
                    <img
                      src="{{ asset('assets/site/limo/image/visa/date-range.d71bb31e.png') }}"
                      alt=""
                      class="h-5 w-5 shrink-0"
                      width="20"
                      height="20"
                    />
                    <input
                      type="date"
                      class="limo-date-picker flex-1 border-0 p-0 text-sm text-gray-800 focus:ring-0"
                      value="{{ now()->format('Y-m-d') }}"
                    />
                  </div>
                </div>

                <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                  <div>
                    <p class="text-xs text-gray-500" id="city-hours-label">3 Hours</p>
                    <p class="text-2xl font-bold text-gray-900">
                      <span id="city-price">515</span>
                      <span class="text-base font-semibold text-gray-700">EGP</span>
                    </p>
                  </div>
                  <button
                    type="button"
                    id="limo-btn-search-city"
                    class="limo-primary-bg-soft w-full rounded-xl py-3 text-sm font-bold uppercase tracking-wide text-white transition hover:opacity-95 sm:w-auto sm:min-w-[140px] sm:px-8"
                  >
                    Search
                  </button>
                </div>
              </div>
              @endif
              @endif
            </div>
          </div>
        </div>
      </section>

      <section
        class="limo-page-bg py-14 lg:py-16"
        aria-label="visa Egypt services"
        data-aos="fade-up"
        data-aos-duration="850"
        data-aos-once="true"
      >
        <div class="container mx-auto max-w-[1280px] px-5 xl:px-8">
          <div
            class="text-center"
            data-aos="fade-up"
            data-aos-delay="80"
            data-aos-duration="750"
            data-aos-once="true"
          >
            <h2 class="limo-heading text-xl font-bold uppercase tracking-wide">
              visa Egypt Services
            </h2>
            <p class="limo-subheading mt-1 text-[30px] font-light leading-tight">
              All Your Needs Fulfilled.
            </p>
          </div>

          <div class="mt-10 grid gap-8 text-center md:grid-cols-3 md:gap-6">
            <article
              class="flex flex-col items-center"
              data-aos="fade-up"
              data-aos-delay="100"
              data-aos-duration="700"
              data-aos-once="true"
            >
              <img
                src="{{ asset('assets/site/limo/image/visa/flight-land-round-24px%202.png') }}"
                alt=""
                class="h-14 w-14 object-contain opacity-70"
                width="56"
                height="56"
              />
              <h3 class="limo-title mt-3 text-xl font-semibold">Airport Limousine</h3>
              <p class="limo-muted mt-1 text-sm">Get your luxury trip to &amp; from the airport</p>
            </article>
            <article
              class="flex flex-col items-center"
              data-aos="fade-up"
              data-aos-delay="200"
              data-aos-duration="700"
              data-aos-once="true"
            >
              <img
                src="{{ asset('assets/site/limo/image/visa/luggage-round-24px.png') }}"
                alt=""
                class="h-14 w-14 object-contain opacity-70"
                width="56"
                height="56"
              />
              <h3 class="limo-title mt-3 text-xl font-semibold">Travel in Style</h3>
              <p class="limo-muted mt-1 text-sm">Travel with no worry about the road</p>
            </article>
            <article
              class="flex flex-col items-center"
              data-aos="fade-up"
              data-aos-delay="300"
              data-aos-duration="700"
              data-aos-once="true"
            >
              <img
                src="{{ asset('assets/site/limo/image/visa/limo.png') }}"
                alt=""
                class="h-14 w-14 object-contain opacity-70"
                width="56"
                height="56"
              />
              <h3 class="limo-title mt-3 text-xl font-semibold">Luxury City Ride</h3>
              <p class="limo-muted mt-1 text-sm">Enjoy a comfortable ride around the city</p>
            </article>
          </div>

          <div
            class="limo-info-bg limo-info-text mt-10 rounded-md px-6 py-7 text-center"
            data-aos="fade-up"
            data-aos-delay="120"
            data-aos-duration="800"
            data-aos-once="true"
          >
            <p class="mx-auto max-w-[760px] text-sm leading-relaxed md:text-base">
              Enjoy an unparalleled experience from the moment you book your ride until you arrive at your
              destination. Get the ride you deserve everywhere: from &amp; to airports, within the city,
              or city to city with Visa.
            </p>
          </div>

          <div
            class="mt-8 overflow-hidden rounded-md shadow-[0_14px_30px_rgba(0,0,0,0.18)]"
            data-aos="zoom-in"
            data-aos-delay="100"
            data-aos-duration="900"
            data-aos-once="true"
          >
            <div class="relative h-[600px]">
              <img
                src="{{ asset('assets/site/limo/image/visa/Visacar2.png') }}"
                alt="visa Egypt luxury car video cover"
                class="h-full w-full object-cover "

              />
              <button
                type="button"
                id="open-video-overlay"
                class="limo-play-bg limo-play-shadow absolute left-1/2 top-1/2 flex h-20 w-20 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full text-white transition hover:scale-105"
                aria-label="Play visa Egypt video"
                data-video-url="https://www.youtube.com/watch?v=mfxQy5A_tHs"
              >
                <span class="ms-1 text-3xl">▶</span>
              </button>
              <div class="absolute bottom-6 left-6 text-white drop-shadow-[0_1px_4px_rgba(0,0,0,0.65)] ">
                <p class="text-2xl font-semibold leading-tight">Explore Visa</p>
                <p class="text-sm">Watch Full Video</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section
        class="limo-page-bg py-14 lg:py-16"
        aria-label="visa Egypt fleet"
        data-aos="fade-up"
        data-aos-duration="850"
        data-aos-once="true"
      >
        <div class="container mx-auto max-w-[1280px] px-5 xl:px-8">
          <div
            data-aos="fade-right"
            data-aos-delay="60"
            data-aos-duration="750"
            data-aos-once="true"
          >
            <h2 class="limo-heading text-2xl font-bold uppercase">visa Egypt Fleet</h2>
            <p class="limo-subheading mt-1 text-[30px] font-light leading-tight">
              Find The Ride That Matches Your Style
            </p>
          </div>

          <div class="mt-8 grid gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">

  <!-- Standard -->
  <article
    class="text-center"
    data-aos="flip-up"
    data-aos-delay="80"
    data-aos-duration="700"
    data-aos-once="true"
  >
    <div class="flex h-[220px] items-center justify-center rounded border border-gray-400 bg-white p-4">
      <img src="{{ asset('assets/site/limo/image/visa/Visacar5.png') }}" alt="Standard car" class="w-full object-contain" />
    </div>
    <h3 class="limo-title mt-4 text-[31px] font-semibold">Standard</h3>
    <p class="limo-muted text-sm">Toyota, KIA, or similar</p>
    <p class="limo-muted text-sm font-semibold">3 Passengers</p>
  </article>

  <!-- Premium -->
  <article
    class="text-center"
    data-aos="flip-up"
    data-aos-delay="120"
    data-aos-duration="700"
    data-aos-once="true"
  >
    <div class="flex h-[220px] items-center justify-center rounded border border-gray-400 bg-white p-4">
      <img src="{{ asset('assets/site/limo/image/visa/Visacar1.png') }}" alt="Premium car" class="w-full object-contain" />
    </div>
    <h3 class="limo-title mt-4 text-[31px] font-semibold">Premium</h3>
    <p class="limo-muted text-sm">
      Toyota ACE 2024 &amp; 2025 or Similar
    </p>
    <p class="limo-muted text-sm font-semibold">6 Passengers</p>
  </article>

  <!-- Luxury -->
  <article
    class="text-center"
    data-aos="flip-up"
    data-aos-delay="160"
    data-aos-duration="700"
    data-aos-once="true"
  >
    <div class="flex h-[220px] items-center justify-center rounded border border-gray-400 bg-white p-4">
      <img src="{{ asset('assets/site/limo/image/visa/Visacar4.png') }}" alt="Luxury car" class="w-full object-contain" />
    </div>
    <h3 class="limo-title mt-4 text-[31px] font-semibold">Luxury</h3>
    <p class="limo-muted text-sm">
      Toyota Coaster 2024 &amp; 2025 or Similar
    </p>
    <p class="limo-muted text-sm font-semibold">10 Passengers</p>
  </article>

</div>

          <div
            class="mt-10 text-center"
            data-aos="fade-up"
            data-aos-delay="100"
            data-aos-duration="700"
            data-aos-once="true"
          >
            <button
              type="button"
              class="rounded-full border border-[#1f1f24] px-8 py-3 text-sm font-bold uppercase tracking-wide text-[#1f1f24] transition hover:bg-[#1f1f24] hover:text-white"
            >
              Explore Our Fleet
            </button>
          </div>
        </div>
      </section>

      <section
        class="limo-page-bg pb-10 lg:pb-14"
        aria-label="Eco friendly section"
        data-aos="fade-up"
        data-aos-duration="900"
        data-aos-once="true"
      >
        <div class="container mx-auto max-w-[1280px] px-5 xl:px-8">
          <div class="relative overflow-hidden">
            <img
              src="{{ asset('assets/site/limo/image/visa/Visacar2.png') }}"
              alt="Eco friendly electric luxury car"
              class="h-[420px] w-full object-cover md:h-[470px]"
              data-aos="fade-right"
              data-aos-delay="80"
              data-aos-duration="900"
              data-aos-once="true"
            />
            <div
              class="absolute right-[8%] bottom-0 w-[300px] max-w-[78%] -translate-y-1/2 bg-[#5fc157] px-8 py-10 text-white md:w-[360px]"
              data-aos="fade-left"
              data-aos-delay="200"
              data-aos-duration="800"
              data-aos-once="true"
            >
              <h3 class="text-3xl font-bold uppercase leading-none">Eco Friendly</h3>
              <p class="mt-3 text-[1.1rem] font-semibold leading-none">Preserve the environment and Visa</p>
              <p class="mt-5 sm:text-x text-[1rem] text-white/95">
                Clean living is a mandatory now more than ever. That’s why we are doing our part to reduce
                the carbon footprint by providing eco-luxury vehicles. Elevate your luxury experience with
                visa Egypt unique eco-friendly fleet.
              </p>
            </div>
          </div>
        </div>
      </section>

      <section
        class="limo-page-bg pb-14 lg:pb-20"
        aria-label="About visa Egypt section"
        data-aos="fade-up"
        data-aos-duration="850"
        data-aos-once="true"
      >
        <div class="container mx-auto max-w-[1280px] px-5 xl:px-8">
          <div class="grid items-center gap-10 lg:grid-cols-[330px_1fr] lg:gap-12">
            <div
              data-aos="fade-right"
              data-aos-delay="100"
              data-aos-duration="800"
              data-aos-once="true"
            >
              <p class="limo-heading text-2xl font-bold uppercase tracking-wide">About visa Egypt</p>
              <h3 class="limo-subheading mt-2 text-[30px] font-light leading-tight">
                Powered by the continuous innovation urge
              </h3>
              <p class="limo-muted mt-4 text-[15px] leading-relaxed">
                Enjoy the days you don't feel like driving yet you want the essence of luxurious rides.
              </p>
              <p class="limo-muted mt-4 text-[15px] leading-relaxed">
                Creating a world of eco-friendly transportation that is luxurious in every detail. A member
                of the visa Egypt Company Group.
              </p>
              <button
                type="button"
                class="mt-8 rounded-full border border-[#1f1f24] px-14 py-4 text-lg font-bold uppercase tracking-wide text-[#1f1f24] transition hover:bg-[#1f1f24] hover:text-white"
              >
                Learn More
              </button>
            </div>

            <div
              data-aos="fade-left"
              data-aos-delay="180"
              data-aos-duration="850"
              data-aos-once="true"
            >
              <img
                src="{{ asset('assets/site/limo/image/visa/about.jpg') }}"
                alt="visa Egypt luxury fleet lineup"
                class="h-[300px] w-full object-cover md:h-[420px]"
              />
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- Video overlay -->
    <div
      id="video-overlay"
      class="fixed inset-0 z-[120] hidden items-center justify-center bg-black/85 px-4 h-screen w-full"
      aria-hidden="true"
    >
      <div class="relative w-full max-w-4xl">
        <button
          type="button"
          id="close-video-overlay"
          class="absolute -top-11 right-0 flex h-9 w-9 items-center justify-center rounded-full bg-white text-2xl leading-none text-gray-900 shadow hover:bg-gray-100"
          aria-label="Close video"
        >
          ×
        </button>
        <div class="overflow-hidden rounded-md bg-black shadow-2xl">
          <iframe
            id="video-overlay-frame"
            class="aspect-video w-full"
            src=""
            title="visa Egypt video"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen
          ></iframe>
        </div>
      </div>
    </div>
    <!-- End Video overlay --><!---->
