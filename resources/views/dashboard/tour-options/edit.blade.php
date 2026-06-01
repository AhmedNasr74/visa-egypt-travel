@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.tour-options.update' , $tourOption) }}" method="POST" class="page-body">
        @csrf
        @method('PUT')

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Edit Tour Option" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.tour-options.index') }}">Tour Options</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert/>

                <div class="card tab2-card">
                    <div class="card-body needs-validation">
                        <x-dashboard.form.language-multi-tab-card tab-id="tour-options">
                            @foreach(config('translatable.supported_locales') as $localKey => $local)
                                <div @class(['tab-pane fade', 'active show' => $localKey == config('app.locale')])
                                     id="{{ 'tour-options-'.$localKey }}" role="tabpanel"
                                     aria-labelledby="{{ 'tour-options-'.$localKey }}-tab">

                                    <x-dashboard.form.input-text error-key="{{$localKey}}.name"
                                                                 name="{{$localKey}}[name]"
                                                                 :value="$tourOption->translateOrNew($localKey)->name"
                                                                 id="{{$localKey}}-name" label-title="Name"/>

                                    <x-dashboard.form.input-text error-key="{{$localKey}}.description"
                                                                 name="{{$localKey}}[description]"
                                                                 :value="$tourOption->translateOrNew($localKey)->description"
                                                                 id="{{$localKey}}-description"
                                                                 label-title="Description"/>


                                </div>
                            @endforeach
                        </x-dashboard.form.language-multi-tab-card>
                        <x-dashboard.form.submit-button/>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <x-dashboard.form.media title="Add Icon" :images="$tourOption->icon"
                            name="icon" />
                        <x-dashboard.form.input-text error-key="price" name="price" :value="$tourOption->price"
                                                     id="price" label-title="Price"/>


                        <x-dashboard.form.submit-button/>
                    </div>
                </div>


            </div>
        </div>
        <!-- Container-fluid Ends-->

    </form>

    <x-dashboard.partials.resource-translation model="TourOption" :id="$tourOption->id"/>
@endsection
