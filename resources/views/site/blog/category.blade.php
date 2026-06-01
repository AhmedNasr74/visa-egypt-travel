@extends('layouts.site.app')

@section('content')
<style>
    .select2-container .select2-selection--single {
        max-width: 61px;
        height: 50px;
    }      /* section banner  */
  .banner figure {
    background: linear-gradient(150deg, #00000093 40%, #00000018 70%),
      url("{{$category->featured_image}}");
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
    height: 50vh;
    transition: all 1s;
  }
  .banner figcaption {
    top: 80%;
    left: 50%;
    transform: translate(-50%, -80%);
  }

  .banner figure:hover {
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
    background: linear-gradient(150deg, #00000018 40%, #00000018 70%),
      url("{{$category->featured_image}}");
  }

  </style>
    <section class="banner">
      <div class="container-fluid">
        <figure class="position-relative">
          <figcaption class="position-absolute">
            <div class="text-capitalize">
              <h2 class="text-white">
                @if($category)
                {{$category->title}}
                @else
                {{$tag}}
                @endif
            </h2>
              <p class="text-white">
                <a href="{{route("site.home")}}">
                    <span class="textMainColor me-1">{{ __('main.home') }}</span>
                </a>                > @if($category)
                {{$category->title}}
                @else
                {{$tag}}
                @endif
              </p>
            </div>
          </figcaption>
        </figure>
      </div>
    </section>

    <section class="blog">
      <div class="container">
        <div class="mt-5">
          <div class="row mt-4 justify-content-between g-4">
            <div class="col-lg-8">
             @foreach ($blogs as $blog)

             <div class="mb-5">
                <figure>
                  <img
                    src="{{$blog->featured_image}}"
                    class="w-100 rounded-3"
                    alt="blog details image"
                  />
                </figure>

                <div class="d-flex mt-4 flex-wrap">
                  <div class="me-3">
                    <i
                      class="fa-regular fa-calendar-days textMainColor me-1"
                    ></i>
                    <span class="text-muted">{{$blog->created_at->format('Y-m-d')}}</span>
                  </div>
                  <div class="me-3">
                    <i class="fa-regular fa-comments textMainColor me-1"></i>
                    <span class="text-muted">Comments(03)</span>
                  </div>
                  <div class="me-3">
                    <i class="fa fa-clock-four textMainColor me-1"></i>
                    @php
                        $diffInMinutes = $now->diffInMinutes($blog->created_at);
                        if ($diffInMinutes >= 60) {
                            $diffInHours = floor($diffInMinutes / 60);
                            if ($diffInHours >= 24) {
                                $diffInDays = floor($diffInHours / 24);
                                echo "<span class=\"text-muted\">Created " . $diffInDays . " days ago</span><br>";
                            } else {
                                echo "<span class=\"text-muted\">Created " . $diffInHours . " hours ago</span><br>";
                            }
                        } else {
                            echo "<span class=\"text-muted\">Created " . $diffInMinutes . " minutes ago</span><br>";
                        }

                    @endphp
                  </div>
                </div>

                <div>
                  <h4 class="h2 my-3">
                    {{$blog->title}}
                </h4>
                  <p class="text-muted mb-4">
                    {{substr(strip_tags($blog->description), 0, 250) }}.....
                                  </p>

                  <a href="{{route('site.blog-details',$blog->id)}}">
                    <button
                      class="text-uppercase btn secBtn py-2 textMainColor"
                    >
                      read more
                      <i class="fa fa-arrow-trend-up ms-2 font-s fa-bounce"></i>
                    </button>
                  </a>
                </div>
              </div>

             @endforeach
              <div class="pagination d-flex justify-content-center flex-wrap my-5 pt-3">
                @if ($blogs->onFirstPage())
                  <span class="btn secBtn me-2 px-3 mb-2 disabled" aria-disabled="true">
                    <i class="fa-solid fa-angles-left"></i>
                  </span>
                @else
                  <a class="btn secBtn me-2 px-3 mb-2" href="{{ $blogs->previousPageUrl() }}">
                    <i class="fa-solid fa-angles-left"></i>
                  </a>
                @endif

                @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                  <a class="btn secBtn me-2 px-3 mb-2{{ $blogs->currentPage() == $page ? ' active' : '' }}" href="{{ $url }}">{{ $page }}</a>
                @endforeach

                @if ($blogs->hasMorePages())
                  <a class="btn secBtn me-2 px-3 mb-2" href="{{ $blogs->nextPageUrl() }}">
                    <i class="fa-solid fa-angles-right"></i>
                  </a>
                @else
                  <span class="btn secBtn me-2 px-3 mb-2 disabled" aria-disabled="true">
                    <i class="fa-solid fa-angles-right"></i>
                  </span>
                @endif
              </div>

            </div>

            <!-- Aside bar -->
            <div class="col-lg-4">
              <div class="sideBar bgEEE py-5 px-4 rounded-3 heightFit">
                <h4
                  class="text-capitalize fw-semibold mb-3 border-3 border-start ps-3 border-success"
                >
                {{__('main.search')}}
                </h4>
                <input
                  type="text"
                  placeholder="Search here..."
                  class="form-control"
                />
              </div>

              <div class="recentNews mt-5 py-5 ps-4 rounded-3 heightFit shadow">
                <h4
                  class="text-capitalize fw-semibold mb-3 border-3 border-start ps-3 border-success"
                >
                  recent news
                </h4>

                <div class="row">
                    @foreach ($last_blogs as $indes=>$blog)
                    <div class="col-5">
                        <a href="{{route('site.blog-details',$blog->id)}}">
                            <figure>
                                <img
                                  src="{{$blog->featured_image}}"
                                  class="w-100 rounded-3"
                                  alt="receent news image"
                                />
                              </figure>
                        </a>
                      </div>
                      <div class="col-7">
                        {{$blog->title}}
                      </div>
                    @endforeach


                </div>
              </div>

              <div class="catagories mt-5 py-5 px-4 rounded-3 heightFit bgEEE">
                <h4
                  class="text-capitalize fw-semibold mb-3 border-3 border-start ps-3 border-success"
                >
                {{__('main.category')}}
                </h4>

                <ul class="list-unstyled">
                  @foreach ($categories as $cat )
                  <a href="{{route('site.blog-category',$cat->id)}}">
                    <li
                    class="d-flex justify-content-between secBtn text-capitalize mb-3"
                  >
                    {{$cat->title}}
                    <span>{{$cat->blogs->count()}}</span>
                  </li>
                 </a>
                  @endforeach
                </ul>
              </div>

              <div class="populerTag mt-5 py-5 px-4 rounded-3 heightFit bgEEE">
                <h4
                  class="text-capitalize fw-semibold mb-3 border-3 border-start ps-3 border-success"
                >
                  populer tags
                </h4>

                <div class="pTags">
                    @foreach ($popularTags as $key=>$tag)
                    <a href="{{route('site.tag-details',$key)}}" class="">
                        <button class="btn secBtn shadow text-capitalize ms-2">
                            {{$key}}
                        </button>
                    </a>
                @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection
@push('js')

@endpush
