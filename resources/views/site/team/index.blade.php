@extends('layouts.site.app')

@section('content')

<section class="banner">
    <div class="container-fluid">
      <figure class="position-relative">
        <!-- <img
            src="{{asset("assets/site/img/banner.png")}}"
            class="w-100 h-75"
            alt="about us banner image"
          /> -->
        <figcaption class="position-absolute">
          <div class="text-capitalize">
            <h2 class="text-white h1">{{__('main.our_team')}}</h2>
            <p class="text-white">
                <a href="{{route("site.home")}}">
                    <span class="textMainColor me-1">{{ __('main.home') }}</span>
                </a>               > {{__('main.our_team')}}
            </p>
          </div>
        </figcaption>
      </figure>
    </div>
  </section>

  <section class="my-5 overflow-hidden" id="team">
    <div class="row">
      <div class="text-center my-3">
        <h3 class="textMainColor dancingFont text-capitalize">
          {{ __('site.popular_activities') }}
        </h3>
        <h5 class="text-capitalize h1">
          {{ __('site.meet_our_experienced') }} <br />
          <span class="textMainColor dancingFont">{{ __('site.team') }} </span>{{ __('site.people') }}
        </h5>
      </div>
      <div class="col-lg-4 col-md-6 m-auto">
        <div class="team position-relative">
          <div class="swiper-wrapper">
          @foreach ($employees as $emp )
          <div class="col-lg-4 swiper-slide">
            <div class="teamBox cPointer p-2">
              <img
                src="{{$emp->image}}"
                class="w-100 position-relative rounded-3"
                alt="{{ __('site.our_team_image') }}"
              />

              <ul class="icons-card list-unstyled p-2">
                <li>
                  <a href="{{$emp->facebook_link}}"><i class="fa-brands fa-facebook-f"></i></a>
                </li>
                <li>
                  <a href="{{$emp->twitter_link}}"><i class="fa-brands fa-twitter"></i></a>
                </li>
                <li>
                  <a href="{{$emp->linkedin_link}}"><i class="fa-brands fa-linkedin-in"></i></a>
                </li>
                <li>
                  <a href="{{$emp->insta_link}}"><i class="fa-brands fa-instgram"></i></a>
                </li>
              </ul>

              <h5
                class="textMainColor font-sm text-capitalize mt-3 text-center"
              >
                {{$emp->title}}
              </h5>
              <h3 class="text-capitalize h6 text-center">{{$emp->name}}</h3>
            </div>
          </div>
          @endforeach

          </div>
          <div class="swiper-pagination"></div>

          <div
            class="swiper-button-wp d-flex justify-content-between align-items-center mt-5"
          >
            <div class="swiper-button-prev swiper-button">
              <i class="fa fa-angle-left"></i>
            </div>
            <div class="swiper-button-next swiper-button">
              <i class="fa fa-angle-right"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


@endsection
