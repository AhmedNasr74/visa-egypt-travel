@extends('errors.layout')

@section('title', __('site.error_page_meta', ['code' => 500]) . ' — ' . config('app.name'))

@section('code', '500')

@section('heading', __('site.error_500_title'))

@section('message', __('site.error_500_message'))

@section('show_contact')

@section('actions')
    @include('errors.partials.actions')
@endsection
