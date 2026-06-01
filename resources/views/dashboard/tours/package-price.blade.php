<x-dashboard.form.multi-tab-card :tabs="['jan-apr', 'may-sep', 'oct-dec', 'peak']"
                                 tab-id="season_price">
    @php
    $seasons = [
        "From Jan " . now()->year ." to Apr " . now()->year,
        "From May " . now()->year ." to Sep " . now()->year,
        "From Oct " . now()->year ." to Dec " . now()->year,
        "Peak (23 Dec ". now()->year ." - 7 Jan ".(now()->year + 1).") / (14 - 23 Apr ". now()->year .")"
    ];
    @endphp
    @for($i = 0 ; $i < 4 ; $i++)
        @php
            $current_season = $tour->seasons[$i] ?? [];
        @endphp
        <div class="tab-pane fade @if($i == 0) active show @endif"
             id="{{ 'season_price-' . $i }}" role="tabpanel"
             aria-labelledby="{{ 'season_price-' . $i  }}-tab">
            <h3 class="text-center my-2">{{ $seasons[$i]  }} [Accommodation]</h3>
            <hr>
            <input type="hidden" name="seasons[{{$i}}][season_name]" value="From Jan to Apr [Accommodation]">



            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][accommodation][stander][solo]"
                                         :value="$current_season['accommodation']['stander']['solo'] ?? ''"
                                         label-title="Standard Solo" />

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][accommodation][stander][2-4]"
                                         :value="$current_season['accommodation']['stander']['2-4'] ?? ''"
                                         label-title="Standard 2-4"/>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][accommodation][stander][5-8]"
                                         :value="$current_season['accommodation']['stander']['5-8'] ?? ''"
                                         label-title="Standard 5-8"/>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][accommodation][stander][9-16]"
                                         :value="$current_season['accommodation']['stander']['9-16'] ?? ''"
                                         label-title="Standard 9-16" />
            <hr>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][accommodation][gold][solo]"
                                         :value="$current_season['accommodation']['gold']['solo'] ?? ''"
                                         label-title="Gold Solo" />

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][accommodation][gold][2-4]"
                                         :value="$current_season['accommodation']['gold']['2-4'] ?? ''"
                                         label-title="Gold 2-4"/>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][accommodation][gold][5-8]"
                                         :value="$current_season['accommodation']['gold']['5-8'] ?? ''"
                                         label-title="Gold 5-8"/>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][accommodation][gold][9-16]"
                                         :value="$current_season['accommodation']['gold']['9-16'] ?? ''"
                                         label-title="Gold 9-16" />

            <hr>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][accommodation][luxury][solo]"
                                         :value="$current_season['accommodation']['luxury']['solo'] ?? ''"
                                         label-title="Luxury Solo" />

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][accommodation][luxury][2-4]"
                                         :value="$current_season['accommodation']['luxury']['2-4'] ?? ''"
                                         label-title="Luxury 2-4"/>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][accommodation][luxury][5-8]"
                                         :value="$current_season['accommodation']['luxury']['5-8'] ?? ''"
                                         label-title="Luxury 5-8"/>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][accommodation][luxury][9-16]"
                                         :value="$current_season['accommodation']['luxury']['9-16'] ?? ''"
                                         label-title="Luxury 9-16" />

            <hr>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][accommodation][platinum][solo]"
                                         :value="$current_season['accommodation']['platinum']['solo'] ?? ''"
                                         label-title="Platinum Solo" />

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][accommodation][platinum][2-4]"
                                         :value="$current_season['accommodation']['platinum']['2-4'] ?? ''"
                                         label-title="Platinum 2-4"/>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][accommodation][platinum][5-8]"
                                         :value="$current_season['accommodation']['platinum']['5-8'] ?? ''"
                                         label-title="Platinum 5-8"/>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][accommodation][platinum][9-16]"
                                         :value="$current_season['accommodation']['platinum']['9-16'] ?? ''"
                                         label-title="Platinum 9-16" />
            <hr>

            <h3 class="text-center my-2">{{ $seasons[$i]  }} [Without Accommodation]</h3>
            <input type="hidden" name="seasons[{{$i}}][season_name]" value="From Jan to Apr [Without Accommodation]">
            <hr>
            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][without_accommodation][stander][solo]"
                                         :value="$current_season['without_accommodation']['stander']['solo'] ?? ''"
                                         label-title="Standard Solo" />

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][without_accommodation][stander][2-4]"
                                         :value="$current_season['without_accommodation']['stander']['2-4'] ?? ''"
                                         label-title="Standard 2-4"/>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][without_accommodation][stander][5-8]"
                                         :value="$current_season['without_accommodation']['stander']['5-8'] ?? ''"
                                         label-title="Standard 5-8"/>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][without_accommodation][stander][9-16]"
                                         :value="$current_season['without_accommodation']['stander']['9-16'] ?? ''"
                                         label-title="Standard 9-16" />
            <hr>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][without_accommodation][gold][solo]"
                                         :value="$current_season['without_accommodation']['gold']['solo'] ?? ''"
                                         label-title="Gold Solo" />

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][without_accommodation][gold][2-4]"
                                         :value="$current_season['without_accommodation']['gold']['2-4'] ?? ''"
                                         label-title="Gold 2-4"/>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][without_accommodation][gold][5-8]"
                                         :value="$current_season['without_accommodation']['gold']['5-8'] ?? ''"
                                         label-title="Gold 5-8"/>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][without_accommodation][gold][9-16]"
                                         :value="$current_season['without_accommodation']['gold']['9-16'] ?? ''"
                                         label-title="Gold 9-16" />

            <hr>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][without_accommodation][luxury][solo]"
                                         :value="$current_season['without_accommodation']['luxury']['solo'] ?? ''"
                                         label-title="Luxury Solo" />

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][without_accommodation][luxury][2-4]"
                                         :value="$current_season['without_accommodation']['luxury']['2-4'] ?? ''"
                                         label-title="Luxury 2-4"/>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][without_accommodation][luxury][5-8]"
                                         :value="$current_season['without_accommodation']['luxury']['5-8'] ?? ''"
                                         label-title="Luxury 5-8"/>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][without_accommodation][luxury][9-16]"
                                         :value="$current_season['without_accommodation']['luxury']['9-16'] ?? ''"
                                         label-title="Luxury 9-16" />

            <hr>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][without_accommodation][platinum][solo]"
                                         :value="$current_season['without_accommodation']['platinum']['solo'] ?? ''"
                                         label-title="Platinum Solo" />

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][without_accommodation][platinum][2-4]"
                                         :value="$current_season['without_accommodation']['platinum']['2-4'] ?? ''"
                                         label-title="Platinum 2-4"/>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][without_accommodation][platinum][5-8]"
                                         :value="$current_season['without_accommodation']['platinum']['5-8'] ?? ''"
                                         label-title="Platinum 5-8"/>

            <x-dashboard.form.input-text error-key="" id="{{'pricing' . rand(1111,9999)}}"
                                         name="seasons[{{$i}}][without_accommodation][platinum][9-16]"
                                         :value="$current_season['without_accommodation']['platinum']['9-16'] ?? ''"
                                         label-title="Platinum 9-16" />
        </div>
    @endfor
</x-dashboard.form.multi-tab-card>
