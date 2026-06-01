@extends('layouts.site.app')

@section('content')
<section class="banner">
    <div class="container-fluid">
      <figure class="position-relative">
        <!-- <img
            src="./images/banner.png"
            class="w-100 h-75"
            alt="about us banner image"
          /> -->
        <figcaption class="position-absolute">
          <div class="text-capitalize">
            <h2 class="text-white h1">gallery</h2>
            <p class="text-white">
              <span class="textMainColor me-1">{{ __('main.home') }}</span>
              > gallery
            </p>
          </div>
        </figcaption>
      </figure>
    </div>
  </section>


  <section class="my-5 pt-5 mainGallery">
    <div class="container">
      <div class="row g-3">
        @if ($gallery)
        @foreach ($gallery as $index=>$pic )
        <div class="col-lg-4 col-md-6">
          <figure class="mb-0 rounded-3 overflow-hidden h-100">
            <img src="{{$pic}}" class="w-100 h-100" />
        </figure>
    </div>
    @endforeach
        @endif
        </div>
      </div>
  </section>



@endsection
