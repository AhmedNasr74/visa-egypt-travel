<div class="single-destinations-list style-three">
    <div class="thumb">
        <img src="{{ $tour->featured_image }}" alt="list">
    </div>
    <div class="details">
        <div class="tp-review-meta">
            @for($i = 1 ; $i <= 5; $i++)
                <i @class(['fa fa-star' , 'ic-yellow' => $tour->rate >= $i])></i>

            @endfor
            <span>{{ number_format($tour->rate, 1) }}</span>
        </div>
        @if ($tour->destinations)
            @foreach ($tour->destinations as $des)
                <p class="location"><img src="{{ asset('assets/site/img/icons/1.png') }}" alt="map">
                    {{ $des['title'] }}
                </p>
            @endforeach
        @endif
        <h4 class="title"><a
                href="{{ route('site.tour_details', $tour->translateOrDefault(app()->getLocale())->slug ?? $tour->id) }}">{{ $tour->title }}</a>
        </h4>
        <p title="{{ $tour->overview_text }}"
           class="content">{{ mb_strimwidth($tour->overview_text, 0, 180, '...') }}</p>
        <div class="list-price-meta">
            <ul class="tp-list-meta d-inline-block">
                <li><i class="fa fa-calendar-o"></i> 8oct</li>
                <li><i class="fa fa-clock-o"></i> {{ $tour->duration }} </li>
                <li><i class="fa fa-star"></i> {{ number_format($tour->rate, 1)}}</li>
            </ul>
            <div class="tp-price-meta d-inline-block">
                <p>{{__('main.price_from')}}</p>
                <h2>{{ $tour->start_from_price }}<span>$</span></h2>
            </div>
        </div>
    </div>
</div>
