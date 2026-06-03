
<section class="my-20 trip">
    <div class="text-center" data-aos="fade-up">
        <div class="pb-[10px]">
          <span class="text-2xl font-dancingFont text-second-color capitalize">{{ __('site.start_now') }}</span>
          <h2 class="text-3xl sm:text-5xl font-semibold capitalize">{{ __('site.customize_your_nile_river_cruise') }}</h2>
        </div>
    </div>
    <div class="container">
        <div class="grid gap-6 grid-cols-1 md:grid-cols-[25%_minmax(0,1fr)]">
            <figure class="overflow-hidden relative" data-aos="fade-left">
                <img src="https://magictravel.perfect-solution4u.com//storage/media/Make-tour.jpg"
                     class="w-80 h-90 imageAnimation"
                     style="border-radius: 10px;"
                     alt="">
                    <div class=" text-center absolute top-11 right-8">
             <!--        <p class="text-5xl font-dancingFont text-second-color">30%</p>
                    <span class="capitalize text-2xl font-semibold">discount</span> -->
                </div>
            </figure>

            <form method="POST" action="{{ route('site.make-appointment') }}" class="grid auto-rows-max  gap-3 grid-cols-1 md:grid-cols-12" data-aos="fade-right"  id="send-appointment">
                @csrf
                <!-- row 1 -->
                    <select name="nickname" class="uppercase col-span-6 md:col-span-2 p-2 focus:ring-0 rounded-md">
                        <option value="mr">{{ __('site.mr') }}</option>
                        <option value="mrs">{{ __('site.mrs') }}</option>
                        <option value="ms">{{ __('site.ms') }}</option>
                    </select>
                    <input type="text" name="name" placeholder="{{ __('site.your_name') }}" class="col-span-6 md:col-span-5 py-2 focus:ring-0 rounded-md">
                    <input type="email" name="email" placeholder="{{ __('site.your_email') }}" class="col-span-6 md:col-span-5 py-2 focus:ring-0 rounded-md">
                    <!-- row 2 -->
                    <select name="nationality" class="col-span-6 md:col-span-4 capitalize p-2 focus:ring-0 rounded-md">
                        @foreach ($countries as $country )
                            <option value="{{ $country->name."  ".$country->flag }}"> {{ $country->name."  ".$country->flag }}</option>
                        @endforeach
                    </select>
                    <input type="date" name=" arrival_date" placeholder="{{ __('site.arrival_date') }}" class=" col-span-6 md:col-span-4 py-2 focus:ring-0 rounded-md">
                    <input type="date" name="departure_date" placeholder="{{ __('site.departure_date') }}" class=" col-span-6 md:col-span-4 py-2 focus:ring-0 rounded-md">

                    <!-- row 3 -->
                    <div class="col-span-6">
                        <label for="phone" class="capitalize">{{ __('site.phone_number') }}</label>
                        <input type="tel" name="phone" placeholder="{{ __('site.your_number') }}" class="w-full mt-1 py-2 focus:ring-0 rounded-md">
                    </div>
                    <div class="col-span-6">
                        <label for="hotelChoice" class="capitalize">{{ __('site.hotel_choice') }}</label>
                        <select  name="hotel_choice"  class="w-full mt-1 p-2 capitalize focus:ring-0 rounded-md">
                            <option value="High-Luxury">{{ __('site.high_luxury_5_stars') }}</option>
                            <option value="Standard5">{{ __('site.standard_5_stars') }}</option>
                            <option value="Economy">{{ __('site.economy_4_stars') }}</option>
                            <option value="booked-on-your-own">{{ __('site.booked_on_your_own') }}</option>

                        </select>
                    </div>

                    <!-- cruise options -->
                    <div class="col-span-6 md:col-span-4">
                        <label for="cruiseType" class="capitalize">{{ __('site.cruise_type') }}</label>
                        <select name="cruise_type[]" id="cruiseType" class="w-full mt-1 p-2 capitalize focus:ring-0 rounded-md">
                            <option value="Standard">{{ __('site.standard') }}</option>
                            <option value="Deluxe">{{ __('site.deluxe') }}</option>
                            <option value="Luxury">{{ __('site.luxury') }}</option>
                        </select>
                    </div>
                    <div class="col-span-6 md:col-span-4">
                        <label for="cruisePickup" class="capitalize">{{ __('site.cruise_pickup') }}</label>
                        <select name="cruise_pick_drop_off[]" id="cruisePickup" class="w-full mt-1 p-2 capitalize focus:ring-0 rounded-md">
                            <option value="Luxor">{{ __('site.luxor') }}</option>
                            <option value="Aswan">{{ __('site.aswan') }}</option>
                        </select>
                    </div>
                    <div class="col-span-6 md:col-span-4">
                        <label for="cruiseDuration" class="capitalize">{{ __('site.cruise_duration') }}</label>
                        <select name="cruise_duration[]" id="cruiseDuration" class="w-full mt-1 p-2 capitalize focus:ring-0 rounded-md">
                            <option value="3 Nights">{{ __('site.nights_3') }}</option>
                            <option value="4 Nights">{{ __('site.nights_4') }}</option>
                            <option value="7 Nights">{{ __('site.nights_7') }}</option>
                        </select>
                    </div>

                    <!-- row 4 -->
                    <div class="col-span-6 md:col-span-4">
                        <label for="adult" class="capitalize">{{ __('site.adult') }}</label>
                        <div class="flex items-center mt-1">
                            <i class='bx bx-minus minus text-xl font-bold bg-blue-300 size-10 flex-shrink-0 border border-e-0 border-gray-400 rounded-s-md center cursor-pointer'></i>
                            <input type="number" name="adults" value="1" class="py-[7px] text-center font-bold w-full">
                            <i class='bx bx-plus plus text-xl font-bold bg-blue-300 size-10 flex-shrink-0 border border-e-0 border-gray-400 rounded-e-md center cursor-pointer'></i>
                        </div>
                    </div>
                     <div class="col-span-6 md:col-span-4">
                        <label for="children" class="capitalize">{{ __('site.children') }}</label>
                        <div class="flex items-center mt-1">
                            <i class='bx bx-minus minus text-xl font-bold bg-blue-300 size-10 flex-shrink-0 border border-e-0 border-gray-400 rounded-s-md center cursor-pointer'></i>
                            <input type="number" name="children" value="0" class="py-[7px] text-center font-bold w-full">
                            <i class='bx bx-plus plus text-xl font-bold bg-blue-300 size-10 flex-shrink-0 border border-e-0 border-gray-400 rounded-e-md center cursor-pointer'></i>
                        </div>
                     </div>
                    <div class="col-span-6 md:col-span-4">
                        <label for="agesRange" class="capitalize">{{ __('site.ages_range_optional') }}</label>
                        <select name="age_range" id="agesRange" class="mt-1 p-[7px] rounded-md w-full">
                            <option value=""  hidden>{{ __('site.select_ages_range') }}</option>
                            <option value="18-24">18->24</option>
                            <option value="25-40">25->40</option>
                            <option value="41-60">41->60</option>
                            <option value="+61">+61</option>
                        </select>

                    </div>

                    <!-- row 5 -->
                    <textarea name="notes" id="notes" class="col-span-6 md:col-span-12 w-full rounded-md p-2" rows="3" placeholder="{{ __('site.notes') }}..."></textarea>
                    <input type="hidden" name="hear_about_us" id="hear_about_us">
                    <!-- row 6 -->
                    <div class="col-span-6 md:col-span-12">
                        <label for="hearAboutUs" class="capitalize">{{ __('site.how_did_you_hear_about_us_optional') }}</label>
                        <div class="mt-1 flex justify-between items-center flex-wrap">
                            <div>
                                <input type="radio" name="optionsHear" class="optionsHear" id="searchEngine" value="Search Engine">
                                <label for="searchEngine" class="capitalize">{{ __('site.search_engine') }}</label>
                            </div>
                            <div>
                                <input type="radio" name="optionsHear" class="optionsHear" id="socialMedia" value="Social Media">
                                <label for="socialMedia" class="capitalize">{{ __('site.social_media') }}</label>
                            </div>
                            <div>
                                <input type="radio" name="optionsHear" class="optionsHear" id="tripAdvisor" value="TripAdvisor">
                                <label for="tripAdvisor" class="capitalize">{{ __('site.trip_advisor') }}</label>
                            </div>
                            <div>
                                <input type="radio" name="optionsHear" class="optionsHear" id="aFriend" value="A Friend">
                                <label for="aFriend" class="capitalize">{{ __('site.a_friend') }}</label>
                            </div>
                        </div>
                    </div>

                    <!-- row 7 -->
                    <button type="submit" class="col-span-6 md:col-span-12 mainBtn " id="appointment-btn">{{ __('site.send_an_inquiry') }}</button>

                               <div
              class="flex items-center col-span-6 p-4 my-8 rounded-md shadow-lg md:col-span-12"
            >
              <div>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  version="1.1"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  xmlns:svgjs="http://svgjs.com/svgjs"
                  width="100%"
                  height="100"
                  x="0"
                  y="0"
                  viewBox="0 0 24 24"
                  style="enable-background: new 0 0 512 512"
                  xml:space="preserve"
                  class=""
                >
                  <g>
                    <path
                      xmlns="http://www.w3.org/2000/svg"
                      d="m22.236 16.053-6.636-12.066a4.11 4.11 0 0 0 -7.2 0l-6.636 12.066a4.109 4.109 0 0 0 3.6 6.089h13.272a4.109 4.109 0 0 0 3.6-6.089z"
                      fill="#29b6f6"
                      data-original="#29b6f6"
                      class=""
                    ></path>
                    <g xmlns="http://www.w3.org/2000/svg" fill="#e1f5fe">
                      <path
                        d="m12 13.749a.75.75 0 0 1 -.75-.75v-4.999a.75.75 0 0 1 1.5 0v5a.75.75 0 0 1 -.75.749z"
                        fill="#e1f5fe"
                        data-original="#e1f5fe"
                      ></path>
                      <circle
                        cx="12"
                        cy="16"
                        r="1"
                        fill="#e1f5fe"
                        data-original="#e1f5fe"
                      ></circle>
                    </g>
                  </g>
                </svg>
              </div>
<div class="ms-3">
  <h3 class="font-semibold text-base text-gray-700 mb-2">
    <i class="fa fa-question-circle me-2 text-main-color"></i>
    {{ __('site.do_you_face_an_issue_sending_a_request') }}
  </h3>
  <h4 class="text-lg font-bold text-main-color mb-1">
<i class="bx bx-envelope text-[17px] text-main-color"></i> info@VisaEgyptTravel.com
  </h4>
  <h4 class="text-lg font-bold text-main-color">
<i class="bx bxl-whatsapp text-[17px] text-main-color"></i> +20 100 505 5952
  </h4>
</div>


            </div>
            </form>

        </div>

    </div>
</section>

@push('js')
    <script>
        $(document).ready(function() {
            $('.optionsHear').on('change', function() {
                if ($(this).is(':checked')) {
                    const selectedValue = $(this).val();
                    $('#hear_about_us').val(selectedValue);
                }
            });
        });

        $('#send-appointment').on('submit', function (e) {
            e.preventDefault()
            $('#appointment-btn').attr('disabled', true).prepend(`<i class="fa fa-spinner fa-spin"></i> `)
            axios.post($(this).attr('action'), $(this).serialize()).then(response => {
                toastr.success(response.data.message)
                $(this).trigger('reset')
            }).catch(error => {
                toastr.error(error.response.data.message)
            }).finally(() => {
                $('#appointment-btn').attr('disabled', false).children('i').remove()
            })
        })

    </script>
@endpush
