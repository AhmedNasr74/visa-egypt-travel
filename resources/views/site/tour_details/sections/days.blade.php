<!-- tour itinerary -->
<div id="itinerary" class="my-7">
    <h2 class="text-2xl capitalize font-semibold text-main-color">
        <i class="bx bx-trip me-2"></i>
        {{ __('site.tour_itinerary') }}
    </h2>

    @forelse ($days as $i=>$day )
        <div class="itinerary my-4 shadow-lg rounded-md">
            <div
                class="itineraryHead bg-main-color rounded-md capitalize p-2 px-3 cursor-pointer flex items-center justify-between">
                <span class="text-white text-lg">{{ __('site.day') }} {{ $i+1 }}: {{ $day->title }}</span>
                <i class="bx bx-chevron-down text-yellow-400 text-3xl"></i>
            </div>

            <div class="itineraryDesc {{ $loop->first ? '' : 'hidden' }} p-4">
                @if($day->tour_day_image)
                    <figure class="rounded-md overflow-hidden h-[250px] mb-0">
                        <img src="{{ $day->tour_day_image }}" class="w-full h-full" alt="{{ __('site.tour_image') }}"/>
                    </figure>
                @endif

                <p>
                    {!! $day->description !!}
                </p>

                <hr/>

            </div>
        </div>

    @empty

    @endforelse


    {{--                <div class="bg-zinc-200 p-3 rounded-sm">--}}
    {{--                  <p class="border-s-8 border-red-700 border-solid ps-4">--}}
    {{--                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.--}}
    {{--                    Veritatis, enim consectetur voluptates aliquam illo tempora--}}
    {{--                    officia quam aspernatur sequi odio commodi dolores.--}}
    {{--                  </p>--}}
    {{--                </div>--}}

    {{--                <hr />--}}
</div>
