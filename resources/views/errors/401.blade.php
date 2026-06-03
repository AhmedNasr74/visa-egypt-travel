@extends('errors.layout')

@section('title', __('site.error_page_meta', ['code' => 401]) . ' — ' . config('app.name'))

@section('code', '401')

@section('heading', __('site.error_401_title'))

@section('message', __('site.error_401_message'))

@section('actions')
    <a href="{{ route('login-page') }}" class="btn mainBtn px-4 py-2">
        <i class="bx bx-log-in me-1"></i>{{ __('site.login') }}
    </a>
    <a href="{{ route('site.home') }}" class="btn btn-outline-secondary px-4 py-2">
        {{ __('site.error_back_home') }}
    </a>
@endsection
