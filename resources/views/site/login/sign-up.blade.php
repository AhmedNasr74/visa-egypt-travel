@extends('layouts.site.app')

@section('content')

  <!-- banner  -->
  <section>
    <div
      class="capitalize flex justify-between px-4 h-[50vh] bg-[url('../image/auth.jpg')] bg-cover bg-center bg-no-repeat"
    >
      <span class="self-center text-4xl font-semibold text-white"
        >sign up</span
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
                >sign up</span
              >
            </div>
          </li>
        </ol>
      </nav>
    </div>
  </section>

  <!-- sign up -->
  <section class="my-20">
    <div class="container">
      <div class="grid gap-5 grid-cols-1 md:grid-cols-[30%_minmax(0,1fr)]">
          <figure><img src="{{ asset('assets/site/img/Sign in.gif') }}" class="size-full " alt="sign up gif"></figure>
          <form class="grid gap-5 sm:grid-cols-2" name="signup-form" id="signup-form" action="{{route('register-client')}}" method="POST">
            @csrf
              <div>
                <input
                  type="text"
                  name="name"
                  placeholder="Your Name"
                  class="p-3 rounded-md text-zinc-500 bg-ba4-color border-none focus:ring-0 w-full"
                />
              </div>
              <div>
                <input
                  type="email"
                  name="email"
                  placeholder="Your Email"
                  class="p-3 rounded-md text-zinc-500 bg-ba4-color border-none focus:ring-0 w-full"
                />
              </div>
              <div>
                <input
                  type="tel"
                  name="phone"
                  placeholder="Phone Number"
                  class="p-3 rounded-md text-zinc-500 bg-ba4-color border-none focus:ring-0 w-full"
                />
              </div>
              <div>
                <input
                  type="password"
                  name="password"
                  placeholder="Create Password"
                  class="p-3 rounded-md text-zinc-500 bg-ba4-color border-none focus:ring-0 w-full"
                />
              </div>
              <div>
                  <p class="font-bold my-2 text-lg">or</p>
                  <a href="{{route('google-login')}}" class="mainBtn ">
                      <i class='bx bxl-google'></i>
                      sign up with Google
              
                  </a>
              </div>
              
              <div class="sm:col-span-2 col-span-1">
                <button class="mainBtn w-full" type="submit">sign up</button>
              </div>

              <div class="sm:col-span-2 col-span-1">
                  <input type="checkbox" name="terms" id="privacy">
                  <label for="privacy">By signing up, you agree to customer. ai's Terms of Service and Privacy Policy</label>
              </div>

              <div class="sm:col-span-2 col-span-1">
                  <span class="text-lg me-5">Already have an account?</span>
                  <a href="{{route('login-page')}}" class="mainBtn ">login</a>
              </div>


          </form>
      </div>
    </div>
  </section>
  {{-- <section class="signUp">
    <div class="container">
      <div class="row my-5 shadow py-4 px-2 rounded-3">
        <div class="col-md-5">
          <figure class="h-100 rounded-3 overflow-hidden">
            <img
              src="{{asset("assets/site/img/logo/Artboard3.jpg")}}"
              class="w-100 h-100"
              alt="signUp image"
            />
          </figure>
        </div>
        <div class="col-md-7">
        <form class="login-form-wrap" name="signup-form" id="signup-form" action="{{route('register-client')}}" method="POST">
            @csrf
          <div>
            <h2 class="h4 text-capitalize"></h2>
            <div class="row g-4">
              <div class="col-lg-6">
                <label for="name" class="fw-bold mb-2">Name</label>
                <input
                  class="form-control"
                  type="text"
                  id="name"
                  name="name"
                  placeholder="Enter your name..."
                />
              </div>
              <div class="col-lg-6">
                <label for="email" class="fw-bold mb-2">Email</label>
                <input
                  class="form-control"
                  type="email"
                  id="email"
                  name="email"
                  placeholder="Enter your email..."
                />
              </div>
              <div class="col-lg-6">
                <label for="phone" class="fw-bold mb-2"
                  >Phone Number</label
                >
                <input
                  class="form-control"
                  type="tel"
                  id="phone"
                  name="phone"
                  placeholder="Enter your phoneNumber..."
                />
              </div>
              <div class="col-lg-6">
                <label for="password" class="fw-bold mb-2"
                  >Create Password</label
                >
                <input
                  class="form-control"
                  type="password"
                  id="password"
                  name="password"
                  placeholder="Enter your password..."
                />
              </div>
            </div>

            <span class="spanLine position-relative d-block mt-3 fs-4"
              >or</span
            >

            <a href="{{route('google-login')}}" class="p-2 rounded-3 bg-white text-capitalize">
                <i class="fa-brands fa-google me-2 px-2"></i>log in with
                Google
              </a>

            <a href="" class="d-block my-4">
              <button class="btn mainBtn text-capitalize py-3 w-100">
                sign up
              </button>
            </a>

            <div class="d-flex">
              <input type="checkbox" name='terms' id="sign" class="me-2" />
              <label for="sign"
                >By signing up, you agree to customer. ai's Terms of Service
                and Privacy Policy</label
              >
            </div>
            </form>

            <span>Already have an account?</span>
              <a href="{{route('login-page')}}" class="btn mainBtn ms-4 px-4 my-4">login</a>
          </div>
        </div>
      </div>
    </div>
  </section> --}}
@endsection

@push('js')

<script>
    $(document).ready(function () {
        $('#signup-form').submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                success: function (response) {
                    toastr.success(response.message);
                    $('#signup-form')[0].reset();
                    setTimeout(() => {
                        window.location = "{{ route('site.home') }}";

                    }, 1000);

                },
                error: function (xhr) {
                    toastr.error(xhr.responseJSON.message);
                }
            });
        });
    });
</script>
@endpush
