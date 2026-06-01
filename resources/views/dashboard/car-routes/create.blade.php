@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.car-routes.store' ) }}" method="POST" id="car-route-form" class="page-body">
        @csrf

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Create Car Route" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.car-routes.index') }}">Car Routes</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert/>
                <div class="card tab2-card">
                    <div class="card-body  needs-validation">

                        <x-dashboard.form.multi-tab-card
                            :tabs="['Route', 'Prices', 'Stops']"
                            tab-id="route-prices-stops">

                                <div class="tab-pane fade active show" id="{{ 'route-prices-stops-0' }}" role="tabpanel"
                                     aria-labelledby="{{ 'route-prices-stops-0' }}-tab">
                                    {{-- Rotue --}}
                                    <x-dashboard.form.input-select
                                        name="pickup_location_id"
                                        :options="$locations"
                                        track-by="id"
                                        option-lable="name"
                                        label-title="PickUp Location"
                                        id="pickup_location_id"
                                        error-key="pickup_location_id"/>
                                    <x-dashboard.form.input-select
                                        name="destination_id"
                                        :options="$locations"
                                        track-by="id"
                                        option-lable="name"
                                        label-title="Destination Location (optional)"
                                        id="destination_id"
                                        error-key="destination_id"
                                        :allow-empty="true"
                                        empty-label="— None —"
                                    />

                                    <div class="form-group row mt-3">
                                        <label class="col-xl-3 col-md-4">Route service types</label>
                                        <div class="col-xl-8 col-xl-9">
                                            <p class="text-muted small mb-2">Choose which limo services this route applies to (one or more).</p>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="airport_limo" id="airport_limo" value="1"
                                                       @checked(old('airport_limo', true))>
                                                <label class="form-check-label" for="airport_limo">Airport Limo</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="travel_limo" id="travel_limo" value="1"
                                                       @checked(old('travel_limo', false))>
                                                <label class="form-check-label" for="travel_limo">Travel Limo</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="city_ride_limo" id="city_ride_limo" value="1"
                                                       @checked(old('city_ride_limo', false))>
                                                <label class="form-check-label" for="city_ride_limo">City Ride Limo</label>
                                            </div>
                                            @error('service_types')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div> {{-- End Tab --}}

                                <div class="tab-pane fade" id="{{ 'route-prices-stops-1' }}" role="tabpanel"
                                     aria-labelledby="{{ 'route-prices-stops-1' }}-tab">
                                    {{-- Prices --}}

                                    <div v-if="cityRideLimo" class="alert alert-info small mb-4">
                                        <strong>City Ride Limo:</strong> set one price per duration (3h / 6h / 8h / 12h). These match the public site “Choose Service” options. Passenger band is fixed 1–50 for each package.
                                    </div>

                                    <a href="javascript:;" @click.prevent="addPrice"
                                       class="text-center mb-4 btn btn-danger w-100 text-white">
                                        <i class="fa fa-plus"></i> Add New Car (Airport / Travel bands)
                                    </a>

                                    {{-- City-only route --}}
                                    <div v-if="cityRideLimo && bandIndices.length === 0" class="card mb-4 border">
                                        <div class="card-body">
                                            <p class="small text-muted mb-3">City Ride Limo only: vehicle label and one price per duration (passenger band 1–50).</p>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-md-4" for="city-standalone-car-type">Car Type</label>
                                                <div class="col-xl-8 col-xl-9">
                                                    <input id="city-standalone-car-type" class="form-control" v-model="cityStandaloneCarType" required placeholder="Mini Van">
                                                </div>
                                            </div>
                                            <template v-for="tier in cityRideTiers" :key="'city-only-' + tier.hours">
                                                <div class="form-group row" v-if="tierRowForGroup(0, tier.hours)">
                                                    <label class="col-xl-3 col-md-4">@{{ tier.label }}</label>
                                                    <div class="col-xl-8 col-xl-9">
                                                        <p class="small text-muted mb-1">Price (EGP) for this city package. “Rounded” price is set to the same value automatically.</p>
                                                        <input type="hidden" :name="'prices['+tierIndexForGroup(0, tier.hours)+'][price_group_index]'" value="0">
                                                        <input type="hidden" :name="'prices['+tierIndexForGroup(0, tier.hours)+'][limo_city_hours]'" :value="tier.hours">
                                                        <input type="hidden" :name="'prices['+tierIndexForGroup(0, tier.hours)+'][car_type]'" :value="cityStandaloneCarType">
                                                        <input type="hidden" :name="'prices['+tierIndexForGroup(0, tier.hours)+'][from]'" :value="tierRowForGroup(0, tier.hours).from">
                                                        <input type="hidden" :name="'prices['+tierIndexForGroup(0, tier.hours)+'][to]'" :value="tierRowForGroup(0, tier.hours).to">
                                                        <input class="form-control" :id="'price-city-0-'+tier.hours" required
                                                               type="text" :name="'prices['+tierIndexForGroup(0, tier.hours)+'][oneway_price]'"
                                                               v-model="tierRowForGroup(0, tier.hours).oneway_price"
                                                               placeholder="e.g. 515">
                                                        <input type="hidden" :name="'prices['+tierIndexForGroup(0, tier.hours)+'][rounded_price]'" :value="tierRowForGroup(0, tier.hours).oneway_price || ''">
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                    <div v-for="bandIdx in bandIndices" :key="'band-block-' + bandIdx" class="card mb-4 border">
                                        <div class="card-body">
                                            <input type="hidden" :name="'prices['+bandIdx+'][price_group_index]'" :value="prices[bandIdx].price_group_index">
                                            <input type="hidden" :name="'prices['+bandIdx+'][limo_city_hours]'" :value="prices[bandIdx].limo_city_hours || ''">

                                            <div class="form-group row">
                                                <label :for="'price-group-car-type-'+bandIdx" class="col-xl-3 col-md-4">Car Type
                                                    <i v-if="bandIdx !== bandIndices[0]" class="fa fa-trash text-danger"
                                                       @click="removePrice(bandIdx)" style="cursor: pointer"></i>
                                                </label>
                                                <div class="col-xl-8 col-xl-9">
                                                    <input class="form-control" :id="'price-group-car-type-'+bandIdx" required
                                                           type="text" :name="'prices['+bandIdx+'][car_type]'"
                                                           v-model="prices[bandIdx].car_type"
                                                           placeholder="Mini Van">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label :for="'price-group-from-'+bandIdx" class="col-xl-3 col-md-4">From</label>
                                                <div class="col-xl-8 col-xl-9">
                                                    <input class="form-control" :id="'price-group-from-'+bandIdx" required
                                                           type="text" :name="'prices['+bandIdx+'][from]'"
                                                           v-model="prices[bandIdx].from" placeholder="1">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label :for="'price-group-to-'+bandIdx" class="col-xl-3 col-md-4">To</label>
                                                <div class="col-xl-8 col-xl-9">
                                                    <input class="form-control" :id="'price-group-to-'+bandIdx" required
                                                           type="text" :name="'prices['+bandIdx+'][to]'" v-model="prices[bandIdx].to"
                                                           placeholder="2">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label :for="'price-group-one-way-price-'+bandIdx" class="col-xl-3 col-md-4">Price
                                                    (Oneway)</label>
                                                <div class="col-xl-8 col-xl-9">
                                                    <input class="form-control" :id="'price-group-one-way-price-'+bandIdx"
                                                           required
                                                           type="text" :name="'prices['+bandIdx+'][oneway_price]'"
                                                           v-model="prices[bandIdx].oneway_price"
                                                           placeholder="20">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label :for="'price-group-rounded-way-price-'+bandIdx" class="col-xl-3 col-md-4">Price
                                                    (Rounded)</label>
                                                <div class="col-xl-8 col-xl-9">
                                                    <input class="form-control" :id="'price-group-rounded-way-price-'+bandIdx"
                                                           required v-model="prices[bandIdx].rounded_price"
                                                           type="text" :name="'prices['+bandIdx+'][rounded_price]'"
                                                           placeholder="50">
                                                </div>
                                            </div>

                                            <template v-if="cityRideLimo">
                                                <hr class="my-4">
                                                <h6 class="text-muted text-uppercase small font-weight-bold mb-3">City Ride Limo</h6>
                                                <template v-for="tier in cityRideTiers" :key="'city-nested-' + prices[bandIdx].price_group_index + '-' + tier.hours">
                                                    <div class="form-group row" v-if="tierRowForGroup(prices[bandIdx].price_group_index, tier.hours)">
                                                        <label class="col-xl-3 col-md-4">@{{ tier.label }}</label>
                                                        <div class="col-xl-8 col-xl-9">
                                                            <p class="small text-muted mb-1">Price (EGP) for this city package. “Rounded” price is set to the same value automatically.</p>
                                                            <input type="hidden" :name="'prices['+tierIndexForGroup(prices[bandIdx].price_group_index, tier.hours)+'][price_group_index]'" :value="prices[bandIdx].price_group_index">
                                                            <input type="hidden" :name="'prices['+tierIndexForGroup(prices[bandIdx].price_group_index, tier.hours)+'][limo_city_hours]'" :value="tier.hours">
                                                            <input type="hidden" :name="'prices['+tierIndexForGroup(prices[bandIdx].price_group_index, tier.hours)+'][car_type]'" :value="bandCarTypeForGroup(prices[bandIdx].price_group_index)">
                                                            <input type="hidden" :name="'prices['+tierIndexForGroup(prices[bandIdx].price_group_index, tier.hours)+'][from]'" :value="tierRowForGroup(prices[bandIdx].price_group_index, tier.hours).from">
                                                            <input type="hidden" :name="'prices['+tierIndexForGroup(prices[bandIdx].price_group_index, tier.hours)+'][to]'" :value="tierRowForGroup(prices[bandIdx].price_group_index, tier.hours).to">
                                                            <input class="form-control" :id="'price-city-'+prices[bandIdx].price_group_index+'-'+tier.hours" required
                                                                   type="text" :name="'prices['+tierIndexForGroup(prices[bandIdx].price_group_index, tier.hours)+'][oneway_price]'"
                                                                   v-model="tierRowForGroup(prices[bandIdx].price_group_index, tier.hours).oneway_price"
                                                                   placeholder="e.g. 515">
                                                            <input type="hidden" :name="'prices['+tierIndexForGroup(prices[bandIdx].price_group_index, tier.hours)+'][rounded_price]'" :value="tierRowForGroup(prices[bandIdx].price_group_index, tier.hours).oneway_price || ''">
                                                        </div>
                                                    </div>
                                                </template>
                                            </template>
                                        </div>
                                    </div>

                                </div> {{-- End Tab --}}

                                <div class="tab-pane fade" id="{{ 'route-prices-stops-2' }}" role="tabpanel"
                                     aria-labelledby="{{ 'route-prices-stops-2' }}-tab">
                                    {{-- Stops --}}

                                    <a href="javascript:;" @click="addStop()"
                                       class="text-center mb-4 btn btn-outline-primary w-100">
                                        <i class="fa fa-plus"></i> Add New Stop
                                    </a>

                                    <div v-for="(stop,idx) in stops" :key="'stops-' + idx" class="row">

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-md-4" :for="'stop-location-'+idx">Location
                                                <i v-if="idx != 0" class="fa fa-trash text-danger"
                                                   @click="removeStop(idx)" style="cursor: pointer"></i>
                                            </label>
                                            <div class="col-md-8 col-xl-9">

                                                <select class="custom-select select2 form-control" aria-label="Location"
                                                        :id="'stop-location-'+idx"
                                                        :name="'stops['+idx+'][stop_location_id]'">
                                                    <option value="" selected disabled>--Select Location--</option>

                                                    <option v-for="(location) in locations"
                                                            :selected="location.id == stop.stop_location_id"
                                                            :value="location.id">
                                                        @{{ location.name }}
                                                    </option>

                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label :for="'stop-price-'+idx" class="col-xl-3 col-md-4">Price</label>
                                            <div class="col-xl-8 col-xl-9">
                                                <input class="form-control" :id="'stop-price-'+idx" required
                                                       type="text" :name="'stops['+idx+'][price]'"
                                                       :value="stop.price" placeholder="100">
                                            </div>
                                        </div>
                                    </div> {{-- End Vue Loop--}}

                                </div> {{-- End Tab --}}
                        </x-dashboard.form.multi-tab-card>
                        <x-dashboard.form.submit-button/>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

    </form>
@endsection

@push('js')
    <script src="{{ asset('assets/admin/js/vue.min.js') }}"></script>
    <script>
        new Vue({
            el: "#car-route-form",
            data() {
                return {
                    expectedCarCount: 3,
                    cityRideTiers: @json(config('car_transport.city_ride_tiers')),
                    locations: @json($locations->toArray()),
                    prices: @json(old('prices', [])),
                    stops: @json(old('stops', [])),
                    cityRideLimo: false,
                    cityStandaloneCarType: '',
                }
            },
            computed: {
                bandIndices() {
                    return this.prices
                        .map((p, i) => ({ p, i }))
                        .filter(x => !this.isCityTier(x.p))
                        .map(x => x.i);
                },
            },
            mounted() {
                this.normalizePriceRows();
                this.initCityStandaloneLabel();
                const cityCb = document.getElementById('city_ride_limo');
                const syncCityRows = () => {
                    this.cityRideLimo = !!(cityCb && cityCb.checked);
                    if (cityCb && cityCb.checked) {
                        this.ensureCityPriceRows();
                    } else {
                        this.removeCityPriceRows();
                    }
                };
                if (this.prices.length === 0) {
                    if (cityCb && cityCb.checked) {
                        this.ensureCityPriceRows();
                    } else {
                        for (let i = 1; i <= this.expectedCarCount; i++) {
                            this.addPrice();
                        }
                    }
                } else {
                    syncCityRows();
                }
                this.cityRideLimo = !!(cityCb && cityCb.checked);
                if (cityCb) {
                    cityCb.addEventListener('change', syncCityRows);
                }
            },
            methods: {
                normalizePriceRows() {
                    this.prices.forEach(p => {
                        if (p.price_group_index === undefined || p.price_group_index === null) {
                            p.price_group_index = 0;
                        }
                        if (p.limo_city_hours === undefined) {
                            p.limo_city_hours = null;
                        }
                    });
                },
                initCityStandaloneLabel() {
                    if (this.bandIndices.length !== 0) return;
                    const t = this.prices.find(p => this.isCityTier(p));
                    if (!t || !t.car_type) return;
                    if (this.cityRideTiers.some(ct => ct.car_type === t.car_type)) return;
                    this.cityStandaloneCarType = t.car_type;
                },
                bandCarTypeForGroup(g) {
                    const band = this.prices.find(p => !this.isCityTier(p) && Number(p.price_group_index) === Number(g));
                    return band && band.car_type ? band.car_type : '';
                },
                tierRowForGroup(g, hours) {
                    return this.prices.find(p =>
                        this.isCityTier(p) &&
                        Number(p.price_group_index) === Number(g) &&
                        String(p.limo_city_hours) === String(hours)
                    ) || null;
                },
                tierIndexForGroup(g, hours) {
                    return this.prices.findIndex(p =>
                        this.isCityTier(p) &&
                        Number(p.price_group_index) === Number(g) &&
                        String(p.limo_city_hours) === String(hours)
                    );
                },
                isCityTier(row) {
                    if (!row) return false;
                    if (row.limo_city_hours != null && row.limo_city_hours !== '') {
                        return ['3', '6', '8', '12'].includes(String(row.limo_city_hours));
                    }
                    return this.cityRideTiers.some(t => t.car_type === row.car_type);
                },
                ensureCityPriceRows() {
                    const bandGroups = this.prices.filter(p => !this.isCityTier(p)).map(p => Number(p.price_group_index));
                    const targetGroups = bandGroups.length ? [...new Set(bandGroups)] : [0];
                    targetGroups.forEach(g => {
                        this.cityRideTiers.forEach(tier => {
                            if (!this.tierRowForGroup(g, tier.hours)) {
                                this.prices.push({
                                    price_group_index: g,
                                    limo_city_hours: tier.hours,
                                    car_type: this.bandCarTypeForGroup(g) || null,
                                    from: 1,
                                    to: 50,
                                    oneway_price: null,
                                    rounded_price: null,
                                });
                            }
                        });
                    });
                    this.prices.forEach(p => {
                        if (this.isCityTier(p)) {
                            p.from = 1;
                            p.to = 50;
                            const g = Number(p.price_group_index);
                            const bc = this.bandCarTypeForGroup(g);
                            if (bc) {
                                p.car_type = bc;
                            }
                        }
                    });
                },
                removeCityPriceRows() {
                    this.prices = this.prices.filter(p => !this.isCityTier(p));
                    this.cityStandaloneCarType = '';
                },
                removePrice(idx) {
                    if (this.isCityTier(this.prices[idx])) return;
                    const g = Number(this.prices[idx].price_group_index);
                    this.prices = this.prices.filter(p => Number(p.price_group_index) !== g);
                },
                removeStop(idx) {
                    this.stops.splice(idx, 1);
                },
                addPrice() {
                    const bands = this.prices.filter(p => !this.isCityTier(p));
                    const nextG = bands.length === 0 ? 0 : Math.max(...bands.map(p => Number(p.price_group_index))) + 1;
                    this.prices.push({
                        price_group_index: nextG,
                        limo_city_hours: null,
                        oneway_price: null,
                        rounded_price: null,
                        car_type: null,
                        from: null,
                        to: null,
                    });
                    if (this.cityRideLimo) {
                        this.cityRideTiers.forEach(tier => {
                            this.prices.push({
                                price_group_index: nextG,
                                limo_city_hours: tier.hours,
                                car_type: null,
                                from: 1,
                                to: 50,
                                oneway_price: null,
                                rounded_price: null,
                            });
                        });
                    }
                    const index = this.prices.findIndex((p, i) => !this.isCityTier(p) && Number(p.price_group_index) === nextG);
                    const selector = 'label[for="price-group-car-type-' + index + '"]';
                    setTimeout(() => $(document).scrollTop($(selector).offset().top), 100);
                },
                addStop() {
                    this.stops.push( {
                        stop_location_id: null,
                        price: null
                    })
                    let index = this.stops.length-1
                    let selector = 'label[for="stop-location-'+index+'"]'
                    setTimeout(() => {
                        $('.select2').select2()
                        $(document).scrollTop($(selector).offset().top )
                    }, 100)
                }
            }
        })
    </script>
@endpush
