@extends('layouts.dashboard.app')

@section('content')
    <form action="{{ route('dashboard.settings.update' ) }}" method="POST" class="page-body">
        @csrf
        @method('PUT')

        <!-- Container-fluid starts-->
        <x-dashboard.partials.breadcrumb title="Settings" :hideFirst="true">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.settings.show') }}">Settings</a>
            </li>
        </x-dashboard.partials.breadcrumb>
        <!-- Container-fluid Ends-->


        <!-- Container-fluid starts-->
        <div class="container-fluid" id="settings-app">
            <div class="row">
                <x-dashboard.partials.message-alert/>
                <div class="card tab2-card">
                    <div class="card-body needs-validation">
                        <x-dashboard.form.multi-tab-card
                            :tabs="['basic','notifications', 'social-links', 'custom-css', 'homepage','details','gallery']"
                            tab-id="settings">

                            <div class="tab-pane fade active show"
                                 id="{{ 'settings-0' }}" role="tabpanel"
                                 aria-labelledby="{{ 'settings-0' }}-tab">

                                <x-dashboard.form.input-text :error-key="\App\Enums\SettingKey::SITE_TITLE->value"

                                                             :value="old('site_title.0',
                                                              $settings->firstWhere('option_key', \App\Enums\SettingKey::SITE_TITLE->value)?->option_value[0]  ?? null)"
                                                             name="site_title[]" id="site_title"
                                                             label-title="Site Title"/>

                                <x-dashboard.form.input-text :error-key="\App\Enums\SettingKey::WHATSAPP_PHONE_NUMBER->value"
                                                             :value="old(\App\Enums\SettingKey::WHATSAPP_PHONE_NUMBER->value.'.0',
                                                              $settings->firstWhere('option_key', \App\Enums\SettingKey::WHATSAPP_PHONE_NUMBER->value)?->option_value[0]  ?? null)"
                                                             name="{{\App\Enums\SettingKey::WHATSAPP_PHONE_NUMBER->value}}[]" id="{{\App\Enums\SettingKey::WHATSAPP_PHONE_NUMBER->value}}"
                                                             label-title="Whatsapp Phone Number"/>

                                <x-dashboard.form.input-text :error-key="\App\Enums\SettingKey::ADDRESS->value"

                                                             :value="old('address.0',
                                                              $settings->firstWhere('option_key', \App\Enums\SettingKey::ADDRESS->value)?->option_value[0]  ?? null)"
                                                             name="address[]" id="address"
                                                             label-title="Address"/>

                                <x-dashboard.form.input-text :error-key="\App\Enums\SettingKey::PRIMARY_PHONE->value"

                                                             :value="old('primary_phone.0',
                                                              $settings->firstWhere('option_key', \App\Enums\SettingKey::PRIMARY_PHONE->value)?->option_value[0]  ?? null)"
                                                             name="primary_phone[]" id="primary_phone"
                                                             label-title="Primary Phone"/>

                                <x-dashboard.form.input-text :error-key="\App\Enums\SettingKey::CONTACT_EMAIL->value"

                                                             :value="old('contact_email.0',
                                                              $settings->firstWhere('option_key', \App\Enums\SettingKey::CONTACT_EMAIL->value)?->option_value[0]  ?? null)"
                                                             name="contact_email[]" id="contact_email"
                                                             label-title="Contact Email"/>

                                <x-dashboard.form.input-textarea error-key="footer_text"

                                                             :value="old('footer_text.0',
                                                              $settings->firstWhere('option_key', \App\Enums\SettingKey::FOOTER_TEXT->value)?->option_value[0]  ?? null)"
                                                             name="footer_text[]" id="footer_text"
                                                             label-title="Footer Text"/>

                                <x-dashboard.form.media title="Choose Logo"
                                                        :images="old('logo.0',
                                                              $settings->firstWhere('option_key', \App\Enums\SettingKey::LOGO->value)?->option_value[0]  ?? null)"
                                                        name="logo[]"/>

                                <x-dashboard.form.media title="Choose Footer Logo"
                                                        :images="old('footer_logo.0',
                                                              $settings->firstWhere('option_key', \App\Enums\SettingKey::FOOTER_LOGO->value)?->option_value[0] ?? null)"
                                                        name="footer_logo[]"/>

                                <x-dashboard.form.media title="Choose Favicon"
                                                        :images="old('favicon.0',
                                                              $settings->firstWhere('option_key', \App\Enums\SettingKey::FAVICON->value)?->option_value[0]  ?? null)"
                                                        name="favicon[]"/>
                            </div>

                            <div class="tab-pane fade"
                                 id="{{ 'settings-1' }}" role="tabpanel"
                                 aria-labelledby="{{ 'settings-1' }}-tab">
                                <a href="javascript:;" @click="addNotificationEmail()"
                                   class="text-center mb-4 btn btn-outline-primary w-100">
                                    <i class="fa fa-plus"></i> Add Email
                                </a>

                                <div v-for="(email,index) in notification_emails" :key="'email-' + index" class="row">
                                    <div class="form-group row">
                                        <label :for="'price-group-car-type-'+index" class="col-xl-3 col-md-4">Email
                                            <i class="fa fa-trash text-danger"
                                               @click="removeEmail(index)" style="cursor: pointer"></i>
                                        </label>
                                        <div class="col-xl-8 col-xl-9">
                                            <input class="form-control" :id="'notification-email-'+index"

                                                   type="email" name="notification_emails[]"
                                                   :value="email"
                                                   placeholder="example@gmail.com">
                                        </div>
                                    </div>
                                </div> {{-- End Vue loop --}}
                            </div>

                            <div class="tab-pane fade"
                                 id="{{ 'settings-2' }}" role="tabpanel"
                                 aria-labelledby="{{ 'settings-2' }}-tab">
                                <div class="permission-block">
                                    <a href="javascript:;" @click="addSocialLink()"
                                       class="text-center mb-4 btn btn-outline-primary w-100">
                                        <i class="fa fa-plus"></i> Add Link
                                    </a>

                                    <div v-for="(link,idx) in social_media_links" :key="'link-' + idx" class="row">
                                        <div class="form-group row">
                                            <div class="col-xl-12 col-xl-12">
                                                <div class="input-group mb-3">
                                                    <select aria-label="Type" class="dropdown-toggle"
                                                            :name="'social_links['+idx+'][type]'" v-model="link.type"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                        <option v-for="social_media_type in social_media_types"
                                                                :value="social_media_type.value">@{{
                                                            social_media_type.name }}
                                                        </option>
                                                    </select>
                                                    <input type="text" class="form-control"
                                                           :name="'social_links['+idx+'][url]'" v-model="link.url"
                                                           aria-label="Text input with dropdown button">
                                                    <button class="btn btn-outline-primary"
                                                            @click.prevent="removeSocialLink(idx)" type="button"
                                                            id="button-addon2"><i class="fa fa-trash"></i></button>
                                                </div>

                                            </div>
                                        </div>
                                    </div> {{-- End Vue loop --}}
                                </div>
                            </div>




                            <div class="tab-pane fade"
                                 id="{{ 'settings-3' }}" role="tabpanel"
                                 aria-labelledby="{{ 'settings-3' }}-tab">
                                <div class="permission-block">
                                    <input type="hidden" name="{{\App\Enums\SettingKey::CUSTOM_CSS->value}}[]"
                                           id="{{\App\Enums\SettingKey::CUSTOM_CSS->value}}"
                                    value="{{ $settings->firstWhere('option_key', \App\Enums\SettingKey::CUSTOM_CSS->value)?->option_value[0] ?? null }}">
                                    <div id="css-editor">
                                        {{ $settings->firstWhere('option_key', \App\Enums\SettingKey::CUSTOM_CSS->value)?->option_value[0] ?? null }}
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade"
                                 id="{{ 'settings-4' }}" role="tabpanel"
                                 aria-labelledby="{{ 'settings-4' }}-tab">

                                <x-dashboard.form.input-select name="{{\App\Enums\SettingKey::HOME_FIRST_SECTION_TOURS->value}}[]"
                                                               :options="$categories"
                                                               track-by="id"
                                                               option-lable="title"
                                                               label-title="First Section Category"
                                                               :value="old(\App\Enums\SettingKey::HOME_FIRST_SECTION_TOURS->value. '.0',
                                                               $settings->firstWhere('option_key', \App\Enums\SettingKey::HOME_FIRST_SECTION_TOURS->value)?->option_value[0]  ?? null)"
                                                               id="{{\App\Enums\SettingKey::HOME_FIRST_SECTION_TOURS->value}}"
                                                               error-key="{{\App\Enums\SettingKey::HOME_FIRST_SECTION_TOURS->value}}" />



                                <x-dashboard.form.input-select name="{{\App\Enums\SettingKey::HOME_SECOND_SECTION_TOURS->value}}[]"
                                                               :options="$categories"
                                                               track-by="id"
                                                               option-lable="title"
                                                               label-title="Second Section Category"
                                                               :value="old(\App\Enums\SettingKey::HOME_SECOND_SECTION_TOURS->value. '.0',
                                                               $settings->firstWhere('option_key', \App\Enums\SettingKey::HOME_SECOND_SECTION_TOURS->value)?->option_value[0]  ?? null)"
                                                               id="{{\App\Enums\SettingKey::HOME_SECOND_SECTION_TOURS->value}}"
                                                               error-key="{{\App\Enums\SettingKey::HOME_SECOND_SECTION_TOURS->value}}" />

                            </div>
                            <div class="tab-pane fade"
                                 id="{{ 'settings-5' }}" role="tabpanel"
                                 aria-labelledby="{{ 'settings-5' }}-tab">



                                <x-dashboard.form.input-editor :error-key="\App\Enums\SettingKey::ABOUT_US->value"

                                                             :value="old('about_us.0',
                                                              $settings->firstWhere('option_key', \App\Enums\SettingKey::ABOUT_US->value)?->option_value[0]  ?? null)"
                                                             name="about_us[]" id="about_us"
                                                             label-title="About Us Content"/>

                                <x-dashboard.form.input-editor :error-key="\App\Enums\SettingKey::TERMS_AND_CONDITIONS->value"
                                                             :value="old(\App\Enums\SettingKey::TERMS_AND_CONDITIONS->value.'.0',
                                                              $settings->firstWhere('option_key', \App\Enums\SettingKey::TERMS_AND_CONDITIONS->value)?->option_value[0]  ?? null)"
                                                             name="{{\App\Enums\SettingKey::TERMS_AND_CONDITIONS->value}}[]" id="{{\App\Enums\SettingKey::TERMS_AND_CONDITIONS->value}}"
                                                             label-title="Terms & Conditions Content"/>

                                <x-dashboard.form.input-editor :error-key="\App\Enums\SettingKey::PRIVACY->value"

                                                             :value="old('privacy.0',
                                                              $settings->firstWhere('option_key', \App\Enums\SettingKey::PRIVACY->value)?->option_value[0]  ?? null)"
                                                             name="privacy[]" id="privacy"
                                                             label-title="Privacy Content"/>

                            </div>
                            <div class="tab-pane fade"
                            id="{{ 'settings-6' }}" role="tabpanel"
                            aria-labelledby="{{ 'settings-6' }}-tab">

                            <x-dashboard.form.media title="Choose Gallery"
                            :images="$settings->firstWhere('option_key', \App\Enums\SettingKey::GALLERY->value)?->option_value"
                            name="{{\App\Enums\SettingKey::GALLERY->value}}[]" :multiple="true"/>

                            <x-dashboard.form.media title="Choose Banner Image"
                            :images="$settings->firstWhere('option_key', \App\Enums\SettingKey::BANNER_GALLERY->value)?->option_value"
                            name="{{\App\Enums\SettingKey::BANNER_GALLERY->value}}[]"/>

                            <x-dashboard.form.media title="Choose Banner Gallery"
                            :images="$settings->firstWhere('option_key', \App\Enums\SettingKey::MAIN_HOME_SLIDER->value)?->option_value"
                            name="{{\App\Enums\SettingKey::MAIN_HOME_SLIDER->value}}[]" :multiple="true"/>


                            <x-dashboard.form.media title="Choose Our Group"
                            :images="$settings->firstWhere('option_key', \App\Enums\SettingKey::OUR_GROUP->value)?->option_value"
                            name="{{\App\Enums\SettingKey::OUR_GROUP->value}}[]" :multiple="true"/>

                            <x-dashboard.form.media title="Choose Search Image"
                            :images="$settings->firstWhere('option_key', \App\Enums\SettingKey::SEARCH_IMG->value)?->option_value"
                            name="{{\App\Enums\SettingKey::SEARCH_IMG->value}}[]"/>

                       </div>



                        </x-dashboard.form.multi-tab-card>
                        <x-dashboard.form.submit-button/>
                    </div>
                </div>


            </div>
        </div>
        <!-- Container-fluid Ends-->

    </form>
@endsection

@push('js-upper')
    <script src="{{ asset('assets/admin/js/vue.min.js') }}"></script>
    <script>
        new Vue({
            el: "#settings-app",
            data() {
                return {
                    social_media_types: [
                        {name: 'Facebook', value: 'facebook'},
                        {name: 'Twitter', value: 'twitter'},
                        {name: 'Google Plus', value: 'google-plus'},
                        {name: 'Instagram', value: 'instagram'},
                        {name: 'Pinterest', value: 'pinterest'},
                        {name: 'Youtube', value: 'youtube'},
                        {name: 'Tripadvisor', value: 'tripadvisor'},
                        {name: 'Linked In', value: 'linked-in'},
                    ],

                    notification_emails: @json(old(\App\Enums\SettingKey::NOTIFICATION_EMAILS->value,
                                           $settings->firstWhere('option_key', \App\Enums\SettingKey::NOTIFICATION_EMAILS->value)?->option_value ?? [])),

                    social_media_links: @json(old(\App\Enums\SettingKey::SOCIAL_LINKS->value,
                                           $settings->firstWhere('option_key', \App\Enums\SettingKey::SOCIAL_LINKS->value)?->option_value ?? []))
                }
            },
            mounted() {
            },
            methods: {
                addNotificationEmail() {
                    this.notification_emails.push('')
                },
                removeEmail(index) {
                    this.notification_emails.splice(index, 1);
                },
                addSocialLink() {
                    this.social_media_links.push({
                        type: this.social_media_types[0].value,
                        url: ''
                    })
                },
                removeSocialLink(index) {
                    this.social_media_links.splice(index, 1);
                }
            }
        });
    </script>

    <script>
        let editor = ace.edit("css-editor", {
            enableBasicAutocompletion: true,
            enableSnippets: true,
            enableLiveAutocompletion: true
        });
        editor.setTheme("ace/theme/monokai");
        editor.session.setMode("ace/mode/css");
        editor.getSession().setValue(css_beautify(editor.getValue(), {
            indent_size: 2
        }));

        editor.getSession().on('change', function () {
            $('#{{ \App\Enums\SettingKey::CUSTOM_CSS->value }}').val(editor.getValue())
        });
    </script>
@endpush
