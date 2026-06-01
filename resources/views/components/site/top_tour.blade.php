  <div class="d-list-slider-item">
      <div class="single-destinations-list text-center">
          <div class="thumb">
              <img src="{{ $tour->featured_image }}" alt="{{ $tour->title }}">
              <div class="d-list-btn-wrap">
                  <div class="d-list-btn">
                      <a class="btn btn-yellow"
                          href="{{ route('site.tour_details', $tour->translateOrDefault()->slug) }}">
                          {{ __('main.book_now') }}
                          <i class="fa fa-paper-plane"></i></a>
                  </div>
              </div>
          </div>
          <div class="details">
              <h4 class="title">
                  <a href="{{ route('site.tour_details', $tour->translateOrDefault()->slug) }}">{{ $tour->title }}</a>
              </h4>
              <ul class="tp-list-meta border-bt-dot">
                  <li><i class="fa fa-calendar-o"></i> {{ today()->day . today()->shortMonthName }}</li>
                  <li><i class="fa fa-clock-o"></i> {{ $tour->duration }} </li>
                  <li><i class="fa fa-star"></i> {{ $tour->rate }}</li>
              </ul>
              <div class="tp-price-meta tp-price-meta-cl">
                  <p>{{ __('main.price') }}</p>
                   <h2>{{ $tour->start_from }}<span>{{ user_currency()->symbol}}</span></h2>
                  {{-- <del>620<span>$</span></del> --}}
              </div>
          </div>
      </div>
  </div>
