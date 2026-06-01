@extends('layouts.site.app')

@section('content')

<section class="banner">
    <div class="container-fluid">
      <figure class="position-relative">
        <figcaption class="position-absolute">
          <div class="text-capitalize text-center">
            <h2 class="text-white h1">{{ __('site.room_details') }}</h2>
            <p class="text-white">
              <span class="textMainColor me-1">{{ __('site.home') }}</span>
              > {{ __('site.room_details') }}
            </p>
          </div>
        </figcaption>
      </figure>
    </div>
  </section>

  <section class="py-5 roomDetails">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-7">
          <div>
            <figure class="rounded-3 overflow-hidden hoverImg">
              <img
                src="{{asset("assets/site/img/gallery/gallery-Room-04.jpg")}}"
                class="w-100 mainImg"
                alt="room details images"
              />
            </figure>
            <figcaption class="d-flex align-items-center">
              <img
                src="{{asset("assets/site/img/gallery/gallery-Room-04.jpg")}}"
                class="subImg rounded-3 w-25 cPointer px-1"
                alt="room details images"
              />
              <img
                src="{{asset("assets/site/img/gallery/gallery-Room-05.jpg")}}"
                class="subImg rounded-3 w-25 cPointer px-1"
                alt="room details images"
              />
              <img
                src="{{asset("assets/site/img/gallery/gallery-Room-06.jpg")}}"
                class="subImg rounded-3 w-25 cPointer px-1"
                alt="room details images"
              />
              <img
                src="{{asset("assets/site/img/gallery/gallery-Room-03.jpg")}}"
                class="subImg rounded-3 w-25 cPointer px-1"
                alt="room details images"
              />
            </figcaption>

            <figcaption class="mt-5">
              <h2 class="dancingFont text-capitalize h1">{{ __('site.overview') }}</h2>
              <p>
                {{ __('site.room_overview_description') }}
              </p>

              <div class="row g-3 mt-2">
                <div class="col-xl-4 col-6">
                  <div>
                    <i
                      class="fa-solid fa-person-dots-from-line fs-5 textMainColor me-2"
                    ></i>
                    <span class="fs-4 text-capitalize">{{ __('site.adults_count', ['count' => 4]) }}</span>
                  </div>
                </div>
                <div class="col-xl-4 col-6">
                  <div>
                    <i
                      class="fa-solid fa-child-dress fs-5 textMainColor me-2"
                    ></i>
                    <span class="fs-4 text-capitalize">{{ __('site.children_count', ['count' => 4]) }}</span>
                  </div>
                </div>
                <div class="col-xl-4 col-6">
                  <div>
                    <i
                      class="fa-solid fa-ruler-combined fs-5 textMainColor me-2"
                    ></i>
                    <span class="fs-4 text-capitalize">{{ __('site.room_size', ['size' => '50 Sqm2']) }}</span>
                  </div>
                </div>
                <div class="col-xl-4 col-6">
                  <div>
                    <i
                      class="fa-solid fa-car-tunnel fs-5 textMainColor me-2"
                    ></i>
                    <span class="fs-4 text-capitalize">{{ __('site.car_parking') }}</span>
                  </div>
                </div>
                <div class="col-xl-4 col-6">
                  <div>
                    <i class="fa-solid fa-bed fs-5 textMainColor me-2"></i>
                    <span class="fs-4 text-capitalize">4 bed</span>
                  </div>
                </div>
                <div class="col-xl-4 col-6">
                  <div>
                    <i class="fa-solid fa-bath fs-5 textMainColor me-2"></i>
                    <span class="fs-4 text-capitalize">4 baths</span>
                  </div>
                </div>
              </div>

              <h2 class="dancingFont text-capitalize h1 mt-5">
                {{ __('site.free_amenities') }}
              </h2>

              <div class="row g-3 mt-2">
                <div class="col-xl-4 col-6">
                  <div>
                    <i
                      class="fa-solid fa-person-dots-from-line fs-5 textMainColor me-2"
                    ></i>
                    <span class="fs-4 text-capitalize">{{ __('site.air_conditioner') }}</span>
                  </div>
                </div>
                <div class="col-xl-4 col-6">
                  <div>
                    <i class="fa-solid fa-tv-alt fs-5 textMainColor me-2"></i>
                    <span class="fs-4 text-capitalize">{{ __('site.big_tv') }}</span>
                  </div>
                </div>
                <div class="col-xl-4 col-6">
                  <div>
                    <i
                      class="fa-solid fa-wifi-strong fs-5 textMainColor me-2"
                    ></i>
                    <span class="fs-4 text-capitalize">{{ __('site.wifi') }}</span>
                  </div>
                </div>
                <div class="col-xl-4 col-6">
                  <div>
                    <i class="fa-solid fa-key fs-5 textMainColor me-2"></i>
                    <span class="fs-4 text-capitalize">{{ __('site.door_key') }}</span>
                  </div>
                </div>
                <div class="col-xl-4 col-6">
                  <div>
                    <i class="fa-solid fa-coffee fs-5 textMainColor me-2"></i>
                    <span class="fs-4 text-capitalize">{{ __('site.coffe_marker') }}</span>
                  </div>
                </div>
                <div class="col-xl-4 col-6">
                  <div>
                    <i
                      class="fa-solid fa-box-tissue fs-5 textMainColor me-2"
                    ></i>
                    <span class="fs-4 text-capitalize">{{ __('site.tissue_box') }}</span>
                  </div>
                </div>
                <div class="col-xl-4 col-6">
                  <div>
                    <i class="fa-solid fa-star fs-5 textMainColor me-2"></i>
                    <span class="fs-4 text-capitalize">{{ __('site.hairdryer') }}</span>
                  </div>
                </div>
                <div class="col-xl-4 col-6">
                  <div>
                    <i
                      class="fa-solid fa-parking fs-5 textMainColor me-2"
                    ></i>
                    <span class="fs-4 text-capitalize">{{ __('site.free_parking') }}</span>
                  </div>
                </div>
              </div>

              <h2 class="dancingFont text-capitalize h1 mt-5">
                {{ __('site.price') }}
              </h2>

              <table class="table table-hover table-striped text-capitalize mt-3 w-100">
                <thead>
                  <tr>
                    <th>{{ __('site.mon') }}</th>
                    <th>{{ __('site.tus') }}</th>
                    <th>{{ __('site.wed') }}</th>
                    <th>{{ __('site.thu') }}</th>
                    <th>{{ __('site.fri') }}</th>
                    <th>{{ __('site.sat') }}</th>
                    <th>{{ __('site.sun') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ __('site.price_per_day', ['price' => 120]) }}</td>
                    <td>{{ __('site.price_per_day', ['price' => 120]) }}</td>
                    <td>{{ __('site.price_per_day', ['price' => 120]) }}</td>
                    <td>{{ __('site.price_per_day', ['price' => 120]) }}</td>
                    <td>{{ __('site.price_per_day', ['price' => 120]) }}</td>
                    <td>{{ __('site.price_per_day', ['price' => 120]) }}</td>
                    <td>{{ __('site.price_per_day', ['price' => 120]) }}</td>
                  </tr>
                  <tr>
                    <td>{{ __('site.price_per_day', ['price' => 120]) }}</td>
                    <td>{{ __('site.price_per_day', ['price' => 120]) }}</td>
                    <td>{{ __('site.price_per_day', ['price' => 120]) }}</td>
                    <td>{{ __('site.price_per_day', ['price' => 120]) }}</td>
                    <td>{{ __('site.price_per_day', ['price' => 120]) }}</td>
                    <td>{{ __('site.price_per_day', ['price' => 120]) }}</td>
                    <td>{{ __('site.price_per_day', ['price' => 120]) }}</td>
                  </tr>
                </tbody>
              </table>

              <h5 class="dancingFont text-capitalize mt-5">
                {{ __('site.global_discount') }}
              </h5>

              <table
                id="discount"
                class="table table-hover table-striped text-capitalize mt-3 w-100"
              >
                <thead>
                  <tr>
                    <th>{{ __('site.min_max_days') }}</th>
                    <th>{{ __('site.price_per_day') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ __('site.discount_range_1', ['min' => 3, 'max' => 5]) }}</td>
                    <td>{{ __('site.discount_price_1', ['price' => 115]) }}</td>
                  </tr>
                  <tr>
                    <td>{{ __('site.discount_range_2', ['min' => 6, 'max' => 8]) }}</td>
                    <td>{{ __('site.discount_price_2', ['price' => 100]) }}</td>
                  </tr>
                </tbody>
              </table>

              <h5 class="dancingFont text-capitalize mt-5">
                {{ __('site.special_time') }}
              </h5>

              <table class="table table-hover table-striped text-capitalize mt-3 w-100">
                <thead>
                  <tr>
                    <th>{{ __('site.start_date') }}</th>
                    <th>{{ __('site.end_date') }}</th>

                    <th>{{ __('site.price_per_day') }}</th>
                    <th>{{ __('site.special_discount') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ __('site.special_time_date_1', ['date' => '31-08-2022 07:00 AM']) }}</td>
                    <td>{{ __('site.special_time_date_2', ['date' => '03-09-2022 05:00 PM']) }}</td>
                    <td>{{ __('site.special_time_price', ['price' => 100]) }}</td>
                    <td>
                      <a href="#discount" class="text-decoration-underline"
                        >{{ __('site.view_discount') }}</a
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
            </figcaption>

            <!-- calender -->
            <figcaption class="my-5">
              <div class="container flex-column">
                <div class="calendar bg-secondary-subtle bg-opacity-75 rounded-3 mb-4">
                  <div class="header">
                    <div class="month ">{{ __('site.month_year', ['month' => 'July', 'year' => 2021]) }}</div>
                    <div class="btns">
                      <!-- today -->
                      <div class="btn today">
                        <i class="fas fa-calendar-day"></i>
                      </div>
                      <!-- previous month -->
                      <div class="btn prev">
                        <i class="fas fa-chevron-left"></i>
                      </div>
                      <!-- next month -->
                      <div class="btn next">
                        <i class="fas fa-chevron-right"></i>
                      </div>
                    </div>
                  </div>
                  <div class="weekdays">
                    <div class="day">{{ __('site.sun') }}</div>
                    <div class="day">{{ __('site.mon') }}</div>
                    <div class="day">{{ __('site.tue') }}</div>
                    <div class="day">{{ __('site.wed') }}</div>
                    <div class="day">{{ __('site.thu') }}</div>
                    <div class="day">{{ __('site.fri') }}</div>
                    <div class="day">{{ __('site.sat') }}</div>
                  </div>

                  <div class="days">
                    <!-- render days with js -->
                  </div>

                  <input type="text" hidden value="" name="date" id="date">
                  <input type="text" hidden value="" name="price" id="price">
                </div>

                <div class="d-flex justify-content-evenly w-100 fw-semibold flex-wrap">
                  <div class="d-flex align-items-center me-2">
                    <span class="icon bg-primary me-2"></span>
                    <span>{{ __('site.today') }}</span>
                  </div>
                  <div class="d-flex align-items-center me-2">
                    <span class="icon bg-success me-2"></span>
                    <span>{{ __('site.avaliable') }}</span>
                  </div>
                  <div class="d-flex align-items-center me-2">
                    <span class="icon bg-danger me-2"></span>
                   <span>{{ __('site.unavaliable') }}</span>
                  </div>
                </div>
              </div>


            </figcaption>

          </div>
        </div>
        <div class="col-lg-5">
          <div class="border border-secondary-subtle rounded-3">
            <div
              class="headerLink d-flex py-3 border-bottom border-secondary-subtle"
            >
              <a href="#bookingContent" class="fs-5 fw-semibold text-uppercase position-relative text-center w-50 active">{{ __('site.booking') }}</a>
              <a href="#requestBookingContent" class="fs-5 fw-semibold text-uppercase position-relative text-center w-50"
                >{{ __('site.request_booking') }}</a
              >
            </div>

            <div id="bookingContent" class="my-4">
              <form action="" class="p-4">
                <div class="row g-3">
                  <div class="col-6">
                    <div class="">
                      <label for="checkin" class="fw-semibold">{{ __('site.check_in') }}</label>
                      <input
                        type="datetime-local"
                        class="form-control mt-2 cPointer"
                      />
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="">
                      <label for="checkout" class="fw-semibold"
                        >{{ __('site.check_out') }}</label
                      >
                      <input
                        type="datetime-local"
                        class="form-control mt-2 cPointer"
                      />
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="desc">

                        <label for="guest" class="fw-semibold">{{ __('site.guests') }}</label>

                      <div class="pt-0">
                        <div class="personNum cPointer text-center">
                          <!-- <p class="totalPerson fw-bold py-1 border border-secondary-subtle rounded-2 mt-2">6</p> -->
                          <input type="text" id="guest" name="guest" value="7" class="totalPerson fw-bold form-control mt-2">

                        </div>

                        <div class="subMenu shadow p-2 rounded-3 d-none">
                          <div class="d-flex justify-content-between">
                            <span>{{ __('site.adult') }}</span>
                            <div class="adult d-flex ms-3 ">
                              <i
                                class="fa fa-minus cPointer border border-secondary p-1 rounded-3 me-1"
                              ></i>
                              <input
                                id="bookingAdultPerson"
                                type="num"
                                name="bookingAdultPerson"
                                value="3"
                                class="border-0 bg-transparent me-1 text-center fw-bold width-fit"
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
                                id="bookingChildPerson"
                                type="num"
                                name="bookingChildPerson"
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
                  <div class="col-6">
                    <div class="">
                      <label for="rooms" class="fw-semibold"
                        >{{ __('site.rooms') }}</label
                      >
                      <input
                        id="room"
                        name="roomNum"
                        min="0"
                        value="1"
                        type="number"
                        class="form-control cPointer fw-semibold mt-2"
                      />
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="">
                      <label for="services" class="fw-semibold"
                        >{{ __('site.services') }}</label
                      >
                      <select name="services" id="services" class="form-control fw-semibold mt-2 text-capitalize">
                        <option value="wifi">{{ __('site.wifi') }}</option>
                        <option value="normal">{{ __('site.normal_free') }}</option>
                        <option value="strong">{{ __('site.strong_5_day') }}</option>
                        <option value="vip">{{ __('site.vip_5_total') }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="">
                      <label for="services" class="fw-semibold"
                        >{{ __('site.other_services') }}</label
                      >
                      <select name="otherServices" id="otherServices" class="form-control fw-semibold mt-2 text-capitalize">
                        <option value="golf">{{ __('site.golf') }}</option>
                        <option value="popular">{{ __('site.popular_20_day') }}</option>
                        <option value="primium">{{ __('site.primium_50_day') }}</option>
                        <option value="vip">{{ __('site.vip_115_total') }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-12">
                    <div>
                      <label for="extraServices" class="fw-semibold text-uppercase">{{ __('site.extra_services') }}</label>

                      <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary-subtle">
                        <div class="d-flex align-items-center">
                          <input type="checkbox" name="driver" id="driver">
                          <label for="driver" class="text-capitalize ms-2">{{ __('site.driver') }}</label>
                        </div>

                        <div>{{ __('site.driver_price', ['price' => 15]) }}</div>
                      </div>
                      <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary-subtle">
                        <div class="d-flex align-items-center">
                          <input type="checkbox" name="gym" id="gym">
                          <label for="gym" class="text-capitalize ms-2">{{ __('site.gym_spa') }}</label>
                        </div>

                        <div>{{ __('site.gym_spa_price', ['price' => 15]) }}</div>
                      </div>
                      <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary-subtle">
                        <div class="d-flex align-items-center">
                          <input type="checkbox" name="breakfast" id="breakfast">
                          <label for="breakfast" class="text-capitalize ms-2">{{ __('site.breakfast') }}</label>
                        </div>

                        <div>{{ __('site.breakfast_price', ['price' => 15]) }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div>

                      <p class="mb-2 mt-3 ps-1 fw-semibold">{{ __('site.deposit_option_50_per_item') }}</p>
                      <div>
                        <button class="btn mainBtn mx-1 text-uppercase mb-2">{{ __('site.full_payment') }}</button>
                        <button class="btn mainBtn mx-1 text-uppercase mb-2">{{ __('site.pay_deposit') }}</button>
                      </div>

                    </div>
                  </div>
                  <div class="col-12">
                    <div class="bgOrange py-3 text-center">

                      <div class="d-flex justify-content-around fs-5 fw-semibold my-3 dancingFont">
                        <span>{{ __('site.total') }}:</span>
                        <span class="fw-bold textMainColor">{{ __('site.total_price', ['price' => 1000]) }}</span>
                      </div>
                        <button type="submit" class="btn mainBtn fw-semibold text-uppercase py-3 px-4 rounded-3">{{ __('site.book_now') }}</button>


                    </div>
                  </div>

                </div>
              </form>
            </div>

            <div id="requestBookingContent" class="my-4 d-none">
              <form action="" class="p-4">
                <div class="row g-3">

                  <div class="col-6">
                    <div class="">
                      <label for="name" class="fw-semibold text-capitalize">{{ __('site.name') }}</label>
                      <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control mt-2 cPointer"
                        placeholder="{{ __('site.your_name') }}"
                      />
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="">
                      <label for="email" class="fw-semibold text-capitalize">{{ __('site.email') }}</label>
                      <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control mt-2 cPointer"
                        placeholder="{{ __('site.your_email') }}"
                      />
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="">
                      <label for="number" class="fw-semibold text-capitalize">{{ __('site.number') }}</label>
                      <input
                        type="number"
                        name="number"
                        id="number"
                        class="form-control mt-2 cPointer"
                        placeholder="{{ __('site.your_number') }}"
                      />
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="">
                      <label for="address" class="fw-semibold text-capitalize">{{ __('site.address') }}</label>
                      <input
                        type="text"
                        name="address"
                        id="address"
                        class="form-control mt-2 cPointer"
                        placeholder="{{ __('site.your_address') }}"
                      />
                    </div>
                  </div>

                  <!-- checkin -->
                  <div class="col-6">
                    <div class="">
                      <label for="checkin" class="fw-semibold">{{ __('site.check_in') }}</label>
                      <input
                        type="datetime-local"
                        class="form-control mt-2 cPointer"
                      />
                    </div>
                  </div>
                  <!-- checkout -->
                  <div class="col-6">
                    <div class="">
                      <label for="checkout" class="fw-semibold"
                        >{{ __('site.check_out') }}</label
                      >
                      <input
                        type="datetime-local"
                        class="form-control mt-2 cPointer"
                      />
                    </div>
                  </div>
                  <!-- guest -->
                  <div class="col-6">
                    <div class="desc">

                        <label for="guest" class="fw-semibold">{{ __('site.guests') }}</label>

                      <div class="pt-0">
                        <div class="personNum cPointer text-center">
                          <!-- <p class="totalPerson fw-bold py-1 border border-secondary-subtle rounded-2 mt-2">6</p> -->
                          <input type="text" id="guest" name="guest" value="7" class="totalPerson fw-bold form-control mt-2">

                        </div>

                        <div class="subMenu shadow p-2 rounded-3 d-none">
                          <div class="d-flex justify-content-between">
                            <span>{{ __('site.adult') }}</span>
                            <div class="adult d-flex ms-3 ">
                              <i
                                class="fa fa-minus cPointer border border-secondary p-1 rounded-3 me-1"
                              ></i>
                              <input
                                id="bookingAdultPerson"
                                type="num"
                                name="bookingAdultPerson"
                                value="3"
                                class="border-0 bg-transparent me-1 text-center fw-bold width-fit"
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
                                id="bookingChildPerson"
                                type="num"
                                name="bookingChildPerson"
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

                  <div class="row g-3">
                    <div class="col-6">
                      <div class="">
                        <label for="services" class="fw-semibold"
                          >{{ __('site.services') }}</label
                        >
                        <select name="services" id="services" class="form-control fw-semibold mt-2 text-capitalize">
                          <option value="wifi">{{ __('site.wifi') }}</option>
                          <option value="normal">{{ __('site.normal_free') }}</option>
                          <option value="strong">{{ __('site.strong_5_day') }}</option>
                          <option value="vip">{{ __('site.vip_5_total') }}</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="">
                        <label for="services" class="fw-semibold"
                          >{{ __('site.other_services') }}</label
                        >
                        <select name="otherServices" id="otherServices" class="form-control fw-semibold mt-2 text-capitalize">
                          <option value="golf">{{ __('site.golf') }}</option>
                          <option value="popular">{{ __('site.popular_20_day') }}</option>
                          <option value="primium">{{ __('site.primium_50_day') }}</option>
                          <option value="vip">{{ __('site.vip_115_total') }}</option>
                        </select>
                      </div>
                    </div>
                  </div>


                  <div class="col-12">
                    <div>
                      <label for="extraServices" class="fw-semibold text-uppercase">{{ __('site.extra_services') }}</label>

                      <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary-subtle">
                        <div class="d-flex align-items-center">
                          <input type="checkbox" name="driver" id="driver">
                          <label for="driver" class="text-capitalize ms-2">{{ __('site.driver') }}</label>
                        </div>

                        <div>{{ __('site.driver_price', ['price' => 15]) }}</div>
                      </div>
                      <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary-subtle">
                        <div class="d-flex align-items-center">
                          <input type="checkbox" name="gym" id="gym">
                          <label for="gym" class="text-capitalize ms-2">{{ __('site.gym_spa') }}</label>
                        </div>

                        <div>{{ __('site.gym_spa_price', ['price' => 15]) }}</div>
                      </div>
                      <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary-subtle">
                        <div class="d-flex align-items-center">
                          <input type="checkbox" name="breakfast" id="breakfast">
                          <label for="breakfast" class="text-capitalize ms-2">{{ __('site.breakfast') }}</label>
                        </div>

                        <div>{{ __('site.breakfast_price', ['price' => 15]) }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div>

                      <textarea name="extraInfo" id="extraInfo" rows="4" placeholder="{{ __('site.extra_information') }}" class="form-control my-3"></textarea>

                    </div>
                  </div>
                  <div class="col-12">
                    <div class=" text-center">


                        <button type="submit" class="btn mainBtn fw-semibold text-uppercase py-3 px-4 rounded-3">{{ __('site.send') }}</button>


                    </div>
                  </div>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="pb-5 newsletter shadow">
    <div class="container">
      <div class="content p-5 px-3 text-center rounded-3">
        <h3 class="h2 fw-bold text-capitalize">
          {{ __('site.sign_up_to_get_pro_offers') }}
        </h3>
        <p class="my-3 px-5 text-muted">
          {{ __('site.sign_up_description') }}
        </p>
        <form action="{{route('site.subs')}}" method="POST" id="newsletter" class="d-flex mb-2 w-75 mx-auto">
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
    $('#newsletter').on('submit', function(e) {
                e.preventDefault()
                axios.post($(this).attr('action'), $(this).serialize()).then((res) => {
                    toastr.success(res.data.message);

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
