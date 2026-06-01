@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.pages.update' , $page) }}" method="POST" class="page-body">
        @csrf
        @method('PUT')

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Edit Page" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.pages.index') }}">Pages</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert/>


                <div class="card">
                    <div class="card-body">
                        <x-dashboard.form.input-text error-key="key" readonly name="key" :value="$page->key" id="key"
                                                     label-title="Key"/>
                        <x-dashboard.form.submit-button/>
                    </div>
                </div>

                @includeIf("dashboard.pages.meta.{$page->key}.index", ['page' => $page])

                <!--Start SEO-->
                <x-dashboard.form.seo-form/>
                <!--End SEO-->

            </div>
        </div>
        <!-- Container-fluid Ends-->

    </form>
@endsection
