@extends('layouts.site.app')

@section('content')
    <!-- ================= Day Tour start ========================= -->
    @include('site.destination-category.sections.banner')

    <div class="tour-list-area pd-top-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-8 order-lg-12">
                    <div class="tour-list-area">
                        <div class="row">
                            @forelse ($tours as $tour)
                                <div class="col-md-4">
                                    <x-site.top_tour :tour="$tour"/>
                                </div>
                            @empty
                                <div class="alert w-100 alert-danger">
                                    {{ __('main.no-matching-results') }}
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="text-md-center text-left">
                        <x-site.partials.pagination :items="$tours"/>
                    </div>
                </div>
                @include('site.destination-category.sections.sidebar')
            </div>
        </div>
    </div>
    <!-- ========================= End Day Tour Section ============ -->
@endsection
