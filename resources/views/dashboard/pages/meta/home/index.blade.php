<div class="card tab2-card">
    <div class="card-body needs-validation">
        <x-dashboard.form.language-multi-tab-card tab-id="pages">
            @foreach(config('translatable.supported_locales') as $localKey => $local)
                <div @class(['tab-pane fade', 'active show' => $localKey == config('app.locale')])
                     id="{{ 'pages-'.$localKey }}" role="tabpanel"
                     aria-labelledby="{{ 'pages-'.$localKey }}-tab">
                    <h4>Why Choose Us</h4>

                    <x-dashboard.form.input-textarea error-key="data.description.{{$localKey}}"
                                                 :rows="3"
                                                 name="data[description][{{ $localKey }}]"
                                                 id="data.description.{{$localKey}}"
                                                 :value="$page->data['description'][$localKey] ?? null"
                                                 label-title="Description"/>

                    <x-dashboard.form.input-text error-key="data.first_item.title.{{$localKey}}"
                                                     name="data[first_item][title][{{ $localKey }}]"
                                                     id="data.first_item.title.{{$localKey}}"
                                                     :value="$page->data['first_item']['title'][$localKey] ?? null"
                                                     label-title="First Item Title"/>


                    <x-dashboard.form.input-text error-key="data.first_item.description.{{$localKey}}"
                                                 name="data[first_item][description][{{ $localKey }}]"
                                                 id="data.first_item.description.{{$localKey}}"
                                                 :value="$page->data['first_item']['description'][$localKey] ?? null"
                                                 label-title="First Item Description"/>

                    <x-dashboard.form.input-text error-key="data.second_item.title.{{$localKey}}"
                                                 name="data[second_item][title][{{ $localKey }}]"
                                                 id="data.second_item.title.{{$localKey}}"
                                                 :value="$page->data['second_item']['title'][$localKey] ?? null"
                                                 label-title="Second Item Title"/>


                    <x-dashboard.form.input-text error-key="data.second_item.description.{{$localKey}}"
                                                 name="data[second_item][description][{{ $localKey }}]"
                                                 id="data.second_item.description.{{$localKey}}"
                                                 :value="$page->data['second_item']['description'][$localKey] ?? null"
                                                 label-title="Second Item Description"/>

                </div>

            @endforeach



                <x-dashboard.form.media title="Section Main Image"
                                        :images="old('data.main_section_image', $page->data['main_section_image'] ?? null)"
                                        name="data[main_section_image]"/>


                <x-dashboard.form.media title="First Item Icon"
                                        :images="old('data.first_item.icon', $page->data['first_item']['icon'] ?? null)"
                                        name="data[first_item][icon]"/>


                <x-dashboard.form.media title="Second Item Icon"
                                        :images="old('data.second_item.icon', $page->data['second_item']['icon'] ?? null)"
                                        name="data[second_item][icon]"/>

        </x-dashboard.form.language-multi-tab-card>

        <x-dashboard.form.submit-button/>
    </div>
</div>
