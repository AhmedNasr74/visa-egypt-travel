@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.discounts.update' , $discount) }}" method="POST" class="page-body">
        @csrf
        @method('PUT')

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Edit Discount" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.discounts.index') }}">Discounts</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert />


                <div class="card">
                    <div class="card-body">
                        <input type="text" hidden name="type_check" id="type_check" value="{{$discount->count}}">
                        <label for="type">Type:</label>
                        <select error-key="type" name="type" id="type">
                        <option value="fixed" @if (!$discount->count)
                            selected
                        @endif>Fixed</option>
                        <option value="per_pax"
                        @if ($discount->count)
                        selected
                        @endif
                        >Per Pax</option>
                        </select>
<x-dashboard.form.input-text error-key="value" name="value" :value="$discount->value" id="value" label-title="Value"/>
<div id="count_div">

<x-dashboard.form.input-text error-key="count" name="count" :value="$discount->count" id="count" label-title="Count"/>
</div>
<label for="for">Discount For:</label>
<select error-key="for" name="for" id="for">
    <option value="tours" @if ($discount->tours->isNotEmpty()) selected @endif>Tours</option>
    <option value="categories" @if ($discount->categories->isNotEmpty()) selected @endif>Tour Category
    </option>
    <option value="destinations" @if ($discount->destinations->isNotEmpty()) selected @endif>Tour Destinations
    </option>
</select>
<div id="tours">
    <x-dashboard.form.input-select :value="$discount->tours->pluck('id')->toArray()" name="tours[]" multible :options="$relations['tours']"
        track-by="id" option-lable="title" label-title="Tours" id="tours" error-key="tours" />
</div>
<div id="categories">
    <x-dashboard.form.input-select :value="$discount->categories->pluck('id')->toArray()" name="categories[]" multible :options="$relations['categories']"
        track-by="id" option-lable="title" label-title="Tour Category" id="categories"
        error-key="categories" />
</div>

<div id="destinations">
    <x-dashboard.form.input-select :value="$discount->destinations->pluck('id')->toArray()" name="destinations[]" multible
        :options="$relations['destinations']" track-by="id" option-lable="title" label-title="Tour Destinations"
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
$(document).ready(function() {
            check($('#for').val())

            if ($('#type_check').val() === '') {
                $('#count_div').hide();
            }
            $('#type').change(function() {
                var selectedType = $(this).val();
                if (selectedType === 'per_pax') {
                    $('#count_div').show();
                } else {
                    $('#count_div').hide();
                }
            });
            $('#for').change(function(){
                check($(this).val());
            })

            function check(selectedType) {
                if (selectedType === 'destinations') {
                    $('#destinations').show();
                    $('#categories').hide();
                    $('#tours').hide();
                } else if (selectedType === 'categories') {
                    $('#destinations').hide();
                    $('#categories').show();
                    $('#tours').hide();
                } else {
                    $('#destinations').hide();
                    $('#categories').hide();
                    $('#tours').show();
                }
            }
        });
</script>
@endpush
