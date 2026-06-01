@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.blogs.update' , $blog) }}" method="POST" class="page-body">
        @csrf
        @method('PUT')

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Edit Blog" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.blogs.index') }}">Blogs</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert />

                <div class="card tab2-card">
                    <div class="card-body needs-validation">
                        <x-dashboard.form.language-multi-tab-card tab-id="blogs">
                            @foreach(config('translatable.supported_locales') as $localKey => $local)
                                <div @class(['tab-pane fade', 'active show' => $localKey == config('app.locale')])
                                     id="{{ 'blogs-'.$localKey }}" role="tabpanel"
                                     aria-labelledby="{{ 'blogs-'.$localKey }}-tab">
                                     <x-dashboard.form.input-text error-key="{{$localKey}}.title" name="{{$localKey}}[title]" :value="$blog->translateOrNew($localKey)->title" id="{{$localKey}}-title" label-title="Title"/>

<x-dashboard.form.input-editor error-key="{{$localKey}}.description" name="{{$localKey}}[description]" :value="$blog->translateOrNew($localKey)->description" id="{{$localKey}}-description" label-title="Description"/>


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
                        :value="$blog->slug"
                        id="slug" label-title="Slug"/>

                        <x-dashboard.form.input-checkbox resource-name="Blog" error-key="enabled" name="enabled"
                                                                 id="enabled"
                                                                 :value="$blog->enabled"
                                                                label-title="Enabled"/>
                        <x-dashboard.form.input-text error-key="tags"
                        name="tags" class="tags-input" :value="$blog->tags"
                        id="tags" label-title="Tags" />

                        <x-dashboard.form.input-select name="categories[]" multible :options="$relations['categories']" track-by="id"
                        :value="$blog->category->pluck('id')->toArray()"
                        option-lable="title" label-title="Tour Category" id="categories"
                    error-key="categories" />
                        <x-dashboard.form.media title="Add Featured Image"
                        :images="$blog->featured_image"
                        name="featured_image"/>
                        <x-dashboard.form.media title="Add Gallery" :multiple="true"
                        :images="$blog->gallery"
                        name="gallery[]"/>

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
