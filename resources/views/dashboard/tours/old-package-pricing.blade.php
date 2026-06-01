<x-dashboard.form.multi-tab-card :tabs="['accommodation', 'without_accommodation']"
                                 tab-id="accommodation-without_accommodation">
    <div class="tab-pane fade active show"
         id="{{ 'accommodation-without_accommodation-0' }}" role="tabpanel"
         aria-labelledby="{{ 'accommodation-without_accommodation-0' }}-tab">

        <div id="stander">
            <h3>Stander</h3>
            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="accommodation[stander][solo]" :value="$tour->accommodation['stander']['solo'] ?? null"
                                         label-title="solo" />

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="accommodation[stander][2-4]"  :value="$tour->accommodation['stander']['2-4'] ?? null"
                                         label-title="2-4" />

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="accommodation[stander][5-8]"  :value="$tour->accommodation['stander']['5-8'] ?? null"
                                         label-title="5-8" />

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="accommodation[stander][9-16]"  :value="$tour->accommodation['stander']['9-16'] ?? null"
                                         label-title="9-16" />
        </div>
        <hr>

        <div id="gold">
            <h3>Gold</h3>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="accommodation[gold][solo]" :value="$tour->accommodation['gold']['solo'] ?? null" label-title="solo" />

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="accommodation[gold][2-4]" :value="$tour->accommodation['gold']['2-4'] ?? null"  id="price-1" label-title="2-4" />

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="accommodation[gold][5-8]" :value="$tour->accommodation['gold']['5-8'] ?? null"  id="price-1" label-title="5-8" />

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="accommodation[gold][9-16]" :value="$tour->accommodation['gold']['9-16'] ?? null"  id="price-1" label-title="9-16" />
        </div>
        <hr>
        <div id="luxury">
            <h3>Luxury</h3>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="accommodation[luxury][solo]" :value="$tour->accommodation['luxury']['solo'] ?? null"
                                         label-title="solo" />

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="accommodation[luxury][2-4]" :value="$tour->accommodation['luxury']['2-4'] ?? null"  label-title="2-4" />

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="accommodation[luxury][5-8]" :value="$tour->accommodation['luxury']['5-8'] ?? null"  label-title="5-8" />

            <x-dashboard.form.input-text error-key=""
                                         name="accommodation[luxury][9-16]" :value="$tour->accommodation['luxury']['9-16'] ?? null"
                                         id="{{'pricing' . rand(1111,9999)}}"
                                         label-title="9-16" />
        </div>

    </div>
    <div class="tab-pane fade " id="{{ 'accommodation-without_accommodation-1' }}"
         role="tabpanel"
         aria-labelledby="{{ 'accommodation-without_accommodation-1' }}-tab">

        <div id="stander">
            <h3>Stander</h3>
            <x-dashboard.form.input-text error-key=""
                                         name="without_accommodation[stander][solo]" :value="$tour->without_accommodation['stander']['solo'] ?? null" id="price-1"
                                         id="{{'pricing' . rand(1111,9999)}}"
                                         label-title="solo" />

            <x-dashboard.form.input-text error-key=""
                                         name="without_accommodation[stander][2-4]" :value="$tour->without_accommodation['stander']['2-4'] ?? null" id="price-1"
                                         id="{{'pricing' . rand(1111,9999)}}"
                                         label-title="2-4" />

            <x-dashboard.form.input-text error-key=""
                                         name="without_accommodation[stander][5-8]" :value="$tour->without_accommodation['stander']['5-8'] ?? null" id="price-1"
                                         id="{{'pricing' . rand(1111,9999)}}"
                                         label-title="5-8" />

            <x-dashboard.form.input-text error-key=""
                                         name="without_accommodation[stander][9-16]" :value="$tour->without_accommodation['stander']['9-16'] ?? null" id="price-1"
                                         id="{{'pricing' . rand(1111,9999)}}"
                                         label-title="9-16" />
        </div>
        <hr>

        <div id="gold">
            <h3>Gold</h3>

            <x-dashboard.form.input-text error-key=""
                                         name="without_accommodation[gold][solo]" :value="$tour->without_accommodation['gold']['solo'] ?? null"
                                         id="{{'pricing' . rand(1111,9999)}}"
                                         label-title="solo" />

            <x-dashboard.form.input-text error-key=""
                                         name="without_accommodation[gold][2-4]" :value="$tour->without_accommodation['gold']['2-4'] ?? null"
                                         id="{{'pricing' . rand(1111,9999)}}"
                                         label-title="2-4" />

            <x-dashboard.form.input-text error-key=""
                                         name="without_accommodation[gold][5-8]" :value="$tour->without_accommodation['gold']['5-8'] ?? null"
                                         id="{{'pricing' . rand(1111,9999)}}"
                                         label-title="5-8" />

            <x-dashboard.form.input-text error-key=""
                                         name="without_accommodation[gold][9-16]" :value="$tour->without_accommodation['gold']['9-16'] ?? null"
                                         id="{{'pricing' . rand(1111,9999)}}"
                                         label-title="9-16" />
        </div>
        <hr>
        <div id="luxury">
            <h3>Luxury</h3>

            <x-dashboard.form.input-text error-key=""
                                         name="without_accommodation[luxury][solo]" :value="$tour->without_accommodation['luxury']['solo'] ?? null"
                                         id="{{'pricing' . rand(1111,9999)}}"
                                         label-title="solo" />

            <x-dashboard.form.input-text error-key=""
                                         name="without_accommodation[luxury][2-4]" :value="$tour->without_accommodation['luxury']['2-4'] ?? null"
                                         id="{{'pricing' . rand(1111,9999)}}"
                                         label-title="2-4" />

            <x-dashboard.form.input-text error-key=""
                                         name="without_accommodation[luxury][5-8]" :value="$tour->without_accommodation['luxury']['5-8'] ?? null"
                                         id="{{'pricing' . rand(1111,9999)}}"
                                         label-title="5-8" />

            <x-dashboard.form.input-text error-key=""
                                         name="without_accommodation[luxury][9-16]" :value="$tour->without_accommodation['luxury']['9-16'] ?? null"
                                         id="{{'pricing' . rand(1111,9999)}}"
                                         label-title="9-16" />
        </div>

    </div>


</x-dashboard.form.multi-tab-card>
