@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.pages.store' ) }}" method="POST" class="page-body">
        @csrf

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Create Page" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.pages.index') }}">Pages</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert />

                <div class="card tab2-card">
                    <div class="card-body needs-validation">
                        <x-dashboard.form.language-multi-tab-card tab-id="pages">
                            @foreach(config('translatable.supported_locales') as $localKey => $local)
                                <div @class(['tab-pane fade', 'active show' => $localKey == config('app.locale')])
                                     id="{{ 'pages-'.$localKey }}" role="tabpanel"
                                     aria-labelledby="{{ 'pages-'.$localKey }}-tab">
                                     <x-dashboard.form.input-text error-key="{{$localKey}}.content" name="{{$localKey}}[content][header]"  id="{{$localKey}}-content-header" label-title="Header"/>
                                     <x-dashboard.form.input-editor error-key="{{$localKey}}.content" name="{{$localKey}}[content][des]"  id="{{$localKey}}-content-des" label-title="Description"/>

                                </div>

                            @endforeach
                        </x-dashboard.form.language-multi-tab-card>

                        <x-dashboard.form.submit-button/>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <x-dashboard.form.input-text error-key="key" name="key"  id="key" label-title="Key"/>


                        <x-dashboard.form.submit-button/>home
                    </div>
                </div>

                <!--Start SEO-->
<x-dashboard.form.seo-form  />
<!--End SEO-->

            </div>
        </div>
        <!-- Container-fluid Ends-->

    </form>
@endsection
