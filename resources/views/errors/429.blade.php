@extends('errors.layout')

@section('title', __('site.error_page_meta', ['code' => 429]) . ' — ' . config('app.name'))

@section('code', '429')

@section('heading', __('site.error_429_title'))

@section('message', __('site.error_429_message'))

@section('actions')
    @include('errors.partials.actions')
@endsection
