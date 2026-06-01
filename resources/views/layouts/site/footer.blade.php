@php
    $address = setting(App\Enums\SettingKey::ADDRESS->value ?? [])[0] ?? "";
    $PRIMARY_PHONE = setting(App\Enums\SettingKey::PRIMARY_PHONE->value)[0] ?? "";
    $CONTACT_EMAIL = setting(App\Enums\SettingKey::CONTACT_EMAIL->value ?? [])[0] ?? "";
@endphp

<!-- footer -->

<footer class="bg-main-color py-4 ">
    <div class="container">
        <div class="grid gap-4 lg:grid-cols-[minmax(0,1fr)_35%] my-4">
            <ul data-aos="fade-right" class="list-none capitalize flex flex-wrap text-lg font-semibold">
                <li class="itemLink mb-2 me-3">
                    <a href="{{ route('site.privacy') }}" class="text-white">{{ __('site.privacy_policy') }}</a>
                </li>
                <li class="itemLink mb-2 me-3">
                    <a href="{{ route('site.terms') }}" class="text-white">{{ __('site.terms_and_conditions') }}</a>
                </li>
                <li class="itemLink mb-2 me-3">
                    <a href="{{ route('site.custom-trip') }}" class="text-white">{{ __('site.how_it_works') }}</a>
                </li>
                <li class="itemLink mb-2 me-3">
                    <a href="{{ route('site.contact') }}" class="text-white">{{ __('site.contact_us') }}</a>
                </li>
                <li class="itemLink mb-2 me-3"><a href="#" class="text-white">{{ __('site.gallery') }}</a></li>
            </ul>

            <ul data-aos="fade-left"
                class="list-none flex flex-wrap text-lg font-semibold lg:justify-end justify-center">
                @if($social_links->firstWhere('type', 'facebook'))
                    <li class="hover:bg-second-color size-8 center rounded-full transition-time hover:scale-110 me-2">
                        <a target="_blank" href="{{ $social_links->firstWhere('type', 'facebook')['url'] }}"
                           class="text-white text-2xl"><i class="bx bxl-facebook-circle"></i></a>
                    </li>
                @endif

                @if($social_links->firstWhere('type', 'instagram'))
                    <li class="hover:bg-second-color size-8 center rounded-full transition-time hover:scale-110 me-2">
                        <a target="_blank" href="{{ $social_links->firstWhere('type', 'instagram')['url'] }}"
                           class="text-white text-2xl"><i class="bx bxl-instagram"></i></a>
                    </li>
                @endif

                @if($social_links->firstWhere('type', 'twitter'))
                    <li class="hover:bg-second-color size-8 center rounded-full transition-time hover:scale-110 me-2">
                        <a target="_blank" href="{{ $social_links->firstWhere('type', 'twitter')['url'] }}" class="text-white text-2xl"><i
                                class="bx bxl-twitter"></i></a>
                    </li>
                @endif

                @if($social_links->firstWhere('type', 'youtube'))
                    <li class="hover:bg-second-color size-8 center rounded-full transition-time hover:scale-110 me-2">
                        <a target="_blank" href="{{ $social_links->firstWhere('type', 'youtube')['url'] }}" class="text-white text-2xl"><i
                                class="bx bxl-youtube"></i
                            ></a>
                    </li>
                @endif

                @if($social_links->firstWhere('type', 'linked-in'))
                    <li class="hover:bg-second-color size-8 center rounded-full transition-time hover:scale-110 me-2">
                        <a target="_blank" href="{{ $social_links->firstWhere('type', 'linked-in')['url'] }}"
                           class="text-white text-2xl"><i class="bx bxl-linkedin"></i></a>
                    </li>
                @endif

                @if($social_links->firstWhere('type', 'pinterest'))
                    <li class="hover:bg-second-color size-8 center rounded-full transition-time hover:scale-110 me-2">
                        <a target="_blank" href="{{ $social_links->firstWhere('type', 'pinterest')['url'] }}"
                           class="text-white text-2xl"><i class="bx bxl-pinterest-alt"></i></a>
                    </li>
                @endif
            </ul>
        </div>

        <hr/>

        <div class="grid gap-5 xl:grid-cols-4 lg:grid-cols-2 md:grid-cols-1 my-9">
            <div data-aos="fade-up" class="text-white">
                <figure class="size-24">
                    <img
                        src="{{ logo() }}"
                        class="w-full h-full"
                        alt="egypt tour logo"
                    />
                </figure>
                <p>
                    {{ setting(\App\Enums\SettingKey::FOOTER_TEXT->value, true) }}
                </p>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <i class="fa-solid fa-earth-americas me-1 textMainColor"></i>
                            {{LaravelLocalization::getCurrentLocaleNative()}}
                        </a>
                        <!-- غير الدروب  -->
                        <ul class="dropdown-menu bgMainColor">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                                <li>
                                    <a class="dropdown-item"
                                       href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>

                            @endforeach
                        </ul>


                    </li>
                </ul>
            </div>
            <div data-aos="fade-right" class="text-white capitalize">
                <h6 class="text-lg font-semibold mb-7">{{ __('site.popular_tour_categories') }}</h6>
                <ul>
                    <li class="itemLink mb-2 me-3"><a href="{{ route('site.travel-packages') }}">{{ __('site.egypt_travel_packages') }}</a></li>
                    <li class="itemLink mb-2 me-3"><a href="{{ route('site.package', 'shore-excursions') }}">{{ __('site.shore_excursions') }}</a></li>
                    <li class="itemLink mb-2 me-3"><a href="{{ route('site.nile-cruise') }}">{{ __('site.group_tours_to_egypt') }}</a></li>
                    <li class="itemLink mb-2 me-3">
                        <a href="{{ route('site.day-tours') }}">{{ __('site.egypt_family_holiday_packages') }}</a>
                    </li>
             </ul>
            </div>
            <div data-aos="fade-down" class="text-white capitalize">
                <h6 class="text-lg font-semibold mb-7">{{ __('site.main_links') }}</h6>
                <ul>
                 
                    <li class="itemLink mb-2 me-3"><a href="{{ route('site.about') }}">{{ __('site.reviews_about') }}</a></li>
                    <li class="itemLink mb-2 me-3"><a href="{{ route('site.terms') }}">{{ __('site.terms_and_conditions') }}</a></li>
                    <li class="itemLink mb-2 me-3"><a href="{{ route('site.blog') }}">{{ __('site.egypt_travel_guide') }}</a></li>
                    <li class="itemLink mb-2 me-3"><a href="{{ route('site.privacy') }}">{{ __('site.privacy_policy') }}</a></li>
                     </ul>
            </div>
            <div data-aos="fade-left" class="text-white capitalize">
                <h6 class="text-lg font-semibold mb-7">{{ __('site.pay_safely_with_us') }}</h6>
                <ul>
                    <li class="itemLink mb-2 me-3">
                        <a href="#">{{ __('site.payment_ssl_note') }}</a>
                    </li>
                  

                    <img src="{{ asset('assets/site/img/creditcard-logo.png') }}" alt="Credit Card Logo" style="max-width: 260px; height: 50px;">

                    
                    
                </ul>
            </div>
        </div>

        <hr/>

        <div class="text-center" data-aos="flip-left" data-aos-offset="5">
            <p class="py-3 text-white ">
                {{ __('site.designed_developed_by') }}
                <a href="https://perfectsolution4u.net/" class="text-second-color font-bold  hover:text-white"
                >Perfect Solution 4U</a
                >
                2024.
            </p>
        </div>
    </div>
</footer>

<a
    href="https://wa.me/{{ setting(\App\Enums\SettingKey::WHATSAPP_PHONE_NUMBER->value, true) }}?text=I am interested in your tours!"
    target="_blank"
    rel="noopener noreferrer"
    class="whatsapp-btn position-fixed bottom-4 left-0"
>
    <i class="bx bxl-whatsapp" style="font-size:1.5em; margin-right: 8px;"></i>
    {{ __('site.whatsapp_us') }}
</a>


@push('js')
    <script>
        $('#newsletter').on('submit', function (e) {
            e.preventDefault()
            axios.post($(this).attr('action'), $(this).serialize()).then((res) => {
                toastr.success(res.data.message);

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
