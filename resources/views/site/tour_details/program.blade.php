<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <!-- Bootstrap CSS -->

    <!-- Your custom CSS -->
    <style>
        .select2-container .select2-selection--single {
            max-width: 61px;
            height: 50px;
        }
    </style>
</head>
<body>

  @foreach($booking as $book)
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-inner">
              <h1 class="page-title">{{ $book->tour->title }}</h1>
              <ul class="page-list">
                <li>{{ $book->tour->title }}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- breadcrumb area End -->
    <!-- tour details area End -->
    <div class="tour-details-area mg-top--70">
        <div class="tour-details-gallery py-4 bg-mainColor">
          <div class="container-bg mx-auto">
            <div class="container">


              <div class="row mt-5">
                <div class="col-xl-9 col-lg-10">
                  <div class="book-list-warp">
                    <div class="tp-price-meta"style="margin-right: 25px;">
                      <p class="text-mainColor">Price</p>
                      <h2 style="color: #366d66;">{{$book->tour->start_from_price}} <small style="margin-right: -19px;">{{ user_currency()->symbol}}</small></h2>
                    </div>
                  </div>
                  <ul class="tp-list-meta border-tp-solid fw-bold mb-1">
                    <li class="ml-0"><i class="fa fa-calendar-o"></i> {{$book->tour->pickup_time}}</li>
                    <li><i class="fa fa-clock-o"></i> {{$book->tour->duration}}</li>
                    <li><i class="fa fa-users"></i>{{$book->tour->run}}</li>
                    <li><i class="fa fa-snowflake-o"></i> {{$book->tour->type}}</li>
                    <li><i class="fa fa-star"></i> 4.3</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

    <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="tour-details-wrap">
               @if($book->tour->included)
                <div class="package-included-area">
                    <h4 class="single-page-small-title">{{ __('main.included') }}</h4>
                    <div class="row">
                            @foreach (Str::of($book->tour->included)->explode(',') as $included)
                                <div class="col-xl-4 col-sm-6">
                                    <div class="single-package-included">
                                      <h6>{{ \Str::of($included)->remove('•') }}</h6>
                                      <p{{ \Str::of($included)->remove('•') }}</p>
                                    </div>
                                  </div>
                            @endforeach
                    </div>
                </div>
            @endif
            @if($book->tour->excluded)
            <div class="package-included-area">
                <h4 class="single-page-small-title">{{ __('main.excluded') }}</h4>
                <div class="row">
                        @foreach (Str::of($book->tour->excluded)->explode(',') as $excluded)
                            <div class="col-xl-4 col-sm-6">
                                <div class="single-package-included">
                                  <h6>{{ \Str::of($excluded)->remove('•') }}</h6>
                                  <p{{ \Str::of($excluded)->remove('•') }}</p>
                                </div>
                              </div>
                        @endforeach
                </div>
            </div>
        @endif
             <div class="package-included-location">
                <h4 class="single-page-small-title">{{ __('site.your_itinerary') }}</h4>
                <div class="row">

                    @foreach ($book->tour->days as $index=>$day )
                    <div class="col-12 pt-3">
                        <div class="row justify-content-between">
                          <div class="col-2">
                            <div class="count" role="button">
                              <div class="p-list">
                                <div class="list">{{$index+1}}</div>
                                <p>{{ __('site.day') }} {{$index+1}}</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-10">
                            <h4 class="title">{{$day->title}}</h4>
                            <div class="single-blog d-none">
                              <div class="thumb">
                              </div>
                              <div class="single-blog-details">
                                <p class="content">
                                    {!! $day->description !!}
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                </div>
              </div>
              <div class="service-location-map">
                <h4 class="single-page-small-title">{{ __('site.service_location') }}</h4>
                <div class="service-location-map">
                  <a   href="{{$book->tour->location}}"

                  ></a>

                </div>
              </div>
            </div>
          </div>

      </div>
      @endforeach
</body>
