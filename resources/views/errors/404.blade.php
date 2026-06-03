@extends('errors.layout')

@section('title', __('site.error_page_meta', ['code' => 404]) . ' — ' . config('app.name'))

@section('code', '404')

@section('heading', __('site.error_404_title'))

@section('message', __('site.error_404_message'))

@section('show_contact')

@section('actions')
    @include('errors.partials.actions')
@endsection
