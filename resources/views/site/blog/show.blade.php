@extends('layouts.site.app')

@section('content')

<section>
  <div
    class="capitalize flex justify-between px-4 h-[50vh] bg-[url('../image/cruise.webp')] bg-cover bg-center bg-no-repeat"
  >
    <span class="self-center text-4xl font-semibold text-white">{{ __('site.nile_cruise_details') }}</span>

    <!-- Breadcrumb -->
    <nav
      class="flex self-end px-5 py-3 text-gray-700 border border-gray-200 rounded-t-lg bg-white"
      aria-label="Breadcrumb"
    >
      <ol
        class="inline-flex flex-wrap items-center space-x-1 md:space-x-2 rtl:space-x-reverse"
      >
        <li class="inline-flex items-center">
          <a
            href="{{ route('site.home') }}"
            class="inline-flex items-center text-sm font-medium text-main-color hover:text-second-color"
          >
            <svg
              class="w-3 h-3 me-2.5"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              viewBox="0 0 20 20"
            >
              <path
                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"
              />
            </svg>{{ __('site.home') }}</a>
        </li>
        <li aria-current="page">
          <div class="flex items-center">
            <svg
              class="rtl:rotate-180 w-3 h-3 mx-1 text-main-color"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 6 10"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m1 9 4-4-4-4"
              />
            </svg>
            <span class="ms-1 text-sm font-medium text-second-color md:ms-2"
              >{{ $blog->title }}</span
            >
          </div>
        </li>
      </ol>
    </nav>
  </div>
</section>

<!-- blog -->
<section class="my-20">
    <div class="container">
        <div class="grid gap-8 grid-cols-1 lg:grid-cols-[minmax(0,1fr)_33%]">
            <div>
                <figure class="overflow-hidden rounded-md"><img src="{{ $blog->featured_image }}" class="w-full h-full imageAnimation" loading="lazy" alt="tour image"></figure>
                <figcaption class="pt-6 pb-11 border-b ">
                    <div class="flex items-center">
                        <div class="me-4 text-zinc-500">
                            <i class='bx bx-user text-second-color'></i>
                            <span class="capitalize">{{ __('site.admin') }}</span>
                        </div>
                        <div class="me-4 text-zinc-500">
                            <i class='bx bx-folder-open text-second-color'></i>
                            <span class="capitalize">{{ $blog->title }}</span>
                        </div>
                    </div>

                </figcaption>

                <!-- tags -->
                 <div class="my-5">
                    <div class="between flex-wrap gap-4">
                        <div class="flex">
                            <span class="font-semibold text-2xl capitalize">{{ __('site.tags') }}:</span>
                            <ul class="flex flex-wrap ms-3 ">

                              @foreach (Str::of($blog->tags)->explode(',') as $tag)
                              <a href="#"> <li class="mainBtn mb-2 px-2 py-1 me-1">{{ \Str::of($tag)->remove('•') }}</li> </a>
                          @endforeach
                              
                        </ul>
                        </div>

                        <ul
                            class="list-none flex flex-wrap text-lg font-semibold lg:justify-end justify-center"
                        >
                            <li
                            class="bg-ba4-color hover:text-white hover:bg-second-color size-8 center rounded-full transition-time hover:scale-110 me-2"
                            >
                            <a href="#" class=" text-xl"
                                ><i class="bx bxl-whatsapp"></i
                            ></a>
                            </li>
                            <li
                            class="bg-ba4-color hover:text-white hover:bg-second-color size-8 center rounded-full transition-time hover:scale-110 me-2"
                            >
                            <a href="#" class=" text-xl"
                                ><i class="bx bxl-facebook-circle"></i
                            ></a>
                            </li>
                            <li
                            class="bg-ba4-color hover:text-white hover:bg-second-color size-8 center rounded-full transition-time hover:scale-110 me-2"
                            >
                            <a href="#" class=" text-xl"
                                ><i class="bx bxl-twitter"></i
                            ></a>
                            </li>
                            <li
                            class="bg-ba4-color hover:text-white hover:bg-second-color size-8 center rounded-full transition-time hover:scale-110 me-2"
                            >
                            <a href="#" class=" text-xl"
                                ><i class="bx bxl-linkedin"></i
                            ></a>
                            </li>
                        </ul>

                    </div>

                        <div>
                            <div class="w-11 h-1 my-2 bg-second-color"></div>
                              {!!   $blog->description !!}
                        </div>
                 </div>

                 <!-- reviews -->
                  <div class="my-5">
                    <h5 class="text-2xl font-semibold ">{{ __('site.thoughts_on_article') }}</h5>
                    <div class="w-20 h-[1px] bg-second-color my-2"></div>

                    <!-- one review  -->
                    <div class="py-8 border-b">
                        @forelse ($blog->comments as $comment )
                          
                        <div class="flex">

                          <figure class="flex-shrink-0 overflow-hidden rounded-full size-14 sm:size-20 me-5"><img src="{{ asset("assets/site/img/testimonial-2.jpg") }}" class="size-full imageAnimation" alt="user image"></figure>
                          <div class="between items-start sm:text-base text-sm ">
                              <div>
                                  <h6 class="font-bold mb-2">{{ __('site.admin') }}</h6>
                                  <span class="text-zinc-400">{{ $comment->created_at->format("d/m/Y") }}</span>
                                  <p class="text-zinc-500 my-3">
                                    {{ $comment->comment }}
                                  </p>
                              </div>
                          </div>
                        </div>
                        @empty
                        <p>{{ __('site.no_comments_yet') }}</p>
                        @endforelse
                     </div>
                     {{-- <div class="my-8">
                        <h5 class="capitalize font-semibold text-2xl">{{ __('site.add_comment') }}</h5>
                        <div class="w-20 h-[1px] bg-second-color my-2"></div>

                        <p class="text-zinc-500 my-4">{{ __('site.must_be_logged_in_to_comment') }} <a href="login.html" class="text-second-color hover:text-main-color">{{ __('site.logged_in') }}</a> {{ __('site.to_post_comment') }}.</p>
                     </div> --}}
                  </div>
            </div>

            <!-- side bar -->
            <div>  
                <!-- posts -->
                <div class="border rounded-md p-5 mb-7">
                    <h5 class="capitalize font-semibold text-2xl border-s-2 border-second-color ps-2">{{ __('site.recent_posts') }}</h5>

                    <!-- tours -->
                     <div class="mt-8 ">

                        @forelse ($last_blogs as $blog )
                        <div class="flex mb-5">
                          <figure class="overflow-hidden rounded-md h-20 me-3"><img src="{{ $blog->featured_image }}" class="size-full imageAnimation" alt="tour image"></figure>
                          <figcaption>
                              <div>
                                  <i class='bx bx-message-rounded-dots'></i>
                                  <span class="text-zinc-500">{{ $blog->comments()->count() }} {{ __('site.comments') }}</span>
                              </div>
                              <a href="{{ route('site.blog-details',$blog->id) }}" class="font-bold capitalize hover:text-second-color">{{ $blog->title }}</a>
                          </figcaption>
                      </div>
                     
                        @empty
                        <p>{{ __('site.no_posts_available') }}</p>
                        
                          
                        @endforelse

                     </div>
                </div>

                <!-- tags -->
                <div class="border rounded-md p-5 mb-7">
                    <h5 class="capitalize font-semibold text-2xl border-s-2 border-second-color ps-2">{{ __('site.tags') }}</h5>

                    <!-- tags -->
                     <div class=" flex flex-wrap mt-6 ">
                      @foreach (Str::of($blog->tags)->explode(',') as $tag)
                      <a href="#"> <li class="mainBtn mb-2 px-2 py-1 me-1">{{ \Str::of($tag)->remove('•') }}</li> </a>
                  @endforeach
                     </div>
                </div>

               

            </div>
        </div>
    </div>
</section>
@endsection
@push('js')

@endpush
