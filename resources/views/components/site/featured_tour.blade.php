<div class="single-upconing-card">
    <div class="shadow" style="background-image: url('{{ $tour->featured_image }}');">
        <img src="{{ asset('assets/site/img/tour/8.png') }}" alt="img">
    </div>
    <div class="tp-price-meta">
        <h2>{{ $tour->start_from }} <small>{{ user_currency()->symbol}}</small></h2>
        <p>{{ __('main.price') }}</p>
    </div>
    <div class="details">
        <h3 class="title">
            <a href="{{ route('site.tours',  $tour->slug ?? $tour->slug ) }}">
                {{$tour->title }}</a>
        </h3>
        <p><i class="fa fa-map-marker"></i> {{ $tour->title }}</p>
        <div class="tp-review-meta">
            <i class="ic-yellow fa fa-star"></i>
            <i class="ic-yellow fa fa-star"></i>
            <i class="ic-yellow fa fa-star"></i>
            <i class="ic-yellow fa fa-star"></i>
            <i class="ic-yellow fa fa-star"></i>
            <i class="ic-yellow fa fa-star"></i>
            <span>5.0</span>
        </div>
    </div>
</div>
