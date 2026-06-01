
@extends('layouts.site.app')

@section('content')

<section class="banner">
    <div class="container-fluid">
      <figure class="position-relative">
        <figcaption class="position-absolute">
          <div class="text-capitalize text-center">
            <h2 class="text-white h1">{{ __('site.room_listing') }}</h2>
            <p class="text-white">
              <span class="textMainColor me-1">{{ __('site.home') }}</span>
              > {{ __('site.room_listing') }}
            </p>
          </div>
        </figcaption>

        <form
        class="row bg-white bg-opacity-75 shadow rounded-3  py-3 mt-5 justify-content-evenly "
      >
        <div class="col-lg-2">
          <div
            class="desc d-flex justify-content-between align-items-center"
          >
            <div>
              <i class="fa fa-calendar-alt fs-4 mt-2 me-2 textMainColor"></i>
              <label for="checkin" class="fw-bold mb-1 textMainColor"
                >{{ __('site.check_in') }}</label
              >
            </div>
            <div class="py-2 pt-0">
              <input
                id="checkin"
                name="checkin"
                value=""
                type="date"
                class="border-0 bg-transparent cPointer form-control"
              />
            </div>
          </div>
        </div>

        <div class="col-lg-2">
          <div
            class="desc d-flex justify-content-between align-items-center"
          >
            <div>
              <i class="fa fa-calendar-alt fs-4 mt-2 me-2 textMainColor"></i>
              <label for="checkout" class="fw-bold mb-1 textMainColor"
                >{{ __('site.check_out') }}</label
              >
            </div>
            <div class=" py-2 pt-0">
              <input
                id="checkout"
                name="checkout"
                value=""
                type="date"
                class="border-0 bg-transparent cPointer form-control"
              />
            </div>
          </div>
        </div>

        <div class="col-lg-2">
          <div
            class="desc d-flex justify-content-between flex-wrap align-items-center"
          >
            <div>
              <i class="fa fa-people-group fs-4 mt-2 pt-1 textMainColor"></i>
              <span class="fw-bold mb-1 ms-2 textMainColor">{{ __('site.guests') }}</span>
            </div>
            <div class=" py-2 pt-0">
              <div class="personNum cPointer text-center pt-2">
                <input
                    type="text"
                    id="totalPerson"
                    name="totalPerson"
                    value="7"
                    class="totalPerson fw-bold w-20 bg-transparent border-0"
                  />
                <span class="">{{ __('site.persons') }}
                    <i class="fa fa-angle-down ms-1"></i>
                </span>
              </div>

              <div class="subMenu shadow p-2 rounded-3 d-none">
                <div class="d-flex justify-content-between">
                  <span>{{ __('site.adult') }}</span>
                  <div class="adult d-flex ms-3">
                    <i
                      class="fa fa-minus cPointer border border-secondary p-1 rounded-3 me-1"
                    ></i>
                    <input
                      id="adultPerson"
                      type="num"
                      name="adultPerson"
                      value="3"
                      class="border-0 bg-transparent me-1 text-center fw-bold"
                    />
                    <i
                      class="fa fa-plus cPointer border border-secondary p-1 rounded-3 me-1"
                    ></i>
                  </div>
                </div>
                <hr class="px-3" />
                <div class="child d-flex justify-content-between">
                  <span>{{ __('site.childrens') }}</span>
                  <div class="d-flex ms-3">
                    <i
                      class="fa fa-minus cPointer border border-secondary p-1 rounded-3 me-1"
                    ></i>
                    <input
                      id="childPerson"
                      type="num"
                      name="childPerson"
                      value="3"
                      class="border-0 bg-transparent me-1 text-center fw-bold"
                    />
                    <i
                      class="fa fa-plus cPointer border border-secondary p-1 rounded-3 me-1"
                    ></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-2">
          <div
            class="desc d-flex justify-content-between flex-wrap align-items-center"
          >
            <div>
              <i class="fa fa-key fs-4 mt-2 pt-1 textMainColor"></i>
              <span class="fw-bold mb-1 ms-2 textMainColor">{{ __('site.rooms') }}</span>
            </div>
            <div class=" py-2 pt-0">

              <div class="getRoomsBaths d-flex ms-3 mt-1">
                  <i
                    class="fa fa-minus cPointer border border-secondary p-1 rounded-3 me-1"
                  ></i>
                  <input
                    id="roomsNum"
                    type="num"
                    name="roomsNum"
                    max=""
                    min="0"
                    value="1"
                    class="border-0 bg-transparent me-1 text-center fw-bold"
                  />
                  <i
                    class="fa fa-plus cPointer border border-secondary p-1 rounded-3 me-1"
                  ></i>
                </div>


            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div
            class="desc d-flex justify-content-between flex-wrap align-items-center"
          >
            <div>
              <i class="fa fa-bath fs-4 mt-2 pt-1 textMainColor"></i>
              <span class="fw-bold mb-1 ms-2 textMainColor">{{ __('site.baths') }}</span>
            </div>
            <div class="py-2 pt-0">

              <div class="getRoomsBaths d-flex ms-3 mt-1">
                  <i
                    class="fa fa-minus cPointer border border-secondary p-1 rounded-3 me-1"
                  ></i>
                  <input
                    id="bathsNum"
                    type="num"
                    name="bathsNum"
                    max=""
                    min="0"
                    value="1"
                    class="border-0 bg-transparent me-1 text-center fw-bold"
                  />
                  <i
                    class="fa fa-plus cPointer border border-secondary p-1 rounded-3 me-1"
                  ></i>
                </div>


            </div>
          </div>
        </div>

        <div class="col-lg-2">
          <div class="d-flex justify-content-center ">
            <div class="p-2">
              <button type="submit" class="btn mainBtn">
                <i class="fa fa-magnifying-glass"></i>
                {{ __('site.search') }}
              </button>
            </div>
          </div>
        </div>
      </form>

      </figure>
    </div>
  </section>

  <section class="pt-5 mt-5 favorite">
    <div class="container pt-5">
      <div class="row mt-4 g-4">
          <div class="col-lg-4 px-3">
            <a href="">
              <figure class="mb-0 position-relative cPointer overflow-hidden hoverImg">
                <img
                  src="{{asset("assets/site/img/post-1.jpg")}}"
                  class="w-100 rounded-2"
                  alt="Favorite room , the best your familly"
                />
                <div class="price shadow rounded-2">
                  <span>{{ __('site.from') }}</span>
                  <span class="textMainColor fw-bold">$140/night</span>
                </div>
              </figure>
              <div class="text-center">
                <h3 class="h4 text-capitalize">{{ __('site.single_room') }}</h3>
                <div>
                  <span class="p-2">
                    <i class="fa fa-bed fs-5 pe-1"></i>
                    <span>2</span>
                  </span>
                  <span class="p-2">
                    <i class="fa fa-ruler-combined fs-5 pe-1"></i>
                    <span>36Sqm</span>
                  </span>
                </div>
                <a
                  href="{{route('site.room_details',$slug=0)}}"
                  class="d-inline-block py-3 fw-semibold text-uppercase width-fit"
                >
                  {{ __('site.book_now') }}
                  <i class="fa fa-angle-right fa-bounce ps-2"></i>
                </a>
              </div>
            </a>
          </div>
          <div class="col-lg-4 px-3">
            <a href="">
              <figure class="mb-0 position-relative cPointer overflow-hidden hoverImg">
                <img
                  src="{{asset("assets/site/img/gallery/gallery-Pool-01.jpg")}}"
                  class="w-100 rounded-2"
                  alt="Favorite room , the best your familly"
                />
                <div class="price shadow rounded-2">
                  <span>{{ __('site.from') }}</span>
                  <span class="textMainColor fw-bold">$140/night</span>
                </div>
              </figure>
              <div class="text-center">
                <h3 class="h4 text-capitalize">{{ __('site.single_room') }}</h3>
                <div>
                  <span class="p-2">
                    <i class="fa fa-bed fs-5 pe-1"></i>
                    <span>2</span>
                  </span>
                  <span class="p-2">
                    <i class="fa fa-ruler-combined fs-5 pe-1"></i>
                    <span>36Sqm</span>
                  </span>
                </div>
                <a
                  href="{{route('site.room_details',$slug=0)}}"
                  class="d-inline-block py-3 fw-semibold text-uppercase width-fit"
                >
                  {{ __('site.book_now') }}
                  <i class="fa fa-angle-right fa-bounce ps-2"></i>
                </a>
              </div>
            </a>
          </div>
          <div class="col-lg-4 px-3">
            <a href="">
              <figure class="mb-0 position-relative cPointer overflow-hidden hoverImg">
                <img
                  src="{{asset("assets/site/img/gallery/gallery-Room-02.jpg")}}"
                  class="w-100 rounded-2"
                  alt="Favorite room , the best your familly"
                />
                <div class="price shadow rounded-2">
                  <span>{{ __('site.from') }}</span>
                  <span class="textMainColor fw-bold">$140/night</span>
                </div>
              </figure>
              <div class="text-center">
                <h3 class="h4 text-capitalize">{{ __('site.single_room') }}</h3>
                <div>
                  <span class="p-2">
                    <i class="fa fa-bed fs-5 pe-1"></i>
                    <span>2</span>
                  </span>
                  <span class="p-2">
                    <i class="fa fa-ruler-combined fs-5 pe-1"></i>
                    <span>36Sqm</span>
                  </span>
                </div>
                <a
                  href="{{route('site.room_details',$slug=0)}}"
                  class="d-inline-block py-3 fw-semibold text-uppercase width-fit"
                >
                  {{ __('site.book_now') }}
                  <i class="fa fa-angle-right fa-bounce ps-2"></i>
                </a>
              </div>
            </a>
          </div>
          <div class="col-lg-4 px-3">
            <a href="">
              <figure class="mb-0 position-relative cPointer overflow-hidden hoverImg">
                <img
                  src="{{asset("assets/site/img/bt3.jpg")}}"
                  class="w-100 rounded-2"
                  alt="Favorite room , the best your familly"
                />
                <div class="price shadow rounded-2">
                  <span>{{ __('site.from') }}</span>
                  <span class="textMainColor fw-bold">$140/night</span>
                </div>
              </figure>
              <div class="text-center">
                <h3 class="h4 text-capitalize">{{ __('site.single_room') }}</h3>
                <div>
                  <span class="p-2">
                    <i class="fa fa-bed fs-5 pe-1"></i>
                    <span>2</span>
                  </span>
                  <span class="p-2">
                    <i class="fa fa-ruler-combined fs-5 pe-1"></i>
                    <span>36Sqm</span>
                  </span>
                </div>
                <a
                  href="{{route('site.room_details',$slug=0)}}"
                  class="d-inline-block py-3 fw-semibold text-uppercase width-fit"
                >
                  {{ __('site.book_now') }}
                  <i class="fa fa-angle-right fa-bounce ps-2"></i>
                </a>
              </div>
            </a>
          </div>
          <div class="col-lg-4 px-3">
            <a href="">
              <figure class="mb-0 position-relative cPointer overflow-hidden hoverImg">
                <img
                  src="{{asset("assets/site/img/gallery/gallery-Pool-03.jpg")}}"
                  class="w-100 rounded-2"
                  alt="Favorite room , the best your familly"
                />
                <div class="price shadow rounded-2">
                  <span>{{ __('site.from') }}</span>
                  <span class="textMainColor fw-bold">$140/night</span>
                </div>
              </figure>
              <div class="text-center">
                <h3 class="h4 text-capitalize">{{ __('site.single_room') }}</h3>
                <div>
                  <span class="p-2">
                    <i class="fa fa-bed fs-5 pe-1"></i>
                    <span>2</span>
                  </span>
                  <span class="p-2">
                    <i class="fa fa-ruler-combined fs-5 pe-1"></i>
                    <span>36Sqm</span>
                  </span>
                </div>
                <a
                  href="{{route('site.room_details',$slug=0)}}"
                  class="d-inline-block py-3 fw-semibold text-uppercase width-fit"
                >
                  {{ __('site.book_now') }}
                  <i class="fa fa-angle-right fa-bounce ps-2"></i>
                </a>
              </div>
            </a>
          </div>
          <div class="col-lg-4 px-3">
            <a href="">
              <figure class="mb-0 position-relative cPointer overflow-hidden hoverImg">
                <img
                  src="{{asset("assets/site/img/gallery/gallery-Pool-02.jpg")}}"
                  class="w-100 rounded-2"
                  alt="Favorite room , the best your familly"
                />
                <div class="price shadow rounded-2">
                  <span>{{ __('site.from') }}</span>
                  <span class="textMainColor fw-bold">$140/night</span>
                </div>
              </figure>
              <div class="text-center">
                <h3 class="h4 text-capitalize">{{ __('site.single_room') }}</h3>
                <div>
                  <span class="p-2">
                    <i class="fa fa-bed fs-5 pe-1"></i>
                    <span>2</span>
                  </span>
                  <span class="p-2">
                    <i class="fa fa-ruler-combined fs-5 pe-1"></i>
                    <span>36Sqm</span>
                  </span>
                </div>
                <a
                  href="{{route('site.room_details',$slug=0)}}"
                  class="d-inline-block py-3 fw-semibold text-uppercase width-fit"
                >
                  {{ __('site.book_now') }}
                  <i class="fa fa-angle-right fa-bounce ps-2"></i>
                </a>
              </div>
            </a>
          </div>
          <div class="col-lg-4 px-3">
            <a href="">
              <figure class="mb-0 position-relative cPointer overflow-hidden hoverImg">
                <img
                  src="{{asset("assets/site/img/gallery/gallery-Spa-01.jpg")}}"
                  class="w-100 rounded-2"
                  alt="Favorite room , the best your familly"
                />
                <div class="price shadow rounded-2">
                  <span>{{ __('site.from') }}</span>
                  <span class="textMainColor fw-bold">$140/night</span>
                </div>
              </figure>
              <div class="text-center">
                <h3 class="h4 text-capitalize">{{ __('site.single_room') }}</h3>
                <div>
                  <span class="p-2">
                    <i class="fa fa-bed fs-5 pe-1"></i>
                    <span>2</span>
                  </span>
                  <span class="p-2">
                    <i class="fa fa-ruler-combined fs-5 pe-1"></i>
                    <span>36Sqm</span>
                  </span>
                </div>
                <a
                  href="{{route('site.room_details',$slug=0)}}"
                  class="d-inline-block py-3 fw-semibold text-uppercase width-fit"
                >
                  {{ __('site.book_now') }}
                  <i class="fa fa-angle-right fa-bounce ps-2"></i>
                </a>
              </div>
            </a>
          </div>
          <div class="col-lg-4 px-3">
            <a href="">
              <figure class="mb-0 position-relative cPointer overflow-hidden hoverImg">
                <img
                  src="{{asset("assets/site/img/gallery/gallery-Spa-04.jpg")}}"
                  class="w-100 rounded-2"
                  alt="Favorite room , the best your familly"
                />
                <div class="price shadow rounded-2">
                  <span>{{ __('site.from') }}</span>
                  <span class="textMainColor fw-bold">$140/night</span>
                </div>
              </figure>
              <div class="text-center">
                <h3 class="h4 text-capitalize">{{ __('site.single_room') }}</h3>
                <div>
                  <span class="p-2">
                    <i class="fa fa-bed fs-5 pe-1"></i>
                    <span>2</span>
                  </span>
                  <span class="p-2">
                    <i class="fa fa-ruler-combined fs-5 pe-1"></i>
                    <span>36Sqm</span>
                  </span>
                </div>
                <a
                  href="{{route('site.room_details',$slug=0)}}"
                  class="d-inline-block py-3 fw-semibold text-uppercase width-fit"
                >
                  {{ __('site.book_now') }}
                  <i class="fa fa-angle-right fa-bounce ps-2"></i>
                </a>
              </div>
            </a>
          </div>
          <div class="col-lg-4 px-3">
            <a href="">
              <figure class="mb-0 cPointer overflow-hidden">
                <img
                  src="{{asset("assets/site/img/gallery/gallery-Spa-06.jpg")}}"
                  class="w-100 rounded-2"
                  alt="Favorite room , the best your familly"
                />
                <div class="price shadow rounded-2">
                  <span>{{ __('site.from') }}</span>
                  <span class="textMainColor fw-bold">$140/night</span>
                </div>
              </figure>
              <div class="text-center">
                <h3 class="h4 text-capitalize">{{ __('site.single_room') }}</h3>
                <div>
                  <span class="p-2">
                    <i class="fa fa-bed fs-5 pe-1"></i>
                    <span>2</span>
                  </span>
                  <span class="p-2">
                    <i class="fa fa-ruler-combined fs-5 pe-1"></i>
                    <span>36Sqm</span>
                  </span>
                </div>
                <a
                  href="{{route('site.room_details',$slug=0)}}"
                  class="d-inline-block py-3 fw-semibold text-uppercase width-fit"
                >
                  {{ __('site.book_now') }}
                  <i class="fa fa-angle-right fa-bounce ps-2"></i>
                </a>
              </div>
            </a>
          </div>
        </div>
    </div>
  </section>
<section class="pb-5 newsletter shadow">
    <div class="container">
        <div class="content p-5 px-3 text-center rounded-3">
            <h3 class="h2 fw-bold text-capitalize">
                {{ __('site.sign_up_to_get_our_pro_offers') }}
            </h3>
            <p class="my-3 px-5 text-muted">
                {{ __('site.accumsan_sit_amet_nulla_facilisi_morbi_tempus_suscipit_tellus_mauris_a_diam_maecenas_sed_enim_ut_sem') }}
            </p>
            <form action="{{ route('site.subs') }}" method="POST" id="newsletter" class="d-flex mb-2 w-75 mx-auto">
                @csrf
                <input
                    class="form-control me-2 rounded-pill"
                    type="email"
                    name="email"
                    placeholder="{{ __('site.type_your_email_here') }}"
                />
                <button
                    class="mainBtn position-relative rounded-pill"
                    type="submit"
                    id="newsletter-btn"
                >
                    {{ __('site.send') }}
                </button>
            </form>
        </div>
    </div>
</section>


  @endsection

  @push('js')
  <script>
      $(document).ready(function() {
          $('#newsletter').off('submit').on('submit', function(e) {
              e.preventDefault();

              axios.post($(this).attr('action'), $(this).serialize())
                  .then((res) => {
                      toastr.success(res.data.message);
                  })
                  .catch(error => {
                      console.log(error);
                      if (error.response && error.response.data && error.response.data.error) {
                          toastr.error(error.response.data.error ?? '{{ __('main.unexpected-error') }}')
                      } else {
                          toastr.error('{{ __('main.unexpected-error') }}')
                      }
                  });
          });
      });
  </script>
  @endpush

