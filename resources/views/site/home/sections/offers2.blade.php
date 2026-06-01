<section class="my-20">
  <div class="container">
      <!-- section title -->
      <div class="text-center" data-aos="fade-up">
          <span class="text-2xl font-dancingFont text-second-color capitalize ">Magic tours</span>
          <h2 class="text-3xl sm:text-5xl font-semibold capitalize">Our Recommendations</h2>
      </div>

      <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-11">
          
          @forelse ($offers as $i=>$tour)
          <div class="border rounded-md h-full" data-aos="fade-up">
            <figure class="rounded-md overflow-hidden relative">
                <a href="{{ route('site.tour_details',$tour->slug) }}">
                    <img src="{{ $tour->featured_image }}" class="w-full imageAnimation" style="height: 195px !important" alt="{{ $tour->title }}">
                </a>
                <div class="flex justify-between absolute top-3 left-3 right-3">
                    <span class="uppercase bg-main-color hover:bg-second-color text-white px-2 py-1 rounded-md transition-time">featured</span>
                    <span class="bg-black/45 size-8 rounded-md text-white center cursor-pointer"><i class="bx bx-heart"></i></span>
                </div>
            </figure>

            <figcaption class="capitalize p-4 hover:shadow-lg transition-time">
                <a href="{{ route('site.tour_details',$tour->slug) }}">
                    <h3 class="text-xl text-main-color hover:text-second-color font-semibold">{{ $tour->title }}</h3>
                </a>
                {{-- <div class="my-3">
                    <i class='bx bx-map text-second-color' ></i>
                    <span class="text-zinc-500">Lorem ipsum dolor sit.</span>
                </div> --}}
                <div class="my-3">
                    from
                    <span class="text-second-color font-semibold">{{ $tour->start_from_price . user_currency()->symbol }}</span>
                </div>
                <div class="between bg-amber-50/55 p-2">
                    <div class="between">
                        <div class="me-2">
                            <i class='bx bx-time-five text-second-color' ></i>
                            <span class="text-zinc-500">{{ $tour->days()->count() }} days</span>
                        </div>
                        <div class="me-2">
                            <i class='bx bx-group text-second-color' ></i>
                            <span class="text-zinc-500">{{ $tour->guests }} </span>
                        </div>
                    </div>
                    <a href="{{ route('site.tour_details',$tour->slug) }}" class="text-main-color hover:text-second-color">explore <i class='bx bx-right-arrow-alt bx-tada bx-flip-horizontal' ></i></a>
                </div>
            </figcaption>
        </div>
          @empty
          @endforelse

      </div>
  </div>
</section>
