
  <!--faqs & contact  sign up  newsletter-->
  @php
      $faqs=App\Models\Faq::where("important",true)->get();
  @endphp
  <section class="pb-5 newsletter">
    <div class="container-fluid">
      <div class="content p-5 px-3 rounded-3 shadow-lg bg-white">
        <div class="row g-3">
            <h2 class="textMainColor">{{ __('site.important_faqs') }}</h2>
          <div class="col-lg-12 wow slideInLeft">
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
        </div>
        <!-- </div> -->
        <div class="mt-5">
            <a href="{{route('site.faq')}}" class="mt-5">
                <button class="mainBtn text-capitalize">{{ __('site.view_more') }}</button>
              </a>
        </div>
    </div>
    </div>
  </section>
