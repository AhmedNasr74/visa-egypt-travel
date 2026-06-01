@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.faq-categories.store' ) }}" method="POST" class="page-body">
        @csrf

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Create FaqCategory" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.faq-categories.index') }}">FaqCategories</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert />

                <div class="card tab2-card">
                    <div class="card-body needs-validation">
                        <x-dashboard.form.language-multi-tab-card tab-id="faq-categories">
                            @foreach(config('translatable.supported_locales') as $localKey => $local)
                                <div @class(['tab-pane fade', 'active show' => $localKey == config('app.locale')])
                                     id="{{ 'faq-categories-'.$localKey }}" role="tabpanel"
                                     aria-labelledby="{{ 'faq-categories-'.$localKey }}-tab">
                                     <x-dashboard.form.input-text error-key="{{$localKey}}.title" name="{{$localKey}}[title]"  id="{{$localKey}}-title" label-title="Title"/>


                                </div>
                            @endforeach
                        </x-dashboard.form.language-multi-tab-card>
                        <x-dashboard.form.submit-button/>
                    </div>
                </div>


                
            </div>
        </div>
        <!-- Container-fluid Ends-->

    </form>
@endsection
