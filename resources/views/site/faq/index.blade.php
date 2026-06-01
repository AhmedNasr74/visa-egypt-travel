@extends('layouts.site.app')

@section('content')

    <!-- banner  -->
    <section>
      <div
        class="capitalize flex justify-between px-4 h-[50vh] bg-[url('../image/Faq.jpg')] bg-cover bg-center bg-no-repeat"
      >
        <span class="self-center text-4xl font-semibold text-white"
          >FAQs</span
        >

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
                </svg>
                Home
              </a>
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
                  >FAQs</span
                >
              </div>
            </li>
          </ol>
        </nav>
      </div>
    </section>

    <!-- faq -->
    <section class="my-20">
      <div class="container">
        <div id="accordion-color" data-accordion="collapse" data-active-classes="bg-main-color text-white">

          @foreach ($faqs as $i=>$faq )
          <div class="border border-gray-200 rounded-lg overflow-hidden mb-5">
            <h2 id="accordion-color-heading-{{ $i+1 }}">
            <button type="button" class="flex items-center justify-between w-full p-4 font-medium rtl:text-right text-gray-500  bg-main-color  gap-3" data-accordion-target="#accordion-color-body-{{ $i+1 }}" aria-expanded="true" aria-controls="accordion-color-body-{{ $i+1 }}">
                <span><i class='bx bx-question-mark me-2 text-xl'></i> {{ strip_tags($faq->question) }}</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
            </button>
            </h2>
            <div id="accordion-color-body-{{ $i+1 }}" class="hidden" aria-labelledby="accordion-color-heading-{{ $i+1 }}">
            <div class="p-5 ">
                <p class="mb-2 text-zinc-500 ">
                  {{ strip_tags($faq->answer) }}
                </p>
                </div>
            </div>
        </div>

          @endforeach


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
            >Plan your trip with us</span
          >
          <h2 class="text-3xl sm:text-5xl font-semibold capitalize text-white">
            Ready for an unforgetable tour?
          </h2>
        </div>

        <a href="#" class="mainBtn uppercase"> book tour now</a>
      </div>
    </section>

   <!-- ========================= End Day Tour Section ============ -->
@endsection
