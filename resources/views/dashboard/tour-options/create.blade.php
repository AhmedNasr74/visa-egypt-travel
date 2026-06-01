@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.tour-options.store' ) }}" method="POST" class="page-body">
        @csrf

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Create Tour Option" :hideFirst="true">
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
                                                                 name="{{$localKey}}[name]" id="{{$localKey}}-name"
                                                                 label-title="Name"/>

                                    <x-dashboard.form.input-text error-key="{{$localKey}}.description"
                                                                 name="{{$localKey}}[description]"
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
                    <x-dashboard.form.input-select :options="\App\Enums\OptionType::all()"
                                                       error-key="Option_Type"
                                                       name="Option_Type"
                                                       id="Option_Type"
                                                     label-title="Option Type"/>
                        <div class="PAX">
                            <x-dashboard.form.input-text error-key="price_per_pax" name="price_per_pax" id="price" label-title="Price Per Pax"/>

                        </div>
                        <div class="TOUR">
                        <x-dashboard.form.input-text error-key="price_per_tour" name="price_per_tour" id="price" label-title="Price Per Tour"/>
                        </div>

                        <x-dashboard.form.media title="Add Icon" :images="old('gallery')"
                        name="icon" />

                        <input type="text" value="0" error-key="price" name="price" id="price" label-title="Price Per Tour" hidden/>

                        <x-dashboard.form.submit-button/>
                    </div>
                </div>


            </div>
        </div>
        <!-- Container-fluid Ends-->

    </form>
@endsection
@push('js')
<script>
 $(".PAX").css({"display":"none"});
$(".TOUR").css({"display":"none"});

$("#Option_Type").change(function(){
    let Option_Type = $("#Option_Type")[0];
    let Option_TypeValue = Option_Type.value;
    console.log(Option_TypeValue);
    if(Option_TypeValue == "price per tour") {
        $(".TOUR").css({"display":"block"});
        $(".PAX").css({"display":"none"});
    }
    else if (Option_TypeValue == "price per pax") {
        $(".PAX").css({"display":"block"});
        $(".TOUR").css({"display":"none"});
    }
});
</script>
@endpush
