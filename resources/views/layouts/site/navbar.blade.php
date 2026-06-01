@php
    $Whatsapp_num = setting(App\Enums\SettingKey::WHATSAPP_PHONE_NUMBER->value)[0] ?? "";
    $phone = setting(App\Enums\SettingKey::PRIMARY_PHONE->value)[0] ?? "";
    $address = setting(App\Enums\SettingKey::ADDRESS->value)[0] ?? "";
    $email = setting(App\Enums\SettingKey::CONTACT_EMAIL->value)[0] ?? "";
    $site = setting(App\Enums\SettingKey::SITE_TITLE->value)[0] ?? "";
@endphp

{{--<header data-aos="fade-down" data-aos-delay="300">--}}

{{--</header>--}}

<div class="topHead bg-[#fff] flex-wrap md:flex hidden items-center justify-between py-3 border-b-[1px] px-[100px]">
    <div class="flex">
        <div class="me-4">
            <i class="bx bxl-whatsapp text-[17px] text-second-color"></i>
            <a href="tel:{{ $phone }}" class="text-main-color"
            >{{ $phone }}</a
            >
        </div>
        <div class="me-4">
            <i class="bx bx-envelope text-[17px] text-second-color"></i>
            <a href="mailTo:{{ $email }}" class="text-main-color"
            >{{ $email }}</a
            >
        </div>
    </div>
    <div class="flex items-center capitalize">
        @if (auth()->guard('client')->user())
            <form action="{{ route('site.logout-client') }}" method="POST">
                @csrf
                <button class="text-main-color font-semibold">{{ __('site.logout') }}</button>
            </form>
        @else

            <a href="{{ route('login-page') }}" class="text-main-color font-semibold">{{ __('site.login') }}</a>
        @endif
        <div class="flex ms-5 text-main-color">
            {{-- <label for="language">language</label> --}}
            <div class="">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <i class="fa-solid fa-earth-americas me-1 textMainColor"></i>
                            {{ LaravelLocalization::getCurrentLocaleNative() }}
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
        </div>
    </div>
</div>
<div class="main-menu">
    <div class="container">
        <nav class="flex justify-between items-center py-4">
            <div class="flex items-center space-x-2">
                <a href="{{ route('site.home') }}">
                    <img
                        style="width: 170px;"
                        src="{{ logo() }}"
                        alt="logo image"
                    />
                </a>
            </div>

            <div>
                <ul class="hidden xl:flex space-x-5 capitalize">
                    <li class="text-md text-main-color hover:text-second-color transition-all ease-in duration-200">
                        <a href="{{ route('site.travel-packages') }}">{{ __('site.travel_package') }}</a>
                    </li>
                    <li
                        class="text-md text-main-color hover:text-second-color transition-all ease-in duration-200"
                    >
                        <a href="{{ route('site.day-tours') }}">{{ __('site.day_tours') }}</a>
                    </li>

                    <li class="text-md text-main-color hover:text-second-color transition-all ease-in duration-200">
                        <a href="{{ route('site.nile-cruise') }}">{{ __('site.nile_cruises') }}</a>
                    </li>
                    <li class="text-md text-main-color hover:text-second-color transition-all ease-in duration-200">
                        <a href="{{ route('site.limo.home') }}">{{ __('site.limo') }}</a>
                    </li>
                    <li class="text-md text-main-color hover:text-second-color transition-all ease-in duration-200">
                        <a href="{{ route('site.package', 'shore-excursions') }}">{{ __('site.shore_excursions') }}</a>
                    </li>
                    <li class="text-md text-main-color hover:text-second-color transition-all ease-in duration-200">
                        <a href="{{ route('site.contact') }}">{{ __('site.reviews') }}</a>
                    </li>
                    <li
                        class="text-md text-main-color hover:text-second-color transition-all ease-in duration-200"
                    >
                        <a href="{{ route('site.blog') }}">{{ __('site.blogs') }}</a>
                    </li>
                </ul>
            </div>

            <div class="hidden xl:block">
                <div class="flex items-center">
                    <div class="relative inline-block text-center">
                        <div class="cursor-pointer searchIcon text-main-color">
                            <i class="bx bx-search-alt text-3xl me-3"></i>
                        </div>

                        <div
                            class="searchDetails hidden capitalize font-semibold absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="menu-button"
                            tabindex="-1"
                        >
                            <a
                                href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-slate-200"
                            >{{ __('site.articles') }}
                            </a>
                            <a
                                href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-slate-200"
                            >{{ __('site.tours') }}</a
                            >
                        </div>
                    </div>
                    <a href="{{ route('site.custom-trip') }}">
                        <button class="mainBtn">{{ __('site.tailor_made_your_trip') }}</button>
                    </a>
                </div>
            </div>

            <button class="xl:hidden menuIcon">
                <i
                    class="bx bx-menu-alt-right text-3xl text-main-color cursor-pointer hover:text-second-color focus:text-second-color"
                ></i>
            </button>
        </nav>

        <ul
            id="menu-details"
            class="xl:hidden hidden capitalize bg-slate-300 absolute left-6 right-6 text-center z-20 space-y-3 py-3"
        >
            <li
                class="text-md text-main-color hover:text-second-color transition-all ease-in duration-200"
            >
                <a href="{{ route('site.home') }}">{{ __('site.home') }}</a>
            </li>
            <li
                class="text-md text-main-color hover:text-second-color transition-all ease-in duration-200"
            >
                <a href="{{ route('site.travel-packages') }}">{{ __('site.travel_package') }}</a>
            </li>
            <li
                class="text-md text-main-color hover:text-second-color transition-all ease-in duration-200"
            >
                <a href="{{ route('site.day-tours') }}">{{ __('site.day_tours') }}</a>
            </li>
            <li
                class="text-md text-main-color hover:text-second-color transition-all ease-in duration-200"
            >
                <a href="{{ route('site.nile-cruise') }}">{{ __('site.nile_cruises') }}</a>
            </li>
            <li
                class="text-md text-main-color hover:text-second-color transition-all ease-in duration-200"
            >
                <a href="{{ route('site.package', 'shore-excursions') }}">{{ __('site.shore_excursions') }}</a>
            </li>
            <li
                class="text-md text-main-color hover:text-second-color transition-all ease-in duration-200"
            >
                <a href="{{ route('site.limo.home') }}">{{ __('site.limo') }}</a>
            </li>
            <li
                class="text-md text-main-color hover:text-second-color transition-all ease-in duration-200"
            >
                <a href="{{ route('site.contact') }}">{{ __('site.reviews') }}</a>
            </li>
            <li
                class="text-md text-main-color hover:text-second-color transition-all ease-in duration-200"
            >
                <a href="{{ route('site.blog') }}">{{ __('site.blogs') }}</a>
            </li>
            <li>
                <div class="flex items-center justify-center">
                    <div class="relative inline-block text-left">
                        <div class="cursor-pointer searchIcon text-main-color">
                            <i class="bx bx-search-alt text-3xl me-3"></i>
                        </div>

                        <div
                            class="searchDetails hidden capitalize font-semibold absolute z-10 mt-2 w-32 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="menu-button"
                            tabindex="-1"
                        >
                            <a
                                href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-slate-200"
                            >{{ __('site.articles') }}
                            </a>
                            <a
                                href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-slate-200"
                            >{{ __('site.tours') }}</a
                            >
                        </div>
                    </div>

                    <a href="{{ route('site.custom-trip') }}">
                        <button class="mainBtn">{{ __('site.tailor_made_your_trip') }}</button>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>




@push('js')

    <script>

        $("#contact").on('submit', function (e) {
            e.preventDefault()
            let submitBtn = $(this).find('button')
            submitBtn.attr('disabled', true)
            axios.post($(this).attr('action'), $(this).serialize()).then((res) => {
                toastr.success(res.data.message);
                setTimeout(() => {
                    location.reload();
                }, 1000)
            }).catch(error => {
                toastr.error(error.response.data.error ?? '{{ __('main.unexpected-error') }}')
                    submitBtn.attr('disabled', false)
                }).finally()
            })

</script>
@endpush
