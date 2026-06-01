
<section
class="banner"
>
<div class="container-fluid">
  <figure class="position-relative">
    <figcaption class="position-absolute">
      <div class="text-capitalize">
        <h2 class="text-white h1">{{__('main.profile')}}</h2>
        <p class="text-white">
          <span class="textMainColor me-1">{{ __('main.home') }}</span>
          > {{__('main.profile')}}
        </p>
      </div>
    </figcaption>
  </figure>
</div>
</section>

<main class="userProfile">
<div class="container">
  <div class="row justify-content-between g-4 my-5">
    <div class="col-md-4 bgEEE rounded-3 p-3">
      <figure class="text-center my-4">
        <img
          src="@if($client->avatar){{auth()->guard('client')->user()->avatar}}@else{{ asset('assets/site/img/free-avatar-380-456332 (1).webp')}}@endif"
          class="w-50 rounded-circle"
          alt="user image"
        />
        <h5 class="text-capitalize mt-2">{{$client->name}}</h5>
        <p class="opacity-75">{{$client->email}}</p>
      </figure>

      <ul class="nav nav-pills flex-column ms-3">
        <li class="nav-item">
          <a class="nav-link text-white" href="#user-home">{{ __('main.home') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#user-profile">{{__('main.profile')}}</a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white" href="#user-order">{{__('main.bookings')}}</a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white" href="#user-coupons"
            >My Coupons</a
          >
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#user-password"
              >{{__('main.change-password')}}</a
            >
          </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#user-settings"
            >{{__('main.settings')}}</a
          >
        </li>
        <li class="nav-item">
            <form action="{{ route('site.logout-client') }}" method="POST">
                @csrf


                <button type="submit" class="nav-link text-white">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    <span>{{ __('main.logout') }}</span>
                </button>
            </form>
        </li>
      </ul>
    </div>

    <div class="col-md-7">
      <div class="user" id="user-home">
        <div class="row justify-content-between g-3">
          <div
            class="col-12 bgEEE p-2 rounded border-start border-3 border-dark"
          >
            <div class="d-flex">
              <i class="las la-clipboard-list fs-4 me-2"></i>
              <div>
                <p class="fw-bold mb-0">{{auth()->guard('client')->user()->wishlist()->count()}}</p>
                <p>Wishlist Tours</p>
              </div>
            </div>
          </div>
          <div
            class="col-md-5 bgEEE p-2 rounded border-start border-3 border-dark"
          >
            <div class="d-flex">
              <i class="las la-shopping-bag fs-4 me-2"></i>
              <div>
                <p class="fw-bold mb-0">0</p>
                <p>Total Bookings</p>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-4 justify-content-around g-3">
          <div class="col-lg-12 bgEEE overflow-hidden p-2 rounded">
            <div>
              <h6>Recent Bookings</h6>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Booking Number</th>
                    <th>Total Price</th>
                    <th>Payment</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>labtop</td>
                    <td>20000</td>
                    <td>20000</td>
                    <td>good</td>
                  </tr>
                  <tr>
                    <td>pc</td>
                    <td>10000</td>
                    <td>10000</td>
                    <td>v-good</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="user d-none" id="user-profile">
        <div>
          <h5>Personal Details</h5>
          <div class="tp-avatar-preview">
            @if (auth()->guard('client')->user()->avatar)
                <div id="tp_imagePreview"
                    style="background-image: url({{auth()->guard('client')->user()->avatar }})">
                </div>
            @else
                <div id="tp_imagePreview"
                    style="background-image: url({{ asset('assets/site/img/team/1.png') }})">
                </div>
            @endif
        </div>
          <div>
            <form class="tp-form-wrap" action="{{ route('update-profile') }}" method="POST"
            id="update-my-profile" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="tp-avatar-edit">
                <input type="file" id="tp_imageUpload" name="avatar"/>
                <label class="btn btn-transparent" for="tp_imageUpload"><i
                        class="fa fa-picture-o"></i>Change Photo</label>
            </div>
            <label for="nameProfile">{{__('main.name')}}</label>
            <input
              id="nameProfile"
              type="text"
              value="{{$client->name}}"
              name="name"
              class="form-control my-1 rounded-2"
            />
            <label for="emailProfile">{{__('main.email')}}</label>
            <input
              id="emailProfile"
              type="email"
              readonly
              name="email"
              value="{{$client->email}}"
              class="form-control my-1 rounded-2"
            />
            <label for="phoneProfile">{{__('main.phone')}}</label>
            <input
              id="phoneProfile"
              type="number"
              name="phone"
              value="{{$client->phone}}"
              class="form-control my-1 rounded-2"
            />
                <div class="col-12">
                    <button type="submit"
                        class="btn btn-yellow mt-3 text-center">{{ __('main.save') }}</button>
                </div>
            </form>
          </div>
        </div>
      </div>

      <div class="row user d-none" id="user-order">
        <h5>User Booking</h5>
      </div>

      <div class="user d-none" id="user-coupons">
        <div class="coupon shadow p-4 rounded-3">
          <h3>Coupon Name</h3>
        </div>
      </div>

      <div class="user d-none" id="user-settings">
        <div class="shadow p-4 rounded-3 row align-items-center">
          <div class="col-md-6">
            <label for="changeLanguage">chooise current language :</label>
          </div>
          <div class="col-md-6">
            <select
              name="language"
              id="changeLanguage"
              class="form-control"
            >
              <option value="english">English</option>
              <option value="arabic">Arabic</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row user d-none" id="user-password">
        {{-- <form method="POST" action="{{ route('site.reset-password') }}"> --}}
        <form method="POST" action="{{ route('update-password') }}"
            id="updateMyPassword">
            @csrf

            <div class="row">
                <div class="col-lg-7">
                    <label class="single-input-wrap style-two">
                        <span
                            class="single-input-title mb-3">{{ __('main.change-password') }}</span>
                        <input type="password" name="old_password"
                            placeholder="{{ __('main.old-password') }}"
                            class="form-control" required>
                    </label>
                </div>
                <div class="col-lg-7">
                    <label class="single-input-wrap style-two">
                        <input type="password" name="password"
                            placeholder="{{ __('main.new-password') }}"
                            class="form-control" required>
                    </label>
                </div>
                <div class="col-lg-7">
                    <label class="single-input-wrap style-two">
                        <input type="password" name="password_confirmation"
                            placeholder="{{ __('main.confirm-new-password') }}"
                            class="form-control" required>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" onsubmit="validatePassword();"
                    class="btn btn-yellow">@lang('main.change-password')</button>
            </div>
        </form>
    </div>

      <div class="row user d-none" id="user-logout">
        <h5>{{__('main.logout')}}</h5>
      </div>
    </div>
  </div>
</div>
</main>

@push('js')
<script>
    const form = document.querySelector("#update-my-profile");
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        axios
            .post(form.action, formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((res) => {
                console.log(res.data.message);
                toastr.success(res.data.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            })
            .catch((error) => {
                console.log(error);
                toastr.error(error.response.data.message ?? '{{ __('main.unexpected-error') }}')
            });
    });
</script>
<script>
        $(document).ready(function() {
            $('#updateMyPassword').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        toastr.success(response.message);
                        $('#update-my-profile')[0].reset();
                        setTimeout(() => {
                            window.location = "{{ route('site.home') }}";

                        }, 1000);
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            });
        });
</script>
@endpush
