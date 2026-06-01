@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.sliders.store' ) }}" method="POST" class="page-body">
        @csrf

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Create Slider" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.sliders.index') }}">Sliders</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid needs-validation">
            <div class="row">
                <x-dashboard.partials.message-alert/>


                <div class="card tab2-card">
                    <div class="card-body needs-validation add-product-form">

                        <x-dashboard.form.multi-tab-card
                            :tabs="['slider', 'slides']"
                            tab-id="slider-slides">


                            <div class="tab-pane fade active show"
                                 id="{{ 'slider-slides-0' }}" role="tabpanel"
                                 aria-labelledby="{{ 'slider-slides-0' }}-tab">
                                <x-dashboard.form.input-text error-key="title" name="title" id="title"
                                                             label-title="Title"/>
                                <x-dashboard.form.input-checkbox error-key="active" name="active" id="active"
                                                                 label-title="Active"/>
                            </div>


                            <div class="tab-pane fade"
                                 id="{{ 'slider-slides-1' }}" role="tabpanel"
                                 aria-labelledby="{{ 'slider-slides-1' }}-tab">

                                <div class="accordion" id="accordionExample" >
                                    <a @click.prevent="add" href="javascript:;" class="text-center mb-3 btn btn-outline-primary w-100">
                                        <i class="fa fa-plus"></i> Add Slide
                                    </a>
                                    <div v-for="(slide,index) in slides" :key="'slide-'+index" class="accordion-item">

                                        <h2 class="accordion-header" :id="'heading'+index">
                                            <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse"
                                                    :data-bs-target="'#collapse'+index"
                                                    aria-expanded="true" :aria-controls="'#collapse'+index">
                                                Slide Item #@{{ (index + 1) }}

                                            </button>

                                        </h2>

                                        <div :id="'collapse'+index" class="form accordion-collapse"
                                             :aria-labelledby="'heading'+index" data-bs-parent="#accordionExample">

                                            <div class="accordion-body">

                                                <button class="btn btn-primary w-100 mb-3" @click.prevent="remove(index)" >
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                                <div class="form-group row">
                                                    <label :for="'slides-' + index+ '-image-button'" class="col-xl-3 col-sm-4 mb-0">Select Image</label>
                                                    <div class="col-xl-8 col-sm-7">
                                                        <div class="input-group mb-3">
                                                            <input :id="'slides-' + index+ '-image-input'" :name="'slides[' + index+ '][image]'"  type="text" class="form-control" placeholder="Slide Image" aria-label="Select slide image" aria-describedby="button-addon1">
                                                            <button @click.prevent="openMedia(index)" :id="'slides-' + index+ '-image-button'" class="btn btn-outline-success" type="button">Select</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row" v-for="(locale, k) in locales">
                                                    <div class="form-group row">
                                                        <label :for="'slides-' + index+ '-title-'+k"  class="col-xl-3 col-sm-4">Title @{{ locale.name }}</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input :id="'slides-' + index+ '-image-input'" :name="'slides[' + index+ '][title]['+k+']'"  type="text" class="form-control" placeholder="Slide Title" aria-label="Slide Title">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label :for="'slides-' + index+ '-description-'+k"  class="col-xl-3 col-sm-4">Description @{{ locale.name }}</label>
                                                        <div class="col-xl-8 col-sm-7">
                                                            <input :id="'slides-' + index+ '-image-input'" :name="'slides[' + index+ '][description]['+k+']'"  type="text" class="form-control" placeholder="Slide Description" aria-label="Slide Title">
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </x-dashboard.form.multi-tab-card>


                        <br>
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
        window.locales = @json(config('translatable.supported_locales'));
        window.categories = @json($categories->toArray());
        function fmSetLink($url, target = null) {
            $(target).val($url.replace('{{ config('app.url') }}' , ''))
        }
    </script>
    <script src="{{asset('assets/admin/js/vue.js')}}"></script>
    <script src="{{asset('assets/admin/js/slides.js')}}"></script>
@endpush
