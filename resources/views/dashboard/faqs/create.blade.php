@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.faqs.store' ) }}" method="POST" class="page-body">
        @csrf

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Create Faq" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.faqs.index') }}">Faqs</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert />

                <div class="card tab2-card">
                    <div class="card-body needs-validation">
                        <x-dashboard.form.language-multi-tab-card tab-id="faqs">
                            @foreach(config('translatable.supported_locales') as $localKey => $local)
                                <div @class(['tab-pane fade', 'active show' => $localKey == config('app.locale')])
                                     id="{{ 'faqs-'.$localKey }}" role="tabpanel"
                                     aria-labelledby="{{ 'faqs-'.$localKey }}-tab">
                                     <x-dashboard.form.input-editor error-key="{{$localKey}}.question" name="{{$localKey}}[question]"  id="{{$localKey}}-question" label-title="Question"/>

<x-dashboard.form.input-editor error-key="{{$localKey}}.answer" name="{{$localKey}}[answer]"  id="{{$localKey}}-answer" label-title="Answer"/>


                                </div>
                            @endforeach
                        </x-dashboard.form.language-multi-tab-card>
                        <x-dashboard.form.input-select name="category_id"  :options="$relations['categories']" track-by="id"
                        option-lable="title" label-title="FAQ Category" id="categories"
                        error-key="categories" />


                        <x-dashboard.form.submit-button/>
                    </div>
                </div>

                <div class="card tab2-card mt-5">

                    <div class="card-body needs-validation">

                        <x-dashboard.form.input-checkbox resource-name="Faq" error-key="enabled" name="enabled"
                        id="enabled"
                        label-title="Enabled"/>

                        <x-dashboard.form.input-checkbox resource-name="Faq" error-key="home"
                                                name="home" id="home"
                                                label-title="Home Faq"/>


                        <x-dashboard.form.input-checkbox resource-name="Faq" error-key="important"
                        name="important" id="important"
                        label-title="important Faq"/>

                        <x-dashboard.form.submit-button/>

                    </div>

                    </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

    </form>
@endsection
