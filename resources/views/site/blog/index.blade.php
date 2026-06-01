@extends('layouts.site.app')

@section('content')
    <!-- News & Articles -->
    <section class="my-20">
        <div class="container">
            <!-- section title -->
            <div class="text-center" data-aos="fade-up">
                <span class="text-2xl font-dancingFont text-second-color capitalize ">{{ __('site.categories_lists') }}</span>
                <h2 class="text-3xl sm:text-5xl font-semibold capitalize max-[500px]:text-xl">{{ __('site.news_articles') }}</h2>
            </div>

            <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-11">
                @forelse ($blogs as $blog )
                    @include('site.blog.blog-card', ['blog' => $blog])
                @empty
                @endforelse
            </div>
        </div>
    </section>

    <!-- plan your trip -->
    <section
            class="mt-20 bg-black/80 py-14 bg-[url('../image/bg-line.png')] bg-center bg-cover bg-no-repeat"
    >
        <div class="container flex flex-wrap gap-6 justify-between items-center">
            <!-- section title -->
            <div>
      <span class="text-2xl font-dancingFont text-second-color capitalize"
      >{{ __('site.plan_your_trip_with_us') }}</span
      >
                <h2 class="text-3xl sm:text-5xl font-semibold capitalize text-white">
                    {{ __('site.ready_for_an_unforgettable_tour') }}
                </h2>
            </div>

            <a href="{{ route('site.day-tours') }}" class="mainBtn uppercase">{{ __('site.book_tour_now') }}</a>
        </div>
    </section>

@endsection
@push('js')

@endpush
