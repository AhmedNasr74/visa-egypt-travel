@extends('layouts.site.app')

@section('content')

    <!-- categories -->
    <section class="my-20">
        <div class="container">
            <!-- section title -->
            <div class="text-center" data-aos="fade-up">
                <span class="text-2xl font-dancingFont text-second-color capitalize ">{{ __('site.categories_lists') }}</span>
                <h2 class="text-3xl sm:text-5xl font-semibold capitalize">{{ __('site.go_exotic_places') }}</h2>
            </div>

            <div class="grid md:grid-cols-4 grid-cols-1 gap-4 my-11">
              
                @forelse ($category->children as $i=>$child_category)

                    <a href="{{ route('site.package',$child_category->slug ?? $child_category->id) }}"
                       data-aos="{{ $i%2 ? 'fade-right' : 'fade-left' }}"
                        @class(['col-span-2' => !in_array($i, [0, 2, 4 , 5, 6, 8])])>

                        <figure class="h-60 relative rounded-md overflow-hidden">
                            <img
                                src="{{ $child_category->featured_image ?? asset('assets/site/img/placeholders.jpg') }}"
                                class="w-full h-full imageAnimation" alt="{{ __('site.tour_image') }}">
                            <span
                                class="absolute top-2 right-2 uppercase bg-second-color text-white px-2 rounded-md hover:bg-main-color"><b
                                    class="me-1">{{ $child_category->tours_count }}</b>{{ __('site.tours') }}</span>
                            <div class="absolute bottom-4 left-4 capitalize">
                                <h3 class="text-xl text-white  font-bold">{{ $child_category->title }}</h3>
                            </div>
                        </figure>
                    </a>
                @empty

                @endforelse


            </div>

            <div class="p-4 bg-white d-flex justify-between">
                <span style="font-size: 24px" class="font-semibold text-base text-gray-700 mb-2">
                    <i class="fa fa-question-circle me-2 text-main-color"></i>
                    {{ __('site.learn_more_before_you_travel') }}
                </span>

                <a class="" href="{{ route('site.custom-trip') }}">
                    <button class="mainBtn">{{ __('site.tailor_made_your_trip') }}</button>
                </a>

            </div>
            @include('site.home.sections.offers')

            <!-- <div class="between">
                <div>
                    <span class="text-2xl font-dancingFont text-second-color capitalize ">{{ __('site.from_the_blog_post') }}</span>
                    <h2 class="text-3xl sm:text-5xl font-semibold capitalize max-[500px]:text-xl">{{ __('site.news_articles') }}</h2>
                </div>
                <a href="{{ route('site.blog') }}" role="button" class="mainBtn uppercase max-[500px]: max-[500px]:text-sm">{{ __('site.view_all_posts') }}</a>
            </div>

            <div class=" grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-11">
                @forelse ($blogs as $blog )
                    @include('site.blog.blog-card', ['blog' => $blog])
                @empty
                @endforelse
            </div> -->
        </div>
    </section>
@endsection
