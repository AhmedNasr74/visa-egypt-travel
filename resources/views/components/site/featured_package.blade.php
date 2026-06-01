<div class="col-xl-3 col-sm-6">
    <div class="single-tour-card wow animated fadeInUp" data-wow-duration="1.0s" data-wow-delay="0.3s">
        <div class="thumb">
            <img src="{{ $tour->featured_image }}" alt="img">
        </div>
        <div class="details">
            <div class="location">
                <span class="location-name"><img src="{{ asset('assets/site/img/icons/1.png') }}" alt="img">
                    @foreach ($tour->destinations as $destination)
                        <p>{{ $destination->translateOrDefault(app()->getLocale())->title }}</p>
                    @endforeach
                </span>
                <span class="tp-review-meta float-right">
                    <i class="ic-yellow fa fa-star"></i>
                    <i class="ic-yellow fa fa-star"></i>
                    <i class="ic-yellow fa fa-star"></i>
                    <i class="ic-yellow fa fa-star"></i>
                    <span>4.0</span>
                </span>
            </div>
            <h3><a
                    href="{{ route('site.tours', $tour->translateOrDefault(app()->getLocale())->slug) }}">{{ $tour->translateOrDefault(app()->getLocale())->title }}</a>
            </h3>
            <ul class="package-meta">
                <li class="tp-price-meta">
                    <p><i class="fa fa-clock-o"></i></p>
                    <p>Duration</p>
                    <h2>{{ $tour->duration }}</h2>
                </li>
                <li class="tp-price-meta">
                    <p><i class="fa fa-tag"></i></p>
                    <p>Price</p>
                    <h2>{{ $tour->start_from }} <span>$</span></h2>
                </li>
            </ul>
        </div>
    </div>
</div>
