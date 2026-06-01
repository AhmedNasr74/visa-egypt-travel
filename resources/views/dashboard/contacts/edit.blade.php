@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.contacts.update' , $contact) }}" method="POST" class="page-body">
        @csrf
        @method('PUT')

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Edit Contact" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.contacts.index') }}">Contacts</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert />

                
                <div class="card">
                    <div class="card-body">
                        <x-dashboard.form.input-text error-key="name" name="name" :value="$contact->name" id="name" label-title="Name"/>

<x-dashboard.form.input-text error-key="email" name="email" :value="$contact->email" id="email" label-title="Email"/>

<x-dashboard.form.input-text error-key="subject" name="subject" :value="$contact->subject" id="subject" label-title="Subject"/>

<x-dashboard.form.input-text error-key="phone" name="phone" :value="$contact->phone" id="phone" label-title="Phone"/>

<x-dashboard.form.input-text error-key="type" name="type" :value="$contact->type" id="type" label-title="Type"/>

<x-dashboard.form.input-editor error-key="message" name="message" :value="$contact->message" id="message" label-title="Message"/>


                        <x-dashboard.form.submit-button/>
                    </div>
                </div>

                
            </div>
        </div>
        <!-- Container-fluid Ends-->

    </form>
@endsection
