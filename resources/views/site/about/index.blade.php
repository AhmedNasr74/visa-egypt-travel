@extends('layouts.site.app')

@section('content')
    @php
$address = setting(App\Enums\SettingKey::ADDRESS->value ?? [])[0] ?? "";
$PRIMARY_PHONE = setting(App\Enums\SettingKey::PRIMARY_PHONE->value)[0] ?? "";
$CONTACT_EMAIL = setting(App\Enums\SettingKey::CONTACT_EMAIL->value ?? [])[0] ?? "";
@endphp



    <!-- banner  -->
    <section>
        <div
          class="capitalize flex justify-between px-4 h-[50vh] bg-[url('../image/banner-bg.jpg')] bg-cover bg-center bg-no-repeat"
        >
          <span class="self-center text-4xl font-semibold text-white">{{ __('site.about') }}</span>

          <!-- Breadcrumb -->
          <nav
            class="flex self-end px-5 py-3 text-gray-700 border border-gray-200 rounded-t-lg bg-white"
            aria-label="Breadcrumb"
          >
            <ol
              class="inline-flex flex-wrap items-center space-x-1 md:space-x-2 rtl:space-x-reverse"
            >
              <li class="inline-flex items-center">
                <a
                  href="{{ route("site.home") }}"
                  class="inline-flex items-center text-sm font-medium text-main-color hover:text-second-color"
                >
                  <svg
                    class="w-3 h-3 me-2.5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"
                    />
                  </svg>
                  {{ __('site.home') }}
                </a>
              </li>
              <li aria-current="page">
                <div class="flex items-center">
                  <svg
                    class="rtl:rotate-180 w-3 h-3 mx-1 text-main-color"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 6 10"
                  >
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="m1 9 4-4-4-4"
                    />
                  </svg>
                  <span class="ms-1 text-sm font-medium text-second-color md:ms-2"
                    >{{ __('site.about') }}</span
                  >
                </div>
              </li>
            </ol>
          </nav>
        </div>
      </section>

      <!-- learn about us -->
      <section class="my-20">
        <div class="container">
          <div class="grid lg:grid-cols-2 grid-cols-1 gap-8 my-11">
            <figure class="overflow-hidden rounded-md">
              <img
                src="{{ asset('assets/site/img/tour-7.jpg') }}"
                class="w-full h-full imageAnimation transition-time"
                alt=""
              />
            </figure>
            <div>
              <!-- section title -->
              <div>
                <span
                  class="text-2xl font-dancingFont text-second-color capitalize"
                  >{{ __('site.learn_about_us') }}</span
                >
                <h2 class="text-3xl sm:text-5xl font-semibold capitalize">
                  {{ __('site.dare_to_explore_with_tevily_agency') }}
                </h2>
              </div>

              <p class="text-zinc-500 my-6">
                {{ __('site.about_description') }}
              </p>

              <!-- progress -->
              <div>
                <div class="my-5">
                  <span class="font-semibold text-xl capitalize"
                    >{{ __('site.best_services') }}</span
                  >

                  <div class="w-full mt-2 bg-main-color/15 rounded-full">
                    <div
                      class="bg-second-color text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                      style="width: 80%"
                    >
                      80%
                    </div>
                  </div>
                </div>
                <div class="my-5">
                  <span class="font-semibold text-xl capitalize"
                    >{{ __('site.tour_agents') }}</span
                  >

                  <div class="w-full mt-2 bg-main-color/15 rounded-full">
                    <div
                      class="bg-second-color text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                      style="width: 75%"
                    >
                      75%
                    </div>
                  </div>
                </div>
              </div>

              <div class="mt-11">
                <a href="#" class="mainBtn inline-block mb-2 me-4 text-nowrap"
                  >/ {{ __('site.get_right_solutions') }}</a
                >
                <a href="#" class="mainBtn inline-block mb-2 me-4 text-nowrap"
                  >/ {{ __('site.expert_architecture') }}</a
                >
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- plan your trip -->
      <section
        class="mt-20 bg-black/80 py-14 bg-[url('../image/bg-line.png')] bg-center bg-cover bg-no-repeat"
      >
        <div class="container flex flex-wrap gap-6 justify-between items-center">
          <!-- section title -->
          <div>
            <span class="text-2xl font-dancingFont text-second-color capitalize"
              >{{ __('site.plan_your_trip_with_us') }}</span
            >
            <h2 class="text-3xl sm:text-5xl font-semibold capitalize text-white">
              {{ __('site.ready_for_an_unforgettable_tour') }}
            </h2>
          </div>

          <a href="#" class="mainBtn uppercase">{{ __('site.book_tour_now') }}</a>
        </div>
      </section>

      <!-- Testimonials & reviews  -->
      <section
        class="py-20 bg-[#FAF5EE] bg-[url('../image/bg-map.png')] bg-center bg-cover bg-no-repeat"
      >
        <div class="container">
          <!-- section title -->
          <div class="text-center">
            <span class="text-2xl font-dancingFont text-second-color capitalize"
              >{{ __('site.testimonials_reviews') }}</span
            >
            <h2 class="text-3xl sm:text-5xl font-semibold capitalize">
              {{ __('site.what_they_are_saying') }}
            </h2>
          </div>
          <div
            class="newsSlider owl-carousel owl-theme grid gap-6 grid-cols-1 lg:grid-cols-3 my-11"
          >
            @foreach ($comments as $com )
            <div>
                <figure class="overflow-hidden size-48 rounded-full my-5 mx-auto">
                  <img
                    src="{{ asset("assets/site/img/testimonial-2.jpg") }}"
                    class="w-full h-full imageAnimation transition-time"
                    alt="user image"
                  />
                </figure>
                <figcaption
                  class="bg-white p-7 rounded-md text-center border hover:shadow-lg transition-all"
                >
                  <div>
                    <i class="bx bxs-star text-yellow-400"></i>
                    <i class="bx bxs-star text-yellow-400"></i>
                    <i class="bx bxs-star text-yellow-400"></i>
                    <i class="bx bxs-star text-yellow-400"></i>
                    <i class="bx bxs-star text-yellow-400"></i>
                  </div>
                  <p class="my-4 text-zinc-500">
                    {{ $com->comment }}
                  </p>
                  <div>
                    <h4 class="font-bold text-xl capitalize">{{ $com->first_name }}</h4>
                    <span class="text-second-color uppercase">customer</span>
                  </div>
                </figcaption>
              </div>

            @endforeach
          </div>
        </div>
      </section>

      <!-- Are you ready to travel? -->
      <section
        class=" "
      >
          <div class="py-20 bg-[url('../image/bg-1.jpg')] bg-center bg-cover bg-no-repeat bg-fixed">

              <div
              class="videoBox cursor-pointer size-20 text-2xl rounded-md text-white center bg-second-color mx-auto my-6"
              >
              <i class="bx bxs-right-arrow"></i>
              </div>
              <!-- section title -->
              <div class="text-center w-[80%] mx-auto my-8">
              <span class="text-4xl font-dancingFont text-second-color capitalize"
                  >{{ __('site.are_you_ready_to_travel') }}</span
              >
              <h2
                  class="text-3xl sm:text-6xl font-semibold capitalize text-white my-8"
              >
                  {{ __('site.tevily_world_leading_platform') }}
              </h2>
              </div>

          </div>

          <!-- counter -->
          <div class="grid grid-cols-2 gap-4 lg:grid-cols-4 text-center py-8 mx-7 bg-white shadow-md -translate-y-1/3 rounded-md ">
              <div class="border-e border-zinc-500">
                  <span  data-to="890"  class="text-second-color font-bold font-dancingFont text-4xl counterIt">890</span>
                  <p class="capitalize text-zinc-500">{{ __('site.total_donations') }}</p>
              </div>
              <div class="border-e border-zinc-500">
                  <span  data-to="570"  class="text-second-color font-bold font-dancingFont text-4xl counterIt">570</span>
                  <p class="capitalize text-zinc-500">{{ __('site.campaigns_closed') }}</p>
              </div>
              <div class="border-e border-zinc-500">
                  <span  data-to="930"  class="text-second-color font-bold font-dancingFont text-4xl counterIt">930</span>
                  <p class="capitalize text-zinc-500">{{ __('site.happy_people') }}</p>
              </div>
              <div class="border-e border-zinc-500">
                  <span  data-to="68"  class="text-second-color font-bold font-dancingFont text-4xl counterIt">68</span>
                  <p class="capitalize text-zinc-500">{{ __('site.our_volunteers') }}</p>
              </div>
          </div>

      </section>

      <!-- video overlay -->
      <div class="bg-black/50 h-screen fixed inset-0 z-50 hidden videoOverlay">
        <div class="center h-full flex-col">
          <div class="w-[90%] sm:h-3/4 lg:w-[65%] h-72 text-end">
            <i
              class="bx bx-message-square-x text-3xl text-second-color mb-2 cursor-pointer"
            ></i>
            <!-- <img src="./image/tour-1.jpg" class="w-full h-full rounded-md" alt=""> -->
            <iframe
              src="https://www.youtube.com/embed/O89JAomwn2s?autoplay=1&loop=1&rel=1&playlist=O89JAomwn2s"
              class="w-full h-full rounded-md"
            ></iframe>
          </div>
        </div>
      </div>

      <!-- team -->
      <section class="mt-20">
        <div class="container">
          <!-- section title -->
          <div class="text-center">
            <span class="text-2xl font-dancingFont text-second-color capitalize"
              >{{ __('site.professional_people') }}</span
            >
            <h2 class="text-3xl sm:text-5xl font-semibold capitalize">
              {{ __('site.meet_the_team') }}
            </h2>
          </div>
          <!--  -->
          <div
            class="teamSlider owl-carousel owl-theme grid gap-6 grid-cols-1 lg:grid-cols-3 my-11"
          >
            @foreach ($employees as $emp )
            <div class="group">
                <figure class="overflow-hidden h-80 rounded-md relative">
                  <img
                    src="{{ $emp->image }}"
                    class="w-full h-full imageAnimation transition-time"
                    alt="user image"
                  />
                  <ol
                    class="absolute top-3 right-3 -translate-y-[110%] group-hover:-translate-y-[0%] transition-time"
                  >
                    <a href="{{ $emp->facebook_link }}"
                      ><li
                        class="size-10 center text-xl mb-2 rounded-full bg-black/50 text-white hover:bg-second-color transition-all"
                      >
                        <i class="bx bxl-facebook"></i></li
                    ></a>
                    <a href="{{ $emp->twitter_link }}"
                      ><li
                        class="size-10 center text-xl mb-2 rounded-full bg-black/50 text-white hover:bg-second-color transition-all"
                      >
                        <i class="bx bxl-twitter"></i></li
                    ></a>
                    <a href="{{ $emp->insta_link }}"
                      ><li
                        class="size-10 center text-xl mb-2 rounded-full bg-black/50 text-white hover:bg-second-color transition-all"
                      >
                        <i class="bx bxl-instagram"></i></li
                    ></a>
                    <a href="{{ $emp->linkedin_link }}"
                      ><li
                        class="size-10 center text-xl mb-2 rounded-full bg-black/50 text-white hover:bg-second-color transition-all"
                      >
                        <i class="bx bxl-linkedin"></i></li
                    ></a>
                    <a href="{{ $emp->mail_link }}"
                      ><li
                        class="size-10 center text-xl mb-2 rounded-full bg-black/50 text-white hover:bg-second-color transition-all"
                      >
                        <i class="bx bxl-gmail"></i></li
                    ></a>
                  </ol>
                </figure>
                <figcaption
                  class="bg-white rounded-md text-center py-4 px-2 mx-3 -translate-y-5 hover:shadow transition-all"
                >
                  <h4 class="font-bold text-lg capitalize">{{ $emp->name }}</h4>
                  <span class="text-second-color uppercase">{{ $emp->title }}</span>
                </figcaption>
              </div>

            @endforeach
          </div>
        </div>
      </section>


@endsection
