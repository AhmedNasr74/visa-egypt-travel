@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.raises.store' ) }}" method="POST" class="page-body">
        @csrf

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Create Raise" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.raises.index') }}">Raises</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert />


                <div class="card">
                    <div class="card-body">
                        <label for="type">Type:</label>
                        <select error-key="type" name="type" id="type">
                        <option value="fixed" selected>Fixed</option>
                        <option value="per_pax">Per Pax</option>
                        </select>

                        <x-dashboard.form.input-text error-key="value" name="value"  id="value" label-title="Value"/>

                        <div id="count_div">
                            <x-dashboard.form.input-text error-key="count" name="count"  id="count" label-title="Count"/>
                        </div>
                        <label for="for">Raise For:</label>
                        <select error-key="for" name="for" id="for">
                        <option value="tours" selected>Tours</option>
                        <option value="categories">Tour Category</option>
                        <option value="destinations">Tour Destinations</option>
                        </select>
                        <div id="tours">
                            <x-dashboard.form.input-select name="tours[]" multible :options="$relations['tours']" track-by="id"
                        option-lable="title" label-title="Tours" id="tours"
                        error-key="tours" />
                        </div>
                        <div id="categories">
                            <x-dashboard.form.input-select name="categories[]" multible :options="$relations['categories']" track-by="id"
                        option-lable="title" label-title="Tour Category" id="categories"
                        error-key="categories" />
                        </div>

                        <div id="destinations">
                            <x-dashboard.form.input-select name="destinations[]" multible :options="$relations['destinations']"
                                                track-by="id" option-lable="title" label-title="Tour Destinations"
                                                id="destinations" error-key="destinations" />

                        </div>

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

$(document).ready(function(){
    $('#count_div').hide();
    $('#categories').hide();
    $('#destinations').hide();
    $('#type').change(function(){
        var selectedType = $(this).val();
        if(selectedType === 'per_pax') {
            $('#count_div').show();
        } else {
            $('#count_div').hide();
        }
    });
    $('#for').change(function(){
        var selectedType = $(this).val();
        if(selectedType === 'destinations') {
            $('#destinations').show();
            $('#categories').hide();
            $('#tours').hide();
        } else if(selectedType === 'categories') {
            $('#destinations').hide();
            $('#categories').show();
            $('#tours').hide();
        }
            else{
            $('#destinations').hide();
            $('#categories').hide();
            $('#tours').show();
            }
    });
});
</script>
@endpush
