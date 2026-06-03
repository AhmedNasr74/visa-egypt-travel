@extends('layouts.site.app')

@section('content')
    <!-- ================= Main Banner start ========================= -->
    {{-- @include('site.home.sections.main_banner') --}}
    @include('site.home.sections.first_section')
    @include('site.home.sections.second_section')

    <!-- ========================= End Main Banner Section ============================ -->

    <!-- ================= Destination start ========================= -->
    {{-- @include('site.home.sections.destination') --}}
    <!-- ========================= End Destination  Section ============================ -->

    <!-- =================  start  offer packages========================= -->

        @include('site.home.sections.offers')

        @include('site.home.sections.offers2')

    <!-- ========================= End  Section ============================ -->
    @include('site.home.sections.appointment')

    @include('site.home.sections.book-with-confidant')

    @include('site.home.sections.faq_contact')

    @include('site.home.sections.newsletter')

    @include('site.home.sections.blogs')

    <!-- ================= packages start ========================= -->
    <!-- ========================= End packages  Section ============================ -->

@endsection
