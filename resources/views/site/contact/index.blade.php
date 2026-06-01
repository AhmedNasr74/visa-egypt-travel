@extends('layouts.site.app')

@section('content')

    @php
    $address = setting(App\Enums\SettingKey::ADDRESS->value ?? [])[0] ?? "";
    $PRIMARY_PHONE = setting(App\Enums\SettingKey::PRIMARY_PHONE->value)[0] ?? "";
    $CONTACT_EMAIL = setting(App\Enums\SettingKey::CONTACT_EMAIL->value ?? [])[0] ?? "";
    @endphp
     <!-- banner  -->
     <section>
        <div style="background-image: url({{ asset('storage/media/contact.webp') }})"
          class="capitalize flex justify-between px-4 h-[50vh] bg-cover bg-center bg-no-repeat"
        >
          <span class="self-center text-4xl font-semibold text-white"
            >{{ __('site.contact_us') }}</span
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
                  href="{{ route("site.home") }}"
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
                  {{ __('site.home') }}
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
                    >{{ __('site.contact_us') }}</span
                  >
                </div>
              </li>
            </ol>
          </nav>
        </div>
      </section>

      <!-- contact -->
      <section class="my-20">
        <div class="container">
          <div class="grid gap-4 grid-cols-1 md:grid-cols-[35%_minmax(0,1fr)]">
            <div>
              <!-- section title -->
              <div>
                <span
                  class="text-2xl font-dancingFont text-second-color capitalize"
                  >{{ __('site.talk_with_our_team') }}</span
                >
                <h2 class="text-3xl sm:text-5xl font-semibold capitalize">
                  {{ __('site.any_question_feel_free_to_contact') }}
                </h2>
              </div>
              <p class="text-zinc-500 my-4">
                {{ __('site.payment_ssl_note') }}
              </p>

              <ul class="list-none flex flex-wrap text-lg font-semibold">
                <li
                  class="bg-ba4-color hover:text-white hover:bg-second-color size-8 center rounded-full transition-time hover:scale-110 me-2"
                >
                  <a href="#" class="text-xl"><i class="bx bxl-whatsapp"></i></a>
                </li>
                <li
                  class="bg-ba4-color hover:text-white hover:bg-second-color size-8 center rounded-full transition-time hover:scale-110 me-2"
                >
                  <a href="#" class="text-xl"
                    ><i class="bx bxl-facebook-circle"></i
                  ></a>
                </li>
                <li
                  class="bg-ba4-color hover:text-white hover:bg-second-color size-8 center rounded-full transition-time hover:scale-110 me-2"
                >
                  <a href="#" class="text-xl"><i class="bx bxl-twitter"></i></a>
                </li>
                <li
                  class="bg-ba4-color hover:text-white hover:bg-second-color size-8 center rounded-full transition-time hover:scale-110 me-2"
                >
                  <a href="#" class="text-xl"><i class="bx bxl-linkedin"></i></a>
                </li>
              </ul>
            </div>

            <form class="grid gap-5 sm:grid-cols-2" action="{{route('site.con-store')}}" method="POST" id="contact-form">
                @csrf
              <div>
                <input
                  type="text"
                  name="name"
                  placeholder="{{ __('site.your_name') }}"
                  class="p-3 rounded-md text-zinc-500 bg-ba4-color border-none focus:ring-0 w-full"
                />
              </div>
              <div>
                <input
                  type="email"
                  name="email"
                  placeholder="{{ __('site.your_email') }}"
                  class="p-3 rounded-md text-zinc-500 bg-ba4-color border-none focus:ring-0 w-full"
                />
              </div>
              <div>
                <input
                  type="tel"
                  name="phone"
                  placeholder="{{ __('site.phone_number') }}"
                  class="p-3 rounded-md text-zinc-500 bg-ba4-color border-none focus:ring-0 w-full"
                />
              </div>
              <div>
                <input
                  type="text"
                  name="subject"
                  placeholder="{{ __('site.subject') }}"
                  class="p-3 rounded-md text-zinc-500 bg-ba4-color border-none focus:ring-0 w-full"
                />
              </div>
              <div class="col-span-1 sm:col-span-2">
                <textarea
                  rows="6"
                  name="message"
                  placeholder="{{ __('site.write_a_message') }}"
                  class="p-3 rounded-md text-zinc-500 bg-ba4-color border-none focus:ring-0 w-full"
                ></textarea>
              </div>
              <div>
                <button type="submit" class="mainBtn uppercase w-full">
                  {{ __('site.send_message') }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>

      <!-- contact info -->
      <section class="my-20">
        <div class="container">
          <div class="grid gap-5 lg:grid-cols-3">
            <div class="flex border p-4 rounded-md h-full">
              <div
                class="bg-ba4-color hover:text-white hover:bg-second-color size-14 center rounded-full transition-time hover:scale-110 me-3"
              >
                <i class="bx bx-map text-2xl"></i>
              </div>
              <div>
                <h6 class="text-xl font-semibold capitalize">{{ __('site.address') }}</h6>
                <p class="text-zinc-500">{{ $address }}</p>
              </div>
            </div>
            <div class="flex border p-4 rounded-md h-full">
              <div
                class="bg-ba4-color hover:text-white hover:bg-second-color size-14 center rounded-full transition-time hover:scale-110 me-3"
              >
                <i class="bx bx-phone-call text-2xl"></i>
              </div>
              <div>
                <h6 class="text-xl font-semibold capitalize">{{ __('site.phone') }}</h6>
                <p class="text-zinc-500">{{ $PRIMARY_PHONE }}</p>
              </div>
            </div>
            <div class="flex border p-4 rounded-md h-full">
              <div
                class="bg-ba4-color hover:text-white hover:bg-second-color size-14 center rounded-full transition-time hover:scale-110 me-3"
              >
                <i class="bx bx-envelope text-2xl"></i>
              </div>
              <div>
                <h6 class="text-xl font-semibold capitalize">{{ __('site.email') }}</h6>
                <p class="text-zinc-500">{{ $CONTACT_EMAIL }}</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- contact map -->
      <section class="mt-20">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d979700.563695435!2d31.019316568717255!3d29.581262034033635!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2seg!4v1736336399999!5m2!1sen!2seg"
            class="w-full"
            height="450"
            style="border: 0"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
      </section>
    <!-- logo slider -->
    <!-- ========================= End Day Tour Section ============ -->
@endsection
@push('js')
  <script>
      $('#contact-form').on('submit', function(e) {
          e.preventDefault();
          
          // Disable submit button to prevent double submission
          const submitBtn = $(this).find('button[type="submit"]');
          const originalText = submitBtn.text();
          submitBtn.prop('disabled', true).text('Sending...');
          
          axios.post($(this).attr('action'), $(this).serialize())
              .then((res) => {
                  console.log('Success response:', res.data);
                      toastr.success(res.data.message);
                      setTimeout(() => {
                        toastr.success(res.data.message2);
                      }, 1500);
                      setTimeout(() => {
                    $(this).trigger('reset');
                    window.location.reload();
                    }, 3000);
              })
              .catch(error => {
                  console.log('Error response:', error);
                  console.log('Error response data:', error.response?.data);
                  console.log('Error status:', error.response?.status);
                  
                  let errorMessage = '{{ __('main.unexpected-error') }}';
                  
                  if (error.response?.data) {
                      if (error.response.data.error) {
                          errorMessage = error.response.data.error;
                      } else if (error.response.data.message) {
                          errorMessage = error.response.data.message;
                      } else if (error.response.data.errors) {
                          // Handle validation errors
                          const firstError = Object.values(error.response.data.errors)[0];
                          errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
                      }
                  } else if (error.message) {
                      errorMessage = error.message;
                  }
                  
                  toastr.error(errorMessage);
              })
              .finally(() => {
                  // Re-enable submit button
                  submitBtn.prop('disabled', false).text(originalText);
              });
      });
  </script>
  @endpush
