@extends('layouts.site.app')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        .destination-box .checked {
            border: 3px solid green;
            border-radius: 15px;
            padding: 3px;
        }
    </style>
@endpush
@section('content')
<section id="makeTrip">
    <form action="{{route('site.custom-trip-store')}}" method="post" id="custom-trip">
        @csrf

        <section id="step-1" style="" class="">
            <div class="container">
                <h2 class="text-center fs-1 fw-bold my-5 text-headerColor">{{ __('site.tour') }}</h2>

                <div class="row">
                    <div class="col-12 col-md-6 mb-2">
                        <div>
                            <label>{{ __('site.name') }}</label>
                            <input
                                type="text"
                                name="first_name"
                                id="name"
                                class="form-control valid w-100"
                                required
                                value="{{ old('name') }}"
                            />
                            <label for="name" class="d-none"
                            >{{ __('site.this_field_is_required') }}</label
                            >
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-2">
                        <div>
                            <label>{{ __('site.request_title') }}</label>
                            <input
                                type="text"
                                name="request"
                                class="form-control"
                                placeholder="{{ __('site.request_title') }}"
                                value="{{ old('request') }}"
                            />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div>
                            <label>{{ __('site.email') }}</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control valid w-100"
                                required
                                value="{{ old('email') }}"
                            />
                            <label for="email" class="d-none"
                            >{{ __('site.this_field_is_required') }}</label
                            >
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div>
                            <label>{{ __('site.arrival_date') }}</label>
                            <input
                                type="text"
                                class="date form-control"
                                name="date_from"
                                required
                                autocomplete="off"
                                readonly=""
                                value="{{ old('date_from') }}"
                            />
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-12 col-md-6 mb-2">
                        <div>
                            <label>{{ __('site.departure') }}</label>
                            <input
                                type="text"
                                class="date form-control"
                                name="date_to"
                                required
                                autocomplete="off"
                                readonly=""
                                value="{{ old('date_to') }}"
                            />
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6 mb-2">
                        <div>
                            <label for="Nationality">{{ __('site.nationality') }} *</label>
                            <select
                                name="nationality"
                                id="Nationality"
                                class="form-control text-capitalize"
                                required
                            >
                                <option selected="selected" value="">{{ __('site.select') }}</option>
                                @foreach($countries as $coun)
                                    <option value="{{$coun->name}}" {{ old('nationality') == $coun->name ? 'selected' : '' }}>
                                        {{$coun->name}}{{$coun->flag}}
                                    </option>
                                @endforeach
                            </select>
                            <label for="Nationality" class="d-none">{{ __('site.this_field_is_required') }}</label>
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-12 col-md-6">
                        <label for="codePhone">{{ __('site.mobile') }} *</label>
                        <div class="row">
                            <div class="col-5">
                                <select
                                    name="codePhone"
                                    id="codePhone"
                                    class="form-control"
                                    required
                                >
                                    <option value="">{{ __('site.code') }}</option>
                                    @foreach($countries as $coun)
                                        <option data-countrycode="{{$coun->code}}"
                                                value="{{$coun->phone_code}}"
                                                {{ old('codePhone') == $coun->phone_code ? 'selected' : '' }}>
                                            {{$coun->flag}} {{$coun->name}} ({{$coun->phone_code}})
                                        </option>
                                    @endforeach
                                </select>
                                <label for="codePhone" class="d-none">{{ __('site.this_field_is_required') }}</label>
                            </div>
                            <div class="col-7">
                                <input
                                    type="tel"
                                    class="form-control w-100"
                                    name="phone"
                                    placeholder={{ __('site.phone') }}
                                    id="userPhone"
                                    required
                                    value="{{ old('phone') }}"
                                />
                                <label for="userPhone" class="d-none">{{ __('site.this_field_is_required') }}</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>{{ __('site.ages_range_optional') }}</label>
                            <select name="age_range" class="form-control">
                                <option value="">{{ __('site.select') }}</option>
                                <option value="18 - 24" {{ old('age_range') == '18 - 24' ? 'selected' : '' }}>18 -> 24</option>
                                <option value="25 - 40" {{ old('age_range') == '25 - 40' ? 'selected' : '' }}>25 -> 40</option>
                                <option value="41 - 60" {{ old('age_range') == '41 - 60' ? 'selected' : '' }}>41 -> 60</option>
                                <option value="+60" {{ old('age_range') == '+60' ? 'selected' : '' }}>+60</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-md-4 mb-2">
                        <div class="inner">
                            <label for="">{{ __('site.adults') }}</label>
                            <div class="content fs-5 mt-2 border border-3 rounded-3 d-flex justify-content-around align-items-center p-2">
                                <i id="minusAdult" class="fs-3 cursor-pointer fa-regular fa-square-minus"></i>
                                <span id="countValueAdult" class="countValue mx-3">{{ old('adults', 1) }}</span>
                                <input
                                    type="number"
                                    hidden
                                    id="adultValue"
                                    name="adults"
                                    value="{{ old('adults', 1) }}"
                                />
                                <i id="plusAdult" class="fs-3 cursor-pointer fa-regular fa-square-plus"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-2">
                        <div class="inner">
                            <label for="">{{ __('site.children') }}</label>
                            <div class="content fs-5 mt-2 border border-3 rounded-3 d-flex justify-content-around align-items-center p-2">
                                <i id="minusChildren" class="fs-3 cursor-pointer fa-regular fa-square-minus"></i>
                                <span id="countValueChildren" class="countValue mx-3">{{ old('child', 0) }}</span>
                                <input
                                    type="number"
                                    hidden
                                    id="childrenValue"
                                    name="child"
                                    value="{{ old('child', 0) }}"
                                />
                                <i id="plusChildren" class="fs-3 cursor-pointer fa-regular fa-square-plus"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-2">
                        <div class="inner">
                            <label for="">{{ __('site.infants') }}</label>
                            <div class="content fs-5 mt-2 border border-3 rounded-3 d-flex justify-content-around align-items-center p-2">
                                <i id="minusInfants" class="fs-3 cursor-pointer fa-regular fa-square-minus"></i>
                                <span id="countValueInfants" class="countValue mx-3">{{ old('infant', 0) }}</span>
                                <input
                                    type="number"
                                    hidden
                                    id="infantsValue"
                                    name="infant"
                                    value="{{ old('infant', 0) }}"
                                />
                                <i id="plusInfants" class="fs-3 cursor-pointer fa-regular fa-square-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Child ages (up to 10 children) -->
                <div class="row my-3">
                    @for ($i = 1; $i <= 10; $i++)
                        <div class="col-12 col-md-3 mb-2 child-age-container" style="{{ old('child', 0) >= $i ? '' : 'display: none;' }}">
                            <label>{{ __('site.child') }} {{ $i }} {{ __('site.age') }}</label>
                            <input
                                type="number"
                                class="form-control"
                                name="children_ages[]"
                                value="{{ old('children_ages.'.$i-1, 0) }}"
                                min="0"
                                max="17"
                            />
                        </div>
                    @endfor
                </div>

    <div class="row my-3">
    <div class="col-12 col-md-6 mb-2">
        <label><strong>{{ __('site.where_you_wish_to_go') }}</strong></label>
        <div class="form-group">
            <select name="travel_to" class="form-control" required>
                <option value="">{{ __('site.select') }}</option>
                <option value="Cairo" {{ old('travel_to') == 'Cairo' ? 'selected' : '' }}>Cairo</option>
                <option value="Alexandria" {{ old('travel_to') == 'Alexandria' ? 'selected' : '' }}>Alexandria</option>
                <option value="Luxor" {{ old('travel_to') == 'Luxor' ? 'selected' : '' }}>Luxor</option>
                <option value="Aswan" {{ old('travel_to') == 'Aswan' ? 'selected' : '' }}>Aswan</option>
                <option value="Hurghada" {{ old('travel_to') == 'Hurghada' ? 'selected' : '' }}>Hurghada</option>
                <option value="Marsa Alam" {{ old('travel_to') == 'Marsa Alam' ? 'selected' : '' }}>Marsa Alam</option>
                <option value="Sharm El Shiekh" {{ old('travel_to') == 'Sharm El Shiekh' ? 'selected' : '' }}>Sharm El Shiekh</option>
            </select>
        </div>
    </div>

    <div class="col-12 col-md-6 mb-2">
        <label>{{ __('site.accommodation') }}</label>
        <select class="form-control" name="accommodation_choices" required>
            <option value="">{{ __('site.select') }}</option>
            <option value="High Luxury" {{ old('accommodation_choices') == 'High Luxury' ? 'selected' : '' }}>{{ __('site.high_luxury_5_stars') }}</option>
            <option value="Standard 5*" {{ old('accommodation_choices') == 'Standard 5*' ? 'selected' : '' }}>{{ __('site.standard_5') }}</option>
            <option value="Economy 4*" {{ old('accommodation_choices') == 'Economy 4*' ? 'selected' : '' }}>{{ __('site.economy_4') }}</option>
            <option value="Booked on your own" {{ old('accommodation_choices') == 'Booked on your own' ? 'selected' : '' }}>{{ __('site.booked_on_your_own') }}</option>
        </select>
    </div>
</div>

                <div class="row my-3">
                    <div class="col-12 mb-2">
                        <label>{{ __('site.extra_note') }}</label>
                        <textarea name="note" class="form-control" required rows="3">{{ old('note') }}</textarea>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-12 mb-2">
                        <label>{{ __('site.about') }}</label>
                        <div class="d-flex flex-wrap">
                            <div class="custom-checkbox mx-2">
                                <input class="form-check-input" type="radio" name="how_did_you_hear_about_us" id="how_did_you_hear_about_us1" value="{{ __('site.search') }}" {{ old('how_did_you_hear_about_us', __('site.search')) == __('site.search') ? 'checked' : '' }}>
                                <label class="form-check-label my-0" for="how_did_you_hear_about_us1">{{ __('site.search') }}</label>
                            </div>
                            <div class="custom-checkbox mx-2">
                                <input class="form-check-input" type="radio" name="how_did_you_hear_about_us" id="how_did_you_hear_about_us2" value="{{ __('site.social_media') }}" {{ old('how_did_you_hear_about_us') == __('site.social_media') ? 'checked' : '' }}>
                                <label class="form-check-label my-0" for="how_did_you_hear_about_us2">{{ __('site.social_media') }}</label>
                            </div>
                            <div class="custom-checkbox mx-2">
                                <input class="form-check-input" type="radio" name="how_did_you_hear_about_us" id="how_did_you_hear_about_us3" value="{{ __('site.trip_advisor') }}" {{ old('how_did_you_hear_about_us') == __('site.trip_advisor') ? 'checked' : '' }}>
                                <label class="form-check-label my-0" for="how_did_you_hear_about_us3">{{ __('site.trip_advisor') }}</label>
                            </div>
                            <div class="custom-checkbox mx-2">
                                <input class="form-check-input" type="radio" name="how_did_you_hear_about_us" id="how_did_you_hear_about_us4" value="{{ __('site.a_friend') }}" {{ old('how_did_you_hear_about_us') == __('site.a_friend') ? 'checked' : '' }}>
                                <label class="form-check-label my-0" for="how_did_you_hear_about_us4">{{ __('site.a_friend') }}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between my-5">
                    <button id="inquire" type="submit" class="btn mainBtn py-2 fs-4">
                        {{ __('site.inquire_now') }}
                    </button>
                </div>
            </div>
        </section>
    </form>
</section>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("input[name='date_from']", {
            dateFormat: "Y-m-d",
            minDate: "today"
        });

        flatpickr("input[name='date_to']", {
            dateFormat: "Y-m-d",
            minDate: "today"
        });
    });
</script>

    <script>
        $('#input-exact-date').click(function () {
            $('#exact-dates').show()
            $('#approximate').hide()
        })
        $('#input-approximate-date').click(function () {
            $('#approximate').show()
            $('#exact-dates').hide()
        })
        $('.destination-box .box').click(function () {
            $('.destination-box .box').removeClass('checked')
            $(this).addClass('checked')
        })
        $('#step-1-next').click(function () {
            // $('#makeTrip #step-2').slideDown()
            $('#makeTrip #step-1').slideUp()
            $('#makeTrip #step-2').fadeIn()
        })
        $('#step-2-next').click(function () {
            $('#makeTrip #step-2').slideUp()
            $('#makeTrip #step-3').fadeIn()
        })

        $('#step-2-back').click(function () {
            $('#makeTrip #step-2').slideUp()
            $('#makeTrip #step-1').fadeIn()
        })
        $('#step-3-back').click(function () {
            $('#makeTrip #step-3').slideUp()
            $('#makeTrip #step-2').fadeIn()
        });
        //adults
        $('#minusAdult').click(function () {
            let val = parseInt($("#adultValue").val())
            $("#countValueAdult").text(Math.max(1, val-1))
            $("#adultValue").val(Math.max(1, val-1))
        })

        $('#plusAdult').click(function () {
            let val = parseInt($("#adultValue").val())
            $("#countValueAdult").text(val+1)
            $("#adultValue").val(val+1)
        })
        //children
        $('#minusChildren').click(function () {
            let val = parseInt($("#childrenValue").val())
            $("#countValueChildren").text(Math.max(0, val-1))
            $("#childrenValue").val(Math.max(0, val-1))
        })

        $('#plusChildren').click(function () {
            let val = parseInt($("#childrenValue").val())
            $("#countValueChildren").text(val+1)
            $("#childrenValue").val(val+1)
        })
        //infants
        $('#minusInfants').click(function () {
            let val = parseInt($("#infantsValue").val())
            $("#countValueInfants").text(Math.max(0, val-1))
            $("#infantsValue").val(Math.max(0, val-1))
        })

        $('#plusInfants').click(function () {
            let val = parseInt($("#infantsValue").val())
            $("#countValueInfants").text(val+1)
            $("#infantsValue").val(val+1)
        })
    </script>
    
    <script>
        (function () {
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            if (csrfMeta) {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfMeta.getAttribute('content');
            }
            axios.defaults.headers.common['Accept'] = 'application/json';

            const form = document.getElementById('custom-trip');
            if (!form) {
                return;
            }

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                if (!form.checkValidity()) {
                    form.reportValidity();
                    const firstInvalid = form.querySelector(':invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstInvalid.focus();
                    }
                    toastr.warning('Please complete all required fields below.');
                    return;
                }

                const formData = new FormData(form);
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn ? submitBtn.textContent : '';
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Sending...';
                }

                axios.post(form.getAttribute('action'), formData)
                    .then((res) => {
                        toastr.success(res.data.message || 'Request sent successfully.');
                        form.reset();
                        document.getElementById('adultValue').value = 1;
                        document.getElementById('childrenValue').value = 0;
                        document.getElementById('infantsValue').value = 0;
                        document.getElementById('countValueAdult').textContent = '1';
                        document.getElementById('countValueChildren').textContent = '0';
                        document.getElementById('countValueInfants').textContent = '0';
                        document.querySelectorAll('.child-age-container').forEach(el => el.style.display = 'none');
                        const hearDefault = document.getElementById('how_did_you_hear_about_us1');
                        if (hearDefault) {
                            hearDefault.checked = true;
                        }
                    })
                    .catch(error => {
                        let errorMessage = '{{ __('site.unexpected_error') }}';
                        const data = error.response?.data;
                        if (data?.error) {
                            errorMessage = data.error;
                        } else if (data?.message) {
                            errorMessage = data.message;
                        } else if (data?.errors) {
                            const firstError = Object.values(data.errors)[0];
                            errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
                        }
                        toastr.error(errorMessage);
                    })
                    .finally(() => {
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalText;
                        }
                    });
            });
        })();
    </script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const childrenInput = document.getElementById('childrenValue');
    const childAgeContainers = document.querySelectorAll('.child-age-container');

    window.updateChildAgeFields = function () {
        const numChildren = parseInt(childrenInput.value, 10) || 0;
        childAgeContainers.forEach((container, index) => {
            container.style.display = index < numChildren ? 'block' : 'none';
        });
    };

    childrenInput.addEventListener('change', window.updateChildAgeFields);
    window.updateChildAgeFields();
});

document.getElementById('plusAdult').addEventListener('click', function() {
    const input = document.getElementById('adultValue');
    const span = document.getElementById('countValueAdult');
    input.value = parseInt(input.value) + 1;
    span.textContent = input.value;
});

document.getElementById('minusAdult').addEventListener('click', function() {
    const input = document.getElementById('adultValue');
    const span = document.getElementById('countValueAdult');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
        span.textContent = input.value;
    }
});

document.getElementById('plusChildren').addEventListener('click', function() {
    const input = document.getElementById('childrenValue');
    const span = document.getElementById('countValueChildren');
    input.value = parseInt(input.value) + 1;
    span.textContent = input.value;
    window.updateChildAgeFields();
});

document.getElementById('minusChildren').addEventListener('click', function() {
    const input = document.getElementById('childrenValue');
    const span = document.getElementById('countValueChildren');
    if (parseInt(input.value) > 0) {
        input.value = parseInt(input.value) - 1;
        span.textContent = input.value;
        window.updateChildAgeFields();
    }
});

document.getElementById('plusInfants').addEventListener('click', function() {
    const input = document.getElementById('infantsValue');
    const span = document.getElementById('countValueInfants');
    input.value = parseInt(input.value) + 1;
    span.textContent = input.value;
});

document.getElementById('minusInfants').addEventListener('click', function() {
    const input = document.getElementById('infantsValue');
    const span = document.getElementById('countValueInfants');
    if (parseInt(input.value) > 0) {
        input.value = parseInt(input.value) - 1;
        span.textContent = input.value;
    }
});
</script>

@endpush
