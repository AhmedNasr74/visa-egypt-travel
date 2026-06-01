@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.employees.store' ) }}" method="POST" class="page-body">
        @csrf

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Create Employee" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.employees.index') }}">Employees</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert />


                <div class="card">
                    <div class="card-body">
                        <x-dashboard.form.input-text error-key="name" name="name"  id="name" label-title="Name"/>

                        <x-dashboard.form.input-text error-key="title" name="title"  id="title" label-title="Title"/>

                        <x-dashboard.form.media title="Add Image" :images="old('gallery')"
                        error-key="image" name="image"  id="image"/>
                        <x-dashboard.form.submit-button/>
                    </div>
                </div>
                <div class="card tab2-card">
                    <div class="card-body needs-validation">
                                    <div class="row color-picks">
                                        <h4>Employee Contacts</h4>
                                        <x-dashboard.form.input-text error-key="mail_link" name="mail_link"  id="mail_link" label-title="MailLink"/>

                                        <x-dashboard.form.input-text error-key="facebook_link" name="facebook_link"  id="facebook_link" label-title="FacebookLink"/>

                                        <x-dashboard.form.input-text error-key="twitter_link" name="twitter_link"  id="twitter_link" label-title="TwitterLink"/>

                                        <x-dashboard.form.input-text error-key="insta_link" name="insta_link"  id="insta_link" label-title="InstaLink"/>

                                        <x-dashboard.form.input-text error-key="linkedin_link" name="linkedin_link"  id="linkedin_link" label-title="LinkedinLink"/>

                                    </div>
                        <x-dashboard.form.submit-button />
                    </div>
                </div>



            </div>
        </div>
        <!-- Container-fluid Ends-->

    </form>
@endsection
