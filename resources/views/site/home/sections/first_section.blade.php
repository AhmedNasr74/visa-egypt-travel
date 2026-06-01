   <!-- slider section -->
   <section data-aos="zoom-in-down">
      
    <div id="animation-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative  overflow-hidden h-[90vh] ">
            @foreach ($slider as $i=>$img )
              <!-- Item 1 -->
              <div class="hidden duration-1000 ease-in-out h-full"  @if ($i==0)
                  data-carousel-item="active"
                  @else
                  data-carousel-item
                @endif
              >
                <img src="{{ $img }}" class="absolute block w-full  h-full object-cover" alt="slider image">
                <div data-aos="flip-left" class="absolute  capitalize  inset-0 bg-black/35 flex justify-center items-start text-center">
                    <div class=" mt-24 font-bold">
                        <p class="text-second-color text-[45px] sm:text-[55px] md:text-[68px] lg:text-[80px]  font-dancingFont">{{ __('site.travelling_adventure') }}</p>
                        <p class="text-white text-xl md:text-4xl font-semibold sm:text-2xl">{{ __('site.where_would_you_like_to_go') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            
            
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">{{ __('site.previous') }}</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">{{ __('site.next') }}</span>
            </span>
        </button>
    </div>

</section>