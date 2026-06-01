 <div class="col-lg-3 col-sm-6">
     <div class="single-destinations-list style-two wow animated fadeInUp"
          data-wow-duration="0.7s" data-wow-delay="{{$delay}}s">
         <div class="thumb">
             <img src="{{ $tour->featured_image }}" alt="{{ $tour->title }}">
         </div>
         <div class="details">
             <p class="location">
                 <img src="{{ asset('assets/site/img/icons/1.png') }}"
                      alt="{{ $tour->destinations->first()?->title }}">
                 {{ $tour->destinations->first()?->title }}</p>
             <h4 class="title">
                 <a href="{{ route('site.tour_details', $tour->translateOrDefault()->slug ?? $tour->id) }}">{{ $tour->title }}</a>
             </h4>
             <p class="content">{{ $tour->duration }} </p>
             <div class="tp-price-meta">
                 <h2>{{ $tour->start_from }}<small>{{ user_currency()->symbol}}</small></h2>
             </div>
         </div>
     </div>
 </div>
