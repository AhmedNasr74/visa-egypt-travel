@extends('errors.layout')

@section('title', __('site.error_page_meta', ['code' => 503]) . ' — ' . config('app.name'))

@section('code', '503')

@section('heading', __('site.error_503_title'))

@section('message', __('site.error_503_message'))

@section('actions')
    <button type="button" class="btn mainBtn px-4 py-2" onclick="window.location.reload()">
        <i class="bx bx-revision me-1"></i>{{ __('site.error_refresh_page') }}
    </button>
    <a href="{{ route('site.home') }}" class="btn btn-outline-secondary px-4 py-2">
        {{ __('site.error_back_home') }}
    </a>
@endsection
