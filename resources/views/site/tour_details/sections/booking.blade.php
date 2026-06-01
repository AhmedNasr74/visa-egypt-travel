<!-- booking form-->
<div id="t_booking" class="trip bg-slate-100 px-3 py-6 rounded-md mb-4">
    <h5 class="capitalize font-semibold text-2xl text-main-color">
        {{ __('site.book_this_tour') }}
    </h5>
    <form class="my-6 " action="{{ route('site.book') }}" method="post" id="Book">
        @csrf
        <input type="hidden" name="accommodation_type" id="accommodation_type" v-model="accommodation_type"
               @change="updateAccommodationType">

        <input type="hidden" name="tour_id" value="{{ $tour->id }}">
        <div @class([
                        "grid grid-cols-1 sm:grid-cols-1 gap-5" => $tour->tour_for == \App\Enums\TourPricingType::PRICING_GROUP->value,
                        "grid grid-cols-1 sm:grid-cols-2 gap-5" => $tour->tour_for == \App\Enums\TourPricingType::PACKAGE_GROUP->value,
                   ])>
            <div class="">
                <label for="date" class="capitalize block">{{ __('site.select_date') }}</label>
                <input type="date" class=" focus:ring-0 rounded-md mt-1 w-full" v-model="date" name="date" id="date">
            </div>
            <div class=" {{ $tour->tour_for == \App\Enums\TourPricingType::PRICING_GROUP->value ? 'hidden': '' }}">
                <label for="selectPriceCategory" class="capitalize block">{{ __('site.select_price_category') }}:</label>
                <select v-model="price_category"
                        class="p-2 focus:ring-0 rounded-md mt-1 w-full capitalize bookInputs"
                        name="price_category" id="price_category">
                    @foreach (['stander' , 'gold' , 'luxury', 'platinum'] as $type )
                        <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="">
                <label for="name" class="capitalize block">{{ __('site.name') }}</label>
                <input type="text" placeholder="{{ __('site.name') }}" class="focus:ring-0 rounded-md mt-1 w-full" name="name" id="name">
            </div>

            <div class="">
                <label for="email" class="capitalize block">{{ __('site.email') }}</label>
                <input type="email" placeholder="{{ __('site.email') }}" class="focus:ring-0 rounded-md mt-1 w-full" name="email"
                       id="email">
            </div>


            <div class="">
                <label for="nationality" class="capitalize block">{{ __('site.nationality') }}</label>
                <select class="p-2 focus:ring-0 rounded-md mt-1 w-full capitalize bookInputs"
                        name="nationality" id="nationality">
                    @foreach (\App\Models\Country::all() as $c )
                        <option value="{{ $c->name }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="">
                <label for="phone" class="capitalize block">{{ __('site.phone') }}</label>
                <input type="text" placeholder="{{ __('site.phone') }}" class="focus:ring-0 rounded-md mt-1 w-full" name="phone"
                       id="phone">
            </div>


        </div>
        <div class="my-4 w-full">
            <label for="notes" class="capitalize block">{{ __('site.notes') }}</label>
            <input type="text" placeholder="{{ __('site.notes') }}" class="focus:ring-0 rounded-md mt-1 w-full" name="notes" id="notes">
        </div>
        <div>
            <h6 class="capitalize font-semibold text-xl ">
                {{ __('site.people') }}
            </h6>
            <!-- adult -->
            <div class="between mb-3 ">
                <label for="adult" class="capitalize w-44">{{ __('site.adult') }}</label>
                <div class="flex items-center mt-1">
                    <i @click="dec('adults')"
                       class='bx bx-minus minus text-xl font-bold bg-blue-300 size-10 flex-shrink-0 border border-e-0 border-gray-400 rounded-s-md center cursor-pointer'></i>
                    <input readonly type="text" name="adults" id="adults" v-model="adults"
                           class="bookInputs py-[7px] text-center font-bold w-full">
                    <i @click="inc('adults')"
                       class='bx bx-plus plus text-xl font-bold bg-blue-300 size-10 flex-shrink-0 border border-e-0 border-gray-400 rounded-e-md center cursor-pointer'></i>
                </div>
            </div>
            <!-- children -->
            <div class="between mb-3 ">
                <label for="children" class="capitalize w-44">{{ __('site.children') }}</label>
                <div class="flex items-center mt-1">
                    <i @click="dec('children')"
                       class='bx bx-minus minus text-xl font-bold bg-blue-300 size-10 flex-shrink-0 border border-e-0 border-gray-400 rounded-s-md center cursor-pointer'></i>
                    <input v-model="children" readonly type="text" name="children" id="children" value="0"
                           class=" bookInputs py-[7px] text-center font-bold w-full">
                    <i @click="inc('children')"
                       class='bx bx-plus plus text-xl font-bold bg-blue-300 size-10 flex-shrink-0 border border-e-0 border-gray-400 rounded-e-md center cursor-pointer'></i>
                </div>
            </div>
        </div>

        <hr class="my-8">

        {{-- <div class="flex justify-between flex-wrap capitalize mb-4">
          <span>Service per booking</span>
          <div class="text-end">
            <p><span>adult: </span> <b>$20.00</b></p>
          </div>
        </div> --}}
        <div class="flex justify-between flex-wrap capitalize mb-4">
            <span>{{ __('site.service_per_person') }}</span>
            <div class="text-end">
                <p><span>{{ __('site.adult') }}: </span> <b> @{{ '$' + (calcPrice()['adult_price'])}}</b></p>
                <p><span>{{ __('site.children') }}: </span> <b> @{{ '$' + (calcPrice()['child_price'])}}</b></p>
            </div>
        </div>

        <hr class="my-8">

        <div class="flex justify-between flex-wrap capitalize mb-4 font-bold">
            <span>{{ __('site.total_before_taxes') }}:</span>
            <p class="text-second-color text-2xl" id="Totalprice">@{{ '$'+ (total_price.toFixed(2)) }}</p>
        </div>
        <input type="hidden" id="total_price" name="total_price">
        <button class="mainBtn">{{ __('site.booking_now') }}</button>

    </form>
</div>

@push('js')
    <script src="{{ asset('assets/admin/js/vue.min.js') }}"></script>

    <script>
        new Vue({
            el: '#t_booking',
            data() {
                return {
                    tour_type: '{{ $tour->tour_for }}',
                    accommodation_type: 'accommodation',
                    price_category: 'stander',
                    prices: {!! $tour->collectPrices() !!},
                    date: new Date,
                    adults: 1,
                    children: 0,
                    total_price: 0
                }
            },
            methods: {
                updateAccommodationType(event) {
                    this.accommodation_type = event.target.value;
                },
                inc(prop) {
                    this[prop] = this[prop] + 1 > 20 ? 20 : this[prop] + 1;
                },
                dec(prop) {
                    this[prop] = this[prop] - 1 < 0 ? 0 : this[prop] - 1;
                },
                calcGroupPrice(adults) {
                    for (let i = 0; i < this['prices']['group_pricing'].length; i++) {
                        let g = this['prices']['group_pricing'][i];
                        if (g['from'] <= adults && g['to'] >= adults) {
                            return {adult_price: g['adult_price'], child_price: g['child_price']}
                        }
                    }
                    return this['prices']['group_pricing'][0];
                },
                isBetween(date, start, end) {
                    if (typeof date === 'string') {
                        date = new Date(date);
                    }
                    return date >= start && date <= end;
                },
                isBetweenMayAndSeptember() {
                    const currentYear = new Date().getFullYear();

                    const startDate = new Date(`${currentYear}-05-01`);
                    const endDate = new Date(`${currentYear}-09-30`);
                    return this.isBetween(this.date, startDate, endDate);
                },
                isBetweenOctoberAndDecember() {
                    const currentYear = new Date().getFullYear();
                    const startDate = new Date(`${currentYear}-10-01`);
                    const endDate = new Date(`${currentYear}-12-22`);
                    return this.isBetween(this.date, startDate, endDate);
                },
                isInPeakPeriods() {
                    const currentYear = new Date().getFullYear();
                    const period1Start = new Date(currentYear + '-12-23');
                    const period1End = new Date((currentYear + 1) + '-01-07');

                    const period2Start = new Date(currentYear + '-04-14');
                    const period2End = new Date(currentYear + '-04-23');

                    return this.isBetween(this.date, period1Start, period1End) || this.isBetween(this.date, period2Start, period2End);
                },
                getSeason() {
                    let season = this['prices']['seasons'];

                    if (this.isBetweenMayAndSeptember()) {
                        return season[1] || null;
                    }

                    if (this.isBetweenOctoberAndDecember()) {
                        return season[2] || null;
                    }

                    if (this.isInPeakPeriods()) {
                        return season[3] || null;
                    }

                    return season[0] || null
                },
                calcPriceWithAccommodation(adults, type) {
                    let season = this.getSeason();

                    if (!season) {
                        return {adult_price: 0, child_price: 0}
                    }

                    let category_price = season[type][this['price_category']];

                    if (adults >= 2 && adults <= 4) {
                        return {adult_price: category_price['2-4'], child_price: category_price['2-4']}
                    }

                    if (adults >= 5 && adults <= 8) {
                        return {adult_price: category_price['5-8'], child_price: category_price['5-8']}
                    }

                    if (adults >= 9) {
                        return {adult_price: category_price['9-16'], child_price: category_price['9-16']}
                    }

                    return {adult_price: category_price['solo'], child_price: category_price['solo']}
                },
                calcPrice() {
                    let price = {};
                    if (this['tour_type'] === '{{ \App\Enums\TourPricingType::PRICING_GROUP->value }}') {
                        price = this.calcGroupPrice(this.adults);
                    } else {
                        price = this.calcPriceWithAccommodation(this.adults, this.accommodation_type);
                    }
                    this.total_price = (price.adult_price * this.adults) + (price.child_price * this.children);

                    return price;
                }
            }
        })
    </script>
@endpush
