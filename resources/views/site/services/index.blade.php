@extends('layouts.site.app')

@section('content')


<section class="banner ">
    <div class="container-fluid">
      <figure class="position-relative">
        <figcaption class="position-absolute text-center">
          <div class="text-capitalize">
            <h2 class="text-white h1">                {{$page['content']['header'] ?? "" }}</h2>
            <p class="text-white">
                <a href="{{route('site.home')}}">
                    <span class="textMainColor me-1">{{ __('site.home') }}</span>
                </a>
                >                 {{$page['content']['header'] ?? "" }}
            </p>
          </div>
        </figcaption>
      </figure>
    </div>
  </section>

  <section class="my-5 pt-5 contact">
    <div class="container">
      <div class="row mt-4 pt-4 g-4 justify-content-center">

        <div class="col-lg-7">
          <div
            class="bg-secondary bg-opacity-10 border shadow px-5 py-4 rounded-3 text-center"
          >
          <div>
              <h5 class="pb-1 pe-5 h1 fw-bold">
              {{ __('site.get_in_touch_with_our_lovely_team') }}
            </h5>
            {!! $page['content']['des'] ?? "" !!}
                </div>
            <form class="row" action="{{route('site.con-store')}}" method="POST" id="contact-form">
                @csrf
              <div class="col-12 mt-3">
                <input type="hidden" name="type" value="{{$page?->key}}" >
                <input
                  type="text"
                  name="name"
                  placeholder="{{ __('site.full_name') }}..."
                  class="form-control rounded-pill py-3 ps-4"
                />
              </div>
              <div class="col-12 mt-3">
                <input
                  type="email"
                  name="email"
                  placeholder="{{ __('site.email_address') }}..."
                  class="form-control rounded-pill py-3 ps-4"
                />
              </div>
              <div class="col-12 mt-3">
                <input
                  type="number"
                  name="phone"
                  placeholder="{{ __('site.phone_number') }}..."
                  class="form-control rounded-pill py-3 ps-4"
                />
              </div>
              <div class="col-12 mt-3">
                <input
                  type="text"
                  name="subject"
                  placeholder="{{ __('site.subject') }}..."
                  class="form-control rounded-pill py-3 ps-4"
                />
              </div>
              <div class="col-12 my-3">
                <textarea
                  placeholder="{{ __('site.write_a_message') }}..."
                  name="message"
                  cols="30"
                  rows="5"
                  class="form-control rounded-5 py-3 ps-4 mb-3"
                ></textarea>
              </div>

              <button
                type="submit"
                class="mainBtn rounded-pill py-2 text-white text-capitalize"
              >
                <i class="fa-regular fa-paper-plane me-2"></i>
                {{ __('site.send_message_now') }}
              </button>
            </form>
          </div>
        </div>
      </div>


    </div>
  </section>
@endsection

@push('js')
  <script>
      $('#contact-form').on('submit', function(e) {
                  e.preventDefault()
                  axios.post($(this).attr('action'), $(this).serialize()).then((res) => {
                      toastr.success(res.data.message);
                      setTimeout(() => {
                        toastr.success(res.data.message2);
                      }, 1500);
                      setTimeout(() => {
                        window.location.reload()
                    }, 3000);

                  }).catch(error => {
                      console.log(error);
                      if(error.response.data.message){
                          toastr.error(error.response.data.message ?? '{{ __('main.unexpected-error') }}')
                      }else{
                          toastr.error(error.response.data.error ?? '{{ __('main.unexpected-error') }}')
                      }
                  }).finally()
              })
  </script>
  @endpush
