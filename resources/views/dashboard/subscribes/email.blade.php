@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.Send-Email' ) }}" method="POST" class="page-body">
        @csrf

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Send Email" :hideFirst="true">
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
                        <x-dashboard.form.input-text error-key="title" name="title"  id="title" label-title="Title"/>
                        <x-dashboard.form.input-text error-key="subject" name="subject"  id="subject" label-title="Subject"/>
                        <x-dashboard.form.input-editor error-key="mail" name="mail"  id="mail" label-title="Mail"/>


                        <x-dashboard.form.send-button/>
                    </div>
                </div>


            </div>
        </div>
        <!-- Container-fluid Ends-->

    </form>
@endsection
