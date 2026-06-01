    <!-- categories -->
    <section class="my-20">
      <div class="container">
          <!-- section title -->
          <div class="text-center" data-aos="fade-up">
              <span class="text-2xl font-dancingFont text-second-color capitalize ">{{ __('site.categories_lists') }}</span>
              <h2 class="text-3xl sm:text-5xl font-semibold capitalize">{{ __('site.go_exotic_places') }}</h2>
          </div>

          <div class="grid md:grid-cols-4 grid-cols-1 gap-4 my-11">
              @forelse ($destinations as $i=>$des)
              <a href="{{ route('site.des-details',$des->slug ?? $des->id) }}" data-aos="
              @if ($i%2)
                  fade-right
                  @else
                  fade-left
              @endif
              "
              @if ($i==0 || $i==2)
              @else
                  class="col-span-2"
              @endif
              >
                  <figure class="h-60 relative rounded-md overflow-hidden">
                      <img src="{{ $des->featured_image }}" class="w-full h-full imageAnimation" alt="{{ __('site.tour_image') }}">
                      <span class="absolute top-2 right-2 uppercase bg-second-color text-white px-2 rounded-md hover:bg-main-color"><b class="me-1">{{ $des->tours()->count() }}</b>{{ __('site.tours') }}</span>
                      <div class="absolute bottom-4 left-4 capitalize">
                          <h3 class="text-xl text-white  font-bold">{{ $des->title }}</h3>
                      </div>
                  </figure>
              </a>
              @empty

              @endforelse


          </div>
      </div>
  </section>
