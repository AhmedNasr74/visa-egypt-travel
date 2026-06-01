@extends('layouts.site.app')


@section('content')
    <!-- ================= Day Tour start ========================= -->

    <!-- breadcrumb area start -->
    <div class="breadcrumb-area jarallax" style="background-image:url({{ asset('assets/site/img/banner/1.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <h1 class="page-title">{{ __('main.tailor_tour') }}</h1>
                        <ul class="page-list">
                            <li><a href="{{ route('site.home') }}">{{ __('main.home') }}</a></li>
                            <li>{{ __('main.tailor_tour') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area End -->

    <!-- contact area End -->
    <div class="contact-area pd-top-108">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">

                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="section-title text-lg-center text-left">
                        <h2 class="title">{{ __('main.create-your-own-tour') }}</h2>
                    </div>
                    <form id="tailor-form" method="POST" class="tp-form-wrap"
                          action="{{ route('site.create_tour_tailors') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="single-input-wrap style-two">
                                            <span class="single-input-title">{{ __('main.name') }}</span>
                                            <select name="nickname" id="">
                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Mrs</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col-md-10">
                                        <label style="margin-top: 30px" class="single-input-wrap style-two">
                                            <input type="text" name="name" placeholder="{{ __('main.name') }}">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="single-input-wrap style-two">
                                            <span class="single-input-title">{{ __('main.phone') }}</span>
                                            <select name="country_phone_code" class="select2" id="">
                                                @foreach(\App\Models\Country::pluck('phone_code') as $phone_code)
                                                    <option value="{{ $phone_code }}">{{ $phone_code }}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col-md-10">
                                        <label style="margin-top: 30px" class="single-input-wrap style-two">
                                            <input type="text" name="phone" placeholder="{{ __('main.phone') }}">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class="single-input-wrap style-two">
                                    <span class="single-input-title">{{ __('main.email') }}</span>
                                    <input type="email" name="email" placeholder="{{ __('main.email') }}">
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="single-input-wrap style-two">
                                    <span class="single-input-title">{{ __('main.nationality') }}</span>
                                    <input type="text" name="nationality" placeholder="{{ __('main.nationality') }}">
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="single-input-wrap style-two">
                                    <span class="single-input-title">{{ __('main.adults') }}</span>
                                    <input type="number" min="1" name="adults" placeholder="{{ __('main.adults') }}">
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="single-input-wrap style-two">
                                    <span class="single-input-title">{{ __('main.children') }}</span>
                                    <input type="number" min="0" name="children" placeholder="{{ __('main.children') }}">
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="single-input-wrap style-two">
                                    <span class="single-input-title">{{ __('main.infants') }}</span>
                                    <input type="number" min="0" name="infants" placeholder="{{ __('main.infants') }}">
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="single-input-wrap style-two">
                                    <span class="single-input-title">{{ __('main.budget') }}</span>
                                    <input type="text" name="budget" placeholder="{{ __('main.budget') }}">
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="single-input-wrap style-two">
                                    <span class="single-input-title">{{ __('main.arrival-date') }}</span>
                                    <input type="date" name="arrival_date" placeholder="{{ __('main.arrival-date') }}" min="{{ date('Y-m-d') }}">
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="single-input-wrap style-two">
                                    <span class="single-input-title">{{ __('main.departure-date') }}</span>
                                    <input type="date" name="departure_date" placeholder="{{ __('main.departure-date') }}" min="{{ date('Y-m-d') }}">
                                </label>
                            </div>
                            <div class="col-lg-12">
                                <label class="single-input-wrap style-two">
                                    <span class="single-input-title">{{ __('main.destinations') }}</span>
                                    <select name="destinations[]" multiple
                                            data-placeholder="{{ __('main.destinations') }}" class="select2">
                                        @foreach($destinations as $destination)
                                            <option value="{{ $destination->title }}">{{ $destination->title }}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>

                            <div class="col-lg-12">
                                <label class="single-input-wrap style-two">
                                    <span class="single-input-title">{{ __('main.write-your-dreams') }}</span>
                                    <textarea placeholder="{{ __('main.write-your-dreams') }}" name="notes"></textarea>
                                </label>
                            </div>
                            <div class="single-input-wrap style-two">
                                <button id="tailor-btn" type="submit"
                                        class="btn btn-yellow w-100">{{ __('main.send') }}</button>
                            </div>

                        </div>
                    </form>
                </div>

                <hr>

                <div class="col-md-12 col-sm-12">
                    <div class="section-title text-lg-center text-left">
                        <h2 class="title">{{ __('main.make-an') }} {{ __('main.appointment') }}</h2>
                    </div>
                    <form class="tp-form-wrap" method="POST" action="{{ route('site.make-appointment') }}"
                          id="send-appointment">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="single-input-wrap style-two">
                                            <select name="nickname" id="">
                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Mrs</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col-md-10">
                                        <label  class="single-input-wrap style-two" style="margin-top: 0">
                                            <input type="text" name="name" placeholder="{{ __('main.name') }}">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="single-input-wrap col-md-6 col-sm-12 style-two">
                                <input type="email" name="email" placeholder="{{ __('main.email') }}"
                                       aria-label="{{ __('main.email') }}">
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="single-input-wrap style-two" style="margin-top: 0">
                                            <select name="country_phone_code" class="select2" id="">
                                                @foreach(\App\Models\Country::pluck('phone_code') as $phone_code)
                                                    <option value="{{ $phone_code }}">{{ $phone_code }}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col-md-10">
                                        <label class="single-input-wrap style-two">
                                            <input type="text" name="phone" placeholder="{{ __('main.phone') }}">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="single-input-wrap col-md-6 col-sm-12 style-two">
                                <input type="number" min="1" name="adults" placeholder="{{ __('main.adults') }}"
                                       aria-label="{{ __('main.adults') }}">
                            </div>
                            <div class="single-input-wrap col-md-6 col-sm-12 style-two">
                                <input type="number" min="0" name="children" placeholder="{{ __('main.children') }}"
                                       aria-label="{{ __('main.children') }}">
                            </div>

                            <div class="single-input-wrap col-md-6 col-sm-12 style-two">
                                <input type="text" name="meeting_language" placeholder="{{ __('main.preferred-language') }}"
                                       aria-label="{{ __('main.preferred-language') }}">
                            </div>
                            <div class="single-input-wrap col-md-6 col-sm-12 style-two">
                                <input type="text" class="departing-date custom-select"
                                       name="meeting_date" placeholder="{{ __('main.meeting-date') }}"
                                       aria-label="{{ __('main.meeting-date') }}">
                            </div>

                            <div class="single-input-wrap col-md-6 col-sm-12 style-two">
                                <input type="text" class="departing-date custom-select" name="arrival_date"
                                       placeholder="{{ __('main.arrival-date') }}"
                                       aria-label="{{ __('main.arrival-date') }}">
                            </div>
                            <div class="single-input-wrap col-md-6 col-sm-12 style-two">
                                <input type="text" class="timepicker" name="meeting_hour"
                                       placeholder="{{ __('main.arrival-hour') }}"
                                       aria-label="{{ __('main.arrival-hour') }}">
                            </div>
                            <div class="single-input-wrap col-md-6 col-sm-12 style-two">
                                <input type="text" class="departing-date custom-select"
                                       name="departure_date" placeholder="{{ __('main.departure-date') }}"
                                       aria-label="{{ __('main.departure-date') }}">

                            </div>

                            <div class="single-input-wrap col-md-6 col-sm-12 style-two">
                                <input type="text" name="days" placeholder="{{ __('main.days') }}"
                                       aria-label="{{ __('main.number_of_days') }}">
                            </div>
                            <div class="single-input-wrap col-md-6 col-sm-12 style-two">
                                <input type="number" name="expected_budget" placeholder="{{ __('main.expected_budget') }}"
                                       aria-label="{{ __('main.expected_budget') }}">
                            </div>
                            <div class="single-input-wrap col-md-12 col-sm-12 style-two">
                                <textarea aria-label="{{ __('main.notes') }}" name="notes" placeholder="{{ __('main.notes') }}"></textarea>
                            </div>
                        </div>

                        <div class="single-input-wrap style-two">
                            <button id="appointment-btn" type="submit"
                                    class="btn btn-yellow w-100">{{ __('main.book-your-appointment') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area End -->

    <!-- ========================= End Day Tour Section ============ -->
@endsection

@push('js')
    <script>
        $('.select2').select2();
        
        $("#tailor-form").on('submit', function (e) {
            e.preventDefault();
            
            // Disable submit button to prevent double submission
            const submitBtn = $(this).find('button[type="submit"]');
            const originalText = submitBtn.text();
            submitBtn.prop('disabled', true).text('Sending...');
            
            axios.post($(this).attr('action'), $(this).serialize())
                .then((res) => {
                    console.log('Success response:', res.data);
                    toastr.success(res.data.message);
                    $(this).trigger("reset");
                    // Reset select2 dropdowns
                    $(this).find('.select2').val(null).trigger('change');
                })
                .catch(error => {
                    console.log('Error response:', error);
                    console.log('Error response data:', error.response?.data);
                    console.log('Error status:', error.response?.status);
                    
                    let errorMessage = '{{ __('main.unexpected-error') }}';
                    
                    if (error.response?.data) {
                        if (error.response.data.error) {
                            errorMessage = error.response.data.error;
                        } else if (error.response.data.message) {
                            errorMessage = error.response.data.message;
                        } else if (error.response.data.errors) {
                            // Handle validation errors
                            const firstError = Object.values(error.response.data.errors)[0];
                            errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
                        }
                    } else if (error.message) {
                        errorMessage = error.message;
                    }
                    
                    toastr.error(errorMessage);
                })
                .finally(() => {
                    // Re-enable submit button
                    submitBtn.prop('disabled', false).text(originalText);
                });
        });

        $('#send-appointment').on('submit', function (e) {
            e.preventDefault();
            
            // Disable submit button to prevent double submission
            const submitBtn = $(this).find('button[type="submit"]');
            const originalText = submitBtn.text();
            submitBtn.prop('disabled', true).text('Sending...');
            
            axios.post($(this).attr('action'), $(this).serialize())
                .then(response => {
                    console.log('Success response:', response.data);
                    toastr.success(response.data.message);
                    $(this).trigger('reset');
                })
                .catch(error => {
                    console.log('Error response:', error);
                    console.log('Error response data:', error.response?.data);
                    
                    let errorMessage = '{{ __('main.unexpected-error') }}';
                    
                    if (error.response?.data) {
                        if (error.response.data.error) {
                            errorMessage = error.response.data.error;
                        } else if (error.response.data.message) {
                            errorMessage = error.response.data.message;
                        } else if (error.response.data.errors) {
                            // Handle validation errors
                            const firstError = Object.values(error.response.data.errors)[0];
                            errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
                        }
                    } else if (error.message) {
                        errorMessage = error.message;
                    }
                    
                    toastr.error(errorMessage);
                })
                .finally(() => {
                    // Re-enable submit button
                    submitBtn.prop('disabled', false).text(originalText);
                });
        });
    </script>
@endpush

