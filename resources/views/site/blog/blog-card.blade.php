@php
    $blog = $blog ?? $blog ?? null;
@endphp
<div class="border rounded-md h-full">
    <figure class="rounded-md overflow-hidden relative">
        <a href="{{ route("site.blog-details",$blog->id) }}">
            <img src="{{ $blog->featured_image }}" class="w-full imageAnimation"
                 alt="tour image">
        </a>
        <div
            class=" absolute bottom-0 right-0 text-center font-bold px-3 py-1 rounded-s-md transition-time size-14 uppercase hover:bg-main-color bg-second-color text-white">
            08<br> dec
        </div>
    </figure>

    <figcaption class="capitalize p-4 hover:shadow-lg transition-time">
        <div class="flex items-center lg:text-[13px] xl:text-sm">
            <div class="me-3">
                <i class='bx bx-user-circle text-second-color'></i>
                <span class="text-zinc-500 uppercase ">{{ __('site.admin') }}</span>
            </div>
            <div class="me-3">
                <i class='bx bx-message-rounded-dots text-second-color'></i>
                <span class="text-zinc-500 uppercase ">{{ $blog->comments()->count() }} {{ __('site.comments') }}</span>
            </div>
        </div>
        <a href="{{ route("site.blog-details",$blog->id) }}">
            <h3 class="text-xl text-main-color hover:text-second-color font-semibold">{{ $blog->title }}</h3>

        </a>
        <p class="my-3 text-zinc-500">
            {{substr(strip_tags($blog->description), 0, 100) }}.....</p>
        <a href="{{ route("site.blog-details",$blog->id) }}"
           class="hover:text-main-color text-second-color uppercase ">{{ __('site.read_more') }} <i
                class='bx bx-right-arrow-alt bx-tada bx-flip-horizontal'></i></a>
    </figcaption>
</div>
