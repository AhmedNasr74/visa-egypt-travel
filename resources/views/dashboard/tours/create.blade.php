@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.tours.store') }}" method="POST" class="page-body">
        @csrf

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Create Tour" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.tours.index') }}">Tours</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <x-dashboard.partials.message-alert />

                <div class="card tab2-card">
                    <div class="card-body needs-validation">
                        <x-dashboard.form.language-multi-tab-card tab-id="tours">
                            @foreach (config('translatable.supported_locales') as $localKey => $local)
                                <div @class([
                                    'tab-pane fade',
                                    'active show' => $localKey == config('app.locale'),
                                ]) id="{{ 'tours-' . $localKey }}" role="tabpanel"
                                    aria-labelledby="{{ 'tours-' . $localKey }}-tab">
                                    <x-dashboard.form.input-text error-key="{{ $localKey }}.title" :value="old($localKey . '.title')"
                                        name="{{ $localKey }}[title]" id="{{ $localKey }}-title"
                                        label-title="Title" />

                                    <x-dashboard.form.input-editor error-key="{{ $localKey }}.overview"
                                        name="{{ $localKey }}[overview]" id="{{ $localKey }}-overview"
                                        label-title="Overview" />

                                    <x-dashboard.form.input-text error-key="{{ $localKey }}.included"
                                        name="{{ $localKey }}[included]" class="tags-input"
                                        id="{{ $localKey }}-included" label-title="Included" />

                                    <x-dashboard.form.input-text error-key="{{ $localKey }}.excluded"
                                        name="{{ $localKey }}[excluded]" class="tags-input"
                                        id="{{ $localKey }}-excluded" label-title="Excluded" />

                                    <x-dashboard.form.input-text error-key="{{ $localKey }}.run"
                                        name="{{ $localKey }}[run]" id="{{ $localKey }}-run" label-title="Run" />




                                </div>
                            @endforeach
                        </x-dashboard.form.language-multi-tab-card>
                        <x-dashboard.form.submit-button />
                    </div>
                </div>
                <div class="card tab2-card">
                    <div class="card-body needs-validation">
                        <div class="row color-picks">
                            <h4>Duration</h4>
                            <x-dashboard.form.input-text error-key="duration" name="duration" id="duration"
                                label-title="Duration" />
                        </div>
                        <x-dashboard.form.submit-button />
                    </div>
                </div>
                <div class="card tab2-card">
                    <div class="card-body needs-validation">
                        <div class="row color-picks">
                            <h4>Min Guests</h4>
                            <x-dashboard.form.input-text error-key="guests" name="guests" id="guests"
                                label-title="Guests" />
                        </div>
                        <x-dashboard.form.submit-button />
                    </div>
                </div>
                {{-- Tour Days --}}
                <div class="card tab2-card">
                    <div class="card-body needs-validation">
                        <x-dashboard.form.language-multi-tab-card tab-id="tour-days">
                            @foreach (config('translatable.supported_locales') as $localKey => $local)
                                <div @class([
                                    'tab-pane fade',
                                    'active show' => $localKey == config('app.locale'),
                                ]) id="{{ 'tour-days-' . $localKey }}" role="tabpanel"
                                    aria-labelledby="{{ 'tour-day-' . $localKey }}-tab">
                                    <h4>Tour Days</h4>
                                    <a href="javascript:;" data-remove-text="Remove Day" data-name="days"
                                        data-local="{{ $localKey }}" data-tab-id="tour-days"
                                        data-locals="{{ implode(',', array_keys(config('translatable.supported_locales'))) }}"
                                        class="text-center mb-4 btn btn-outline-primary w-100 add-new-variant">
                                        <i class="fa fa-plus"></i> Add Day
                                    </a>
                                    <div class="row color-picks">
                                        <x-dashboard.form.input-text error-key="days.0.{{ $localKey }}.title"
                                            name="days[0][{{ $localKey }}][title]"
                                            id="days-{{ $localKey }}-title-1" label-title="Title" />

                                        <x-dashboard.form.input-editor error-key="days.0.{{ $localKey }}.description"
                                            name="days[0][{{ $localKey }}][description]"
                                            id="days-{{ $localKey }}-description-1" label-title="Description" />

                                        <x-dashboard.form.media title="Add Gallery" :images="old('tour.0.tour_day_image')"
                                            name="days[0][tour_day_image]" data-target="#tour-days-[0]" />
                                        <hr />
                                    </div>
                                </div>
                            @endforeach

                        </x-dashboard.form.language-multi-tab-card>
                        <x-dashboard.form.submit-button />
                    </div>
                </div>

                {{-- Tour Location --}}
                <div class="card tab2-card">
                    <div class="card-body needs-validation">
                        <div class="row color-picks">
                            <h4>Location</h4>
                            <x-dashboard.form.input-text error-key="location" name="location" id="location"
                                label-title="Location" />
                        </div>
                        <x-dashboard.form.submit-button />
                    </div>
                </div>
                <div class="card tab2-card">
                    <div class="card-body needs-validation">
                        <div class="row color-picks">
                            <h4>Order Show</h4>
                            <x-dashboard.form.input-text error-key="order_id" name="order_id" id="order_id"
                                label-title="Order Show" />
                        </div>
                        <x-dashboard.form.submit-button />
                    </div>
                </div>
                <div class="card tab2-card">
                    <div class="card-body needs-validation add-product-form">
                        <x-dashboard.form.multi-tab-card :tabs="['basic', 'media', 'pricing']" tab-id="basic-media-pricing-seasons">
                            <div class="tab-pane fade active show" id="{{ 'basic-media-pricing-seasons-0' }}"
                                role="tabpanel" aria-labelledby="{{ 'basic-media-pricing-seasons-0' }}-tab">


                                <x-dashboard.form.input-text error-key="slug" :value="old('slug')"
                                                             name="slug" id="slug" label-title="Slug" />

                                <x-dashboard.form.input-checkbox resource-name="Tour" error-key="enabled" name="enabled"
                                    id="enabled" label-title="Enabled" />

                                <x-dashboard.form.input-checkbox resource-name="Tour" error-key="featured"
                                    name="featured" id="featured" label-title="Featured" />
                                <x-dashboard.form.input-select name="categories[]" multible :options="$relations['categories']"
                                    track-by="id" option-lable="title" label-title="Tour Category" id="categories"
                                    error-key="categories" />


                                <x-dashboard.form.input-select name="options[]" multible :options="$relations['options']" track-by="id"
                                    option-lable="name" label-title="Tour Options" id="options" error-key="options" />

                                <x-dashboard.form.input-select name="destinations[]" multible :options="$relations['destinations']"
                                    track-by="id" option-lable="title" label-title="Tour Destinations"
                                    id="destinations" error-key="destinations" />

                            </div>

                            <div class="tab-pane fade" id="{{ 'basic-media-pricing-seasons-1' }}" role="tabpanel"
                                aria-labelledby="{{ 'basic-media-pricing-seasons-1' }}-tab">
                                <x-dashboard.form.media title="Add Featured Image" :images="old('featured_image')"
                                    name="featured_image" />
                                <x-dashboard.form.media title="Add Banner" :images="old('banner')" name="banner" />

                                <x-dashboard.form.media title="Add Gallery" :multiple="true" :images="old('gallery')"
                                    name="gallery[]" />
                            </div>

                            <div class="tab-pane fade" id="{{ 'basic-media-pricing-seasons-2' }}" role="tabpanel"
                                aria-labelledby="{{ 'basic-media-pricing-seasons-2' }}-tab">

                                <select name="tour_for" id="tour-type">
                                    <option value="{{ \App\Enums\TourPricingType::PACKAGE_GROUP->value }}">Package Group</option>
                                    <option value="{{ \App\Enums\TourPricingType::PRICING_GROUP->value }}" selected>Pricing Group</option>
                                </select>

                                <div id="pricing-tour">
                                    <x-dashboard.form.input-text error-key="adult_price" name="adult_price"
                                        id="adult_price" label-title="Adult Price" />

                                    <x-dashboard.form.input-text error-key="child_price" name="child_price"
                                        id="child_price" label-title="Child Price" />

                                    <a href="javascript:;" data-name="pricing_groups"
                                        class="add-new-variant text-center mb-4 btn btn-outline-primary w-100">
                                        <i class="fa fa-plus"></i> Add Group Pricing
                                    </a>

                                    <div class="row color-picks">

                                        <x-dashboard.form.input-number error-key="pricing_groups.0.from"
                                            name="pricing_groups[0][from]" :id="'from-1'" label-title="From" />

                                        <x-dashboard.form.input-number error-key="pricing_groups.0.to"
                                            name="pricing_groups[0][to]" :id="'to-1'" label-title="To" />

                                        <x-dashboard.form.input-text error-key="pricing_groups.0.price"
                                            name="pricing_groups[0][price]" id="price-1" label-title="Price" />
                                        <hr>
                                    </div>
                                </div>

                                <div id="package-tour" class="d-none">

                                    <x-dashboard.form.multi-tab-card :tabs="['accommodation', 'without_accommodation']"
                                        tab-id="accommodation-without_accommodation">
                                        <div class="tab-pane fade active show"
                                            id="{{ 'accommodation-without_accommodation-0' }}" role="tabpanel"
                                            aria-labelledby="{{ 'accommodation-without_accommodation-0' }}-tab">

                                            <div id="stander">
                                                <h3>stander</h3>
                                                <x-dashboard.form.input-text error-key=""
                                                    name="accommodation[stander][solo]" id="price-1"
                                                    label-title="solo" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="accommodation[stander][2-4]" id="price-1"
                                                    label-title="2-4" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="accommodation[stander][5-8]" id="price-1"
                                                    label-title="5-8" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="accommodation[stander][9-16]" id="price-1"
                                                    label-title="9-16" />
                                            </div>
                                            <hr>

                                            <div id="gold">
                                                <h3>gold</h3>

                                                <x-dashboard.form.input-text error-key=""
                                                    name="accommodation[gold][solo]" id="price-1" label-title="solo" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="accommodation[gold][2-4]" id="price-1" label-title="2-4" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="accommodation[gold][5-8]" id="price-1" label-title="5-8" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="accommodation[gold][9-16]" id="price-1" label-title="9-16" />
                                            </div>
                                            <hr>
                                            <div id="luxury">
                                                <h3>luxury</h3>

                                                <x-dashboard.form.input-text error-key=""
                                                    name="accommodation[luxury][solo]" id="price-1"
                                                    label-title="solo" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="accommodation[luxury][2-4]" id="price-1" label-title="2-4" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="accommodation[luxury][5-8]" id="price-1" label-title="5-8" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="accommodation[luxury][9-16]" id="price-1"
                                                    label-title="9-16" />
                                            </div>

                                        </div>
                                        <div class="tab-pane fade " id="{{ 'accommodation-without_accommodation-1' }}"
                                            role="tabpanel"
                                            aria-labelledby="{{ 'accommodation-without_accommodation-1' }}-tab">

                                            <div id="stander">
                                                <h3>stander</h3>
                                                <x-dashboard.form.input-text error-key=""
                                                    name="without_accommodation[stander][solo]" id="price-1"
                                                    label-title="solo" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="without_accommodation[stander][2-4]" id="price-1"
                                                    label-title="2-4" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="without_accommodation[stander][5-8]" id="price-1"
                                                    label-title="5-8" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="without_accommodation[stander][9-16]" id="price-1"
                                                    label-title="9-16" />
                                            </div>
                                            <hr>

                                            <div id="gold">
                                                <h3>gold</h3>

                                                <x-dashboard.form.input-text error-key=""
                                                    name="without_accommodation[gold][solo]" id="price-1"
                                                    label-title="solo" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="without_accommodation[gold][2-4]" id="price-1"
                                                    label-title="2-4" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="without_accommodation[gold][5-8]" id="price-1"
                                                    label-title="5-8" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="without_accommodation[gold][9-16]" id="price-1"
                                                    label-title="9-16" />
                                            </div>
                                            <hr>
                                            <div id="luxury">
                                                <h3>luxury</h3>

                                                <x-dashboard.form.input-text error-key=""
                                                    name="without_accommodation[luxury][solo]" id="price-1"
                                                    label-title="solo" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="without_accommodation[luxury][2-4]" id="price-1"
                                                    label-title="2-4" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="without_accommodation[luxury][5-8]" id="price-1"
                                                    label-title="5-8" />

                                                <x-dashboard.form.input-text error-key=""
                                                    name="without_accommodation[luxury][9-16]" id="price-1"
                                                    label-title="9-16" />
                                            </div>

                                        </div>


                                    </x-dashboard.form.multi-tab-card>

                                </div>

                            </div>
                        </x-dashboard.form.multi-tab-card>

                        <x-dashboard.form.submit-button />
                    </div>
                </div>

                {{-- Tour Extra --}}
                <div class="card tab2-card">
                    <div class="card-body needs-validation">
                        <div class="row color-picks">
                            <h4>Payments Details</h4>

                            <x-dashboard.form.input-text error-key="reward_points" name="reward_points"
                                id="reward_points" label-title="Reward Points" />

                            <x-dashboard.form.input-text error-key="deposit" name="deposit" id="deposit"
                                label-title="Deposit" />
                        </div>
                        <x-dashboard.form.submit-button />
                    </div>
                </div>

                <!--Start SEO-->
                <x-dashboard.form.seo-form />
                <!--End SEO-->

            </div>
        </div>
        <!-- Container-fluid Ends-->

    </form>
@endsection
@push('js')
    <script>
        const createEditor = (selector = '.code-editor') => {
            $(selector).tinymce({
                selector: '.code-editor',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            })
        }
        try {
            createEditor()
        } catch (error) {

        }
        $(document).ready(function() {
            $('.select2').select2();
            $('.add-new-variant').click(function() {
                $('.open-media').click(function() {
                    var target = $(this).data('target');
                    var name = $(this).data('name');
                    var multiple = $(this).attr('multiple');
                    $(this).attr('id', target);

                    window.payload = {
                        target: target,
                        name: name,
                        multiple: multiple,
                    };
                    console.log(target, name, window.payload, $(this));
                    window.openWindow('/file-manager/fm-button', 'fm');
                });

                $('.add-new-variant-season').click(function() {
                    $(".select2").select2()

                    let inputsGroupName = $(this).data('name')
                    let originalContainer = $(this).parent().find('.season:eq(0)')
                    let idInput = originalContainer.children().first()[0].outerHTML || ''
                    let idx = $(this).parent().children('.season').length + 1
                    let removeText = $(this).data('remove-text')
                    console.log($(this), originalContainer)
                    let element = originalContainer.html().replaceAll('-1', '-' + idx)
                        .replaceAll(`<br>`, `<a href="javascript:;" class="remove-variant text-center mb-4 btn btn-outline-danger w-100">
                <i class="fa fa-trash"></i> ${removeText || 'Remove Group Pricing'}
            </a>
            <br>`)
                        //old input qty generated html
                        .replaceAll(
                            `<div class="input-group-append"><span class="input-group-text bootstrap-touchspin-postfix" style="display: none;"></span></div>`,
                            '')
                        .replaceAll(
                            `<button class="btn btn-primary btn-square bootstrap-touchspin-down" type="button"><i class="fa fa-minus"></i></button>`,
                            '')
                        .replaceAll(
                            `<div class="input-group-append ml-2"><button class="btn btn-primary btn-square bootstrap-touchspin-up" type="button"><i class="fa fa-plus"></i></button></div>`,
                            '')
                        .replaceAll(
                            `<div class="input-group-append ml-0"><button class="btn btn-primary btn-square bootstrap-touchspin-up" type="button"><i class="fa fa-plus"></i></button></div>`,
                            '')
                        .replaceAll(`${inputsGroupName}[0]`, `${inputsGroupName}[${idx}]`)
                        .replaceAll(`days[0][tour_day_image]`, `days[${idx-1}][tour_day_image]`)
                        .replaceAll(`#days0tour_day_image`, `#days${idx-1}tour_day_image`)
                        .replaceAll(`        <inpseason_prices[0][to]" id="season-1-to-1" class="touchspin form-control" type="text"  style="display: block;">
`, `<input name="season_prices[${idx-1}]season[${idx-1}][to]" id="season-${idx-1}-to-${idx-1}" class="touchspin form-control" type="text" value="" style="display: block;">`)


                        .replaceAll(`days0tour_day_image`, `days${idx-1}tour_day_image`)
                        .replaceAll(`style="display: none;"`, '')
                        .replaceAll(`aria-hidden="true"`, '')
                    console.log($(this), originalContainer)

                    if (idInput.includes('hidden')) {
                        element = element.replaceAll(idInput, '')
                    }

                    originalContainer.parent().append(
                        `<div class="row color-picks season">${element}</div>`)
                    let recentlyCreated = originalContainer.parent().children('.season').last()
                    recentlyCreated.find('.tox.tox-tinymce').remove()
                    recentlyCreated.find('input,textarea').val('')
                    setTimeout(() => {
                        createEditor('.code-editor')
                        // $('.code-editor').hide()
                    }, 250);
                    $('.color-box input').change(function() {
                        $(this).parent().find('span').css("background-color", $(this).val())
                    })
                    $(".touchspin").TouchSpin({
                        buttondown_class: "btn btn-primary btn-square",
                        buttonup_class: "btn btn-primary btn-square",
                        buttondown_class: "btn btn-primary btn-square",
                        buttonup_class: "btn btn-primary btn-square",
                        buttondown_txt: '<i class="fa fa-minus"></i>',
                        buttonup_txt: '<i class="fa fa-plus"></i>'
                    })
                    $('.remove-variant').on('click', function() {
                        $(this).parent().remove()
                    })
                })

            });

            function fmSetLink($url, target = null, name = null) {
                if (!window.payload.multiple) {
                    $(target).find('.card.image-box').remove();
                }

                $(target).append(`
                <div class="card image-box m-5">
                    <input type="hidden" ${name ? 'name=' + name : ''} value="${$url}">
                    <img src="${$url}" class="card-img-top" alt="...">
                    <a href="javascript:;" class="btn btn-remove btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                </div>
            `);

                $(document).off('click', '.image-box .btn-remove').on('click', '.image-box .btn-remove',
                    function() {
                        $(this).parent().remove();
                    });
            }


        });
    </script>
@endpush

@push('js')
    <script>
        $('.add-first-variant-season').click(function() {
            console.log($(this))
            $(this).removeClass("add-first-variant-season")
            let inputsGroupName = $(this).data('name')
            let originalContainer = $(this).parent().find('.season:eq(0)')
            let idInput = originalContainer.children().first()[0].outerHTML || ''
            let idx = $(this).parent().children('.season').length + 1
            let removeText = $(this).data('Remove Group Pricing')
            console.log($(this), originalContainer)
            let element = originalContainer.html().replaceAll('-1', '-' + idx)
                .replaceAll(`<br>`, `<a href="javascript:;" class="remove-variant text-center mb-4 btn btn-outline-danger w-100">
                <i class="fa fa-trash"></i> ${removeText || 'Remove Group Pricing'}
            </a>
            <br>`)
                //old input qty generated html
                .replaceAll(
                    `<div class="input-group-append"><span class="input-group-text bootstrap-touchspin-postfix" style="display: none;"></span></div>`,
                    '')
                .replaceAll(
                    `<button class="btn btn-primary btn-square bootstrap-touchspin-down" type="button"><i class="fa fa-minus"></i></button>`,
                    '')
                .replaceAll(
                    `<div class="input-group-append ml-2"><button class="btn btn-primary btn-square bootstrap-touchspin-up" type="button"><i class="fa fa-plus"></i></button></div>`,
                    '')
                .replaceAll(
                    `<div class="input-group-append ml-0"><button class="btn btn-primary btn-square bootstrap-touchspin-up" type="button"><i class="fa fa-plus"></i></button></div>`,
                    '')
                .replaceAll(`${inputsGroupName}[0]`, `${inputsGroupName}[${idx}]`)
                .replaceAll(`days[0][tour_day_image]`, `days[${idx-1}][tour_day_image]`)
                .replaceAll(`add-first-variant-season`, ``)
                .replaceAll(`#days0tour_day_image`, `#days${idx-1}tour_day_image`)
                .replaceAll(`        <inpseason_prices[0][to]" id="season-1-to-1" class="touchspin form-control" type="text"  style="display: block;">
`, `<input name="season_prices[${idx-1}]season[${idx-1}][to]" id="season-${idx-1}-to-${idx-1}" class="touchspin form-control" type="text" value="" style="display: block;">`)


                .replaceAll(`days0tour_day_image`, `days${idx-1}tour_day_image`)
                .replaceAll(`style="display: none;"`, '')
                .replaceAll(`aria-hidden="true"`, '')
            console.log($(this), originalContainer)

            if (idInput.includes('hidden')) {
                element = element.replaceAll(idInput, '')
            }

            originalContainer.parent().append(`<div class="row color-picks season">${element}</div>`)
            let recentlyCreated = originalContainer.parent().children('.season').last()
            recentlyCreated.find('.tox.tox-tinymce').remove()
            recentlyCreated.find('input,textarea').val('')
            setTimeout(() => {
                createEditor('.code-editor')
                // $('.code-editor').hide()
            }, 250);
            $('.color-box input').change(function() {
                $(this).parent().find('span').css("background-color", $(this).val())
            })
            $(".touchspin").TouchSpin({
                buttondown_class: "btn btn-primary btn-square",
                buttonup_class: "btn btn-primary btn-square",
                buttondown_class: "btn btn-primary btn-square",
                buttonup_class: "btn btn-primary btn-square",
                buttondown_txt: '<i class="fa fa-minus"></i>',
                buttonup_txt: '<i class="fa fa-plus"></i>'
            })
            $('.remove-variant').on('click', function() {
                $(this).parent().remove()
            })
        })
    </script>
@endpush
@push('js')
    <script>
        function Check(input) {
            var parent = input.parentNode;
            var siblings = Array.from(parent.childNodes).filter(function(node) {
                return node.nodeType === 1 && node !== input;
            });
            var thirdSibling = siblings[2];
            var inputs = thirdSibling.querySelectorAll('input[type="checkbox"]');
            var isChecked = input.checked;
            inputs.forEach(function(input) {
                input.checked = isChecked;
            });
        }
    </script>
    <script>
        $("#tour-type").on('change', function() {
            $("#" + $(this).val()).removeClass("d-none");
            $("#" + $(this).val()).siblings('div').addClass("d-none")
        })
    </script>
@endpush
