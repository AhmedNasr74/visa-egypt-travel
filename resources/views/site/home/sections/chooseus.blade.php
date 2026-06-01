<section class="my-20">
  <div class="grid md:grid-cols-2 grid-cols-1">
      <figure data-aos="fade-left" class="overflow-hidden h-60 md:h-auto"><img src="{{ asset($page->data['main_section_image'] ?? 'assets/site/img/why choose us.jpg') }}" class="w-full h-full imageAnimation" alt=""></figure>
      <div class="py-20 px-5 lg:px-11 bg-map" data-aos="fade-right">
          <!-- section title -->
          <div>
              <span class="text-2xl font-dancingFont text-second-color capitalize ">Our benefit lists</span>
              <h2 class="text-3xl sm:text-5xl font-semibold capitalize text-white">Why Choose us</h2>
              <p class="text-zinc-500 my-4">
                  {{ $page->data['description'][app()->getLocale()] ?? $page->data['description'][$defaultLocale] ?? null }}
              </p>
          </div>

          @if(isset($page->data['first_item']['title'][app()->getLocale()]) || isset($page->data['first_item']['title'][$defaultLocale]))
              <div class="flex my-8">
                  <figure class="size-14 flex-shrink-0 me-5"><img src="{{ $page->data['first_item']['icon'] ?? asset('assets/site/img/business-trip.png') }}" class="w-full h-full" alt="icon"></figure>
                  <div>
                      <h4 class="text-white capitalize font-semibold text-xl">{{ $page->data['first_item']['title'][app()->getLocale()] ?? $page->data['first_item']['title'][$defaultLocale] ?? '' }}</h4>
                      <p class="text-zinc-500 my-4">{{ $page->data['first_item']['description'][app()->getLocale()] ?? $page->data['first_item']['description'][$defaultLocale] ?? '' }}</p>
                  </div>
              </div>
          @endif

          @if(isset($page->data['second_item']['title'][app()->getLocale()]) || isset($page->data['second_item']['title'][$defaultLocale]))
              <div class="flex my-8">
                  <figure class="size-14 flex-shrink-0 me-5"><img src="{{ $page->data['second_item']['icon'] ?? asset('assets/site/img/online-booking.png') }}" class="w-full h-full" alt="icon"></figure>
                  <div>
                      <h4 class="text-white capitalize font-semibold text-xl">{{ $page->data['second_item']['title'][app()->getLocale()] ?? $page->data['second_item']['title'][$defaultLocale] ?? '' }}</h4>
                      <p class="text-zinc-500 my-4">{{ $page->data['second_item']['description'][app()->getLocale()] ?? $page->data['second_item']['description'][$defaultLocale] ?? '' }}</p>
                  </div>
              </div>
          @endif
      </div>
  </div>
</section>
