
  <!--faqs & contact  sign up  newsletter-->
  <section class="pb-5 newsletter">
    <div class="container-fluid">
      <div class="content p-5 px-3 rounded-3 shadow-lg bg-white">
        <div class="row g-3">
          <div class="col-lg-6 wow slideInLeft">
            <div class="row g-3 bg-white rounded-3">
              @forelse ($faqs as $i=>$faq)
              <div class="col-12">
                <div class="shadow p-3 rounded-3">
                  <div
                    class="problemInfo d-flex justify-content-between align-items-center"
                  >
                    <h3 class="h6 text-capitalize fw-semibold textMainColor">
                        {!! $faq->question !!}
                    </h3>
                    <i class="fa fw-bold cPointer fa-plus plus @if ($i==0)
                        d-none
                    @endif"></i>
                    <i
                      class="fa fw-bold cPointer fa-minus minus @if ($i>0)
                        d-none
                    @endif textMainColor"
                    ></i>
                  </div>
                  <div class="row problemDesc mt-2 @if ($i>0)
                        d-none
                    @endif">
                    <div class="col-12">
                      <div>
                       {!! $faq->answer !!}
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              @empty

              @endforelse
            </div>
          </div>
          <div class="col-lg-6 wow slideInDown">
            <div class="p-2 px-3 bgMainColor rounded-3 h-100">
              <div class="title mb-2 text-white">
                <span class="specialFont text-capitalize h2">contact us</span>
                <h2 class="text-capitalize fw-bold h1">keep in touch</h2>
              </div>
              <form id="home-contact-form" action="{{ route('site.con-store') }}" method="POST" class="row">
                @csrf
                <input type="hidden" name="type" value="Booking">
                <div class="col-md-6">
                  <input
                    type="text"
                    name="name"
                    required
                    class="form-control mb-3 text-capitalize bg-transparent border-0 border-bottom text-white"
                    placeholder="first name"
                  />
                </div>
                <div class="col-md-6">
                  <input
                    type="text"
                    name="subject"
                    required
                    class="form-control mb-3 text-capitalize bg-transparent border-0 border-bottom text-white"
                    placeholder="how can i help you?"
                  />
                </div>
                <div class="col-md-6">
                  <input
                    type="email"
                    name="email"
                    required
                    class="form-control mb-3 text-capitalize bg-transparent border-0 border-bottom text-white"
                    placeholder="your email"
                  />
                </div>
                <div class="col-md-6">
                  <input
                    type="tel"
                    name="phone"
                    required
                    class="form-control mb-3 text-capitalize bg-transparent border-0 border-bottom text-white"
                    placeholder="mobile number"
                  />
                </div>
                <div class="col-12">
                  <textarea
                    name="message"
                    required
                    rows="3"
                    class="form-control mb-3 text-capitalize bg-transparent border-0 border-bottom text-white"
                    placeholder="your message"
                  ></textarea>
                </div>
                <div>
                  <button type="submit" class="secBtn border my-4">Booking</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- </div> -->
      </div>
    </div>
  </section>

  @push("js")
      <script>
        $('#home-contact-form').on('submit', function (e) {
          e.preventDefault();
          const $form = $(this);
          const $btn = $form.find('button[type="submit"]');
          $btn.prop('disabled', true);

          axios.post($form.attr('action'), $form.serialize(), {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
          }).then((res) => {
            toastr.success(res.data.message);
            $form[0].reset();
          }).catch((error) => {
            const msg = error.response?.data?.message
              ?? error.response?.data?.error
              ?? '{{ __('main.unexpected-error') }}';
            toastr.error(msg);
          }).finally(() => {
            $btn.prop('disabled', false);
          });
        });

        // faqs

$(function () {
  $(".problemInfo .plus").on("click", function () {
    $(".problemDesc").addClass("d-none");
    $(this).parent().siblings().removeClass("d-none");
    $(".minus").addClass("d-none").addClass("textMainColor");
    $(".plus").removeClass("d-none");
    $(this).parent().find(".plus").addClass("d-none");
    $(this).parent().find(".minus").removeClass("d-none");
    $(".problemInfo h3").removeClass("textMainColor");
    $(this).parent().find("h3").addClass("textMainColor");
  });
  $(".problemInfo .minus").on("click", function () {
    $(".problemDesc").addClass("d-none");
    $(this).parent().siblings().removeClass("d-none");
    $(".minus").addClass("d-none").addClass("textMainColor");
    $(".plus").removeClass("d-none");
    $(this).parent().find("h3").removeClass("textMainColor");
    $(this).parent().siblings().toggleClass("d-none");
    $(".minus").addClass("d-none");
    $(".plus").removeClass("d-none");
  });
});
      </script>
  @endpush
