@extends('errors.layout')

@section('title', __('site.error_page_meta', ['code' => 403]) . ' — ' . config('app.name'))

@section('code', '403')

@section('heading', __('site.error_403_title'))

@section('message', __('site.error_403_message'))

@section('actions')
    @include('errors.partials.actions')
@endsection
