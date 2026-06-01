@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.comments.store' ) }}" method="POST" class="page-body">
        @csrf

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Create Comment" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.comments.index') }}">Comments</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert />


                <div class="card">
                    <div class="card-body">


                        <x-dashboard.form.input-select name="blog_id"  :options="$relations['blogs']" track-by="id"
                        option-lable="title" label-title="Blog " id="blogs"
                        error-key="blogs" />      
                         <x-dashboard.form.input-select name="tour_id"  :options="$relations['tours']" track-by="id"
                        option-lable="title" label-title="Tour " id="tours"
                        error-key="tours" />
<x-dashboard.form.input-text error-key="comment" name="comment"  id="comment" label-title="Comment"/>

<x-dashboard.form.input-text error-key="email" name="email"  id="email" label-title="Email"/>

<x-dashboard.form.input-text error-key="first_name" name="first_name"  id="first_name" label-title="FirstName"/>



                        <x-dashboard.form.submit-button/>
                    </div>
                </div>


            </div>
        </div>
        <!-- Container-fluid Ends-->

    </form>
@endsection
