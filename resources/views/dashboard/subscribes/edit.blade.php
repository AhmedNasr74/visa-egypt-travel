@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.subscribes.update' , $subscribe) }}" method="POST" class="page-body">
        @csrf
        @method('PUT')

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Edit Subscribe" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.subscribes.index') }}">Subscribes</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert />

                
                <div class="card">
                    <div class="card-body">
                        <x-dashboard.form.input-text error-key="email" name="email" :value="$subscribe->email" id="email" label-title="Email"/>


                        <x-dashboard.form.submit-button/>
                    </div>
                </div>

                
            </div>
        </div>
        <!-- Container-fluid Ends-->

    </form>
@endsection
