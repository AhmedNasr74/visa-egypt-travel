@extends('layouts.site.app')

@section('content')
    <!-- ================= start des_details start ========================= -->

    <!-- breadcrumb area start -->



    <div class="breadcrumb-area style-two jarallax" style="background-image:url('{{ $category->featured_image }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <h1 class="page-title">{{ $category->title }}</h1>
                        <ul class="page-list">
                            <li><a href="{{ route('site.home') }}">{{ __('main.home') }}</a></li>
                            <li>{{ $category->title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- destinations-details-page start -->
    <div class="destinations-details-page mg-top--70">
        <div class="container">



            <div class="row destinations-details-location-name "style="margin-top:80px">
                <div class="col-lg-12">
                    <h3>{{ $category->title }}</h3>
                </div>
                <div class="col-lg-11">
                    <p>{!! $category->description !!}</p>
                </div>

            </div>

            <!-- destination area End -->
            <div class="destination-area ">
                <h4 class="single-page-small-title">{{ __('main.explore') }}</h4>

                @if ($offers)

                <div class="container">
                    <div class="row justify-content-center">
                        @foreach ($offers as $tour)
                            <div class="col-lg-4 col-md-6">
                                <div class="single-destination-grid text-center">
                                    <div class="thumb">
                                        <img src="{{ $tour->featured_image }}" alt="img">
                                    </div>
                                    <div class="details">
                                        <div class="tp-review-meta">
                                            <i class="ic-yellow fa fa-star"></i>
                                            <i class="ic-yellow fa fa-star"></i>
                                            <i class="ic-yellow fa fa-star"></i>
                                            <i class="ic-yellow fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <span>4.9</span>
                                        </div>
                                        <h3 class="title">{{ $tour->translateOrDefault(app()->getLocale())->title }}
                                        </h3>
                                        <p class="content">{!! $tour->translateOrDefault(app()->getLocale())->overview !!}</p>
                                        <a class="btn btn-gray"
                                           href="{{ route('site.tour_details', $tour->slug ?? $tour->id) }}"><span>{{ __('main.explore') }}<i
                                                    class="la la-arrow-right"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                @endif
            </div>
            <!-- destination area End -->


      <!-- destination area End -->

    <!-- newslatter area Start -->
    <x-site.newsletter id="newsletter"/>

    <!-- destinations-details-page End -->


    <!-- ========================= End des_details Section ============ -->
@endsection
@push('js')
<script src="{{ asset('assets/site/js/main.js') }}"></script>

<!-- Add Slick Slider initialization code -->
<script>
    // $(document).ready(function () {
    //     $('.destinations-details-main-slider').slick({
    //         slidesToShow: 1,
    //         slidesToScroll: 1,
    //         autoplay: true,
    //         autoplaySpeed: 2000,
    //     });
    // });

    var $d_details_main_slider = $(".destinations-details-main-slider");
    $d_details_main_slider.slick({
      slidesToShow: 1,
      dots: false,
      slidesToScroll: 1,
      speed: 400,
      loop: true,
      fade: true,
      autoplay: false,
      prevArrow:
        '<span class="slick-prev"><i class="la la-long-arrow-left"></i></span>',
      nextArrow:
        '<span class="slick-next"><i class="la la-long-arrow-right"></i></span>',
      appendArrows: $(".destinations-details-main-slider-controls .slider-nav"),
    });
    //active progress
    var $progressBar = $(".d-list-progress");
    var $progressBarLabel = $(".slider__label");
    $d_details_main_slider.on(
      "beforeChange",
      function (event, slick, currentSlide, nextSlide) {
        var calc = (nextSlide / (slick.slideCount - 1)) * 100;
        $progressBar
          .css("background-size", calc + "% 100%")
          .attr("aria-valuenow", calc);
        $progressBarLabel.text(calc + "% completed");
      }
    );
    //active count list
    $(".destinations-details-main-slider").on(
      "beforeChange",
      function (event, slick, currentSlide, nextSlide) {
        var firstNumber = check_number(++nextSlide);
        $(
          ".destinations-details-main-slider-controls .slider-extra .text .first"
        ).text(firstNumber);
      }
    );
    var smSlider = $(".destinations-details-main-slider").slick("getSlick");
    var smSliderCount = smSlider.slideCount;
    $(
      ".destinations-details-main-slider-controls .slider-extra .text .last"
    ).text(check_number(smSliderCount));
    function check_number(num) {
      var IsInteger = /^[0-9]+$/.test(num);
      return IsInteger ? "" + num : null;
    }

</script>
@endpush
