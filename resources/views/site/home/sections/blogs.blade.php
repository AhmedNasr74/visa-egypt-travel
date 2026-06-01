<section class="my-20">
  <div class="container">
      <!-- section title -->
       <div class="between" data-aos="fade-up">

           <div>
               <span class="text-2xl font-dancingFont text-second-color capitalize ">{{ __('site.from_the_blog_post') }}</span>
               <h2 class="text-3xl sm:text-5xl font-semibold capitalize max-[500px]:text-xl">{{ __('site.news_articles') }}</h2>
           </div>

           <a href="#" role="button" class="mainBtn uppercase max-[500px]: max-[500px]:text-sm">{{ __('site.view_all_posts') }}</a>
       </div>

       <div data-aos-delay="150" class="newsSlider owl-carousel owl-theme grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-11">
            @forelse ($blogs as $blog )
            <div class="border rounded-md h-full" data-aos="flip-right">
              <figure class="rounded-md overflow-hidden relative">
                  <a href="#">
                      <img src="{{ $blog->featured_image }}" class="w-full imageAnimation"  alt="{{ $blog->title }}">
                  </a>
                  <div class=" absolute bottom-0 right-0 text-center font-bold px-3 py-1 rounded-s-md transition-time size-14 uppercase hover:bg-main-color bg-second-color text-white">
                    {{ $blog->created_at->format('d') }}<br>{{ $blog->created_at->format('M') }}
                  </div>
              </figure>

              <figcaption class="capitalize p-4 hover:shadow-lg transition-time">
                  <div class="flex items-center">
                      {{-- <div class="me-3">
                          <i class='bx bx-user-circle text-second-color'></i>
                          <span class="text-zinc-500 uppercase ">{{ __('site.admin') }}</span>
                      </div> --}}
                      <div class="me-3">
                          <i class='bx bx-message-rounded-dots text-second-color' ></i>
                          @php
                        $count = ($blog->id * 23) % 500 + 1;
                        @endphp
                          <span class="text-zinc-500 uppercase ">{{ $count }} {{ __('site.comments') }}</span>
                      </div>
                  </div>
                  <a href="{{ route('site.blog-details',$blog->id) }}">
                      <h3 class="text-xl text-main-color hover:text-second-color font-semibold">{{ $blog->title }}</h3>
                  </a>
                  <p class="my-3 text-zinc-500">
                    {{substr(strip_tags($blog->description), 0, 100) }}.....</p>
                  <a href="{{ route('site.blog-details',$blog->id) }}" class="hover:text-main-color text-second-color uppercase ">{{ __('site.read_more') }} <i class='bx bx-right-arrow-alt bx-tada bx-flip-horizontal' ></i></a>
              </figcaption>
          </div>
          
          
            @empty
              
            @endforelse
      </div>
  </div>
</section>
<div class="text-center">
    <span class="text-2xl font-dancingFont text-second-color capitalize">{{ __('site.our') }}</span>
    <h2 class="text-3xl sm:text-5xl font-semibold capitalize max-[500px]:text-xl">{{ __('site.partners') }}</h2>
</div>
