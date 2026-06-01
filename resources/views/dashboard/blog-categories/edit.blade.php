@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.blog-categories.update' , $blogCategory) }}" method="POST" class="page-body">
        @csrf
        @method('PUT')

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Edit BlogCategory" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.blog-categories.index') }}">BlogCategories</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert />

                <div class="card tab2-card">
                    <div class="card-body needs-validation">
                        <x-dashboard.form.language-multi-tab-card tab-id="blog-categories">
                            @foreach(config('translatable.supported_locales') as $localKey => $local)
                                <div @class(['tab-pane fade', 'active show' => $localKey == config('app.locale')])
                                     id="{{ 'blog-categories-'.$localKey }}" role="tabpanel"
                                     aria-labelledby="{{ 'blog-categories-'.$localKey }}-tab">
                                     <x-dashboard.form.input-text error-key="{{$localKey}}.title" name="{{$localKey}}[title]" :value="$blogCategory->translateOrNew($localKey)->title" id="{{$localKey}}-title" label-title="Title"/>


                                </div>
                            @endforeach
                        </x-dashboard.form.language-multi-tab-card>
                        <x-dashboard.form.submit-button/>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        <x-dashboard.form.input-text error-key="slug"
                        name="slug"
                        :value="$blogCategory->slug"
                        id="slug" label-title="Slug"/>

                        <x-dashboard.form.input-checkbox resource-name="BlogCategory" error-key="enabled" name="enabled"
                                                                 id="enabled"
                                                                 :value="$blogCategory->enabled"
                                                                 label-title="Enabled"/>
                        <x-dashboard.form.media title="Add Featured Image"
                        :images="$blogCategory->featured_image"
                        name="featured_image"/>


                        <x-dashboard.form.submit-button/>
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
