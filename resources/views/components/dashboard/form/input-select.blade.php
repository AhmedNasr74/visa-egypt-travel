@php
    if (! isset($allowEmpty)) {
        $allowEmpty = false;
    }
    if (! isset($emptyLabel)) {
        $emptyLabel = '— None —';
    }
@endphp
<div class="form-group row">
    <label class="col-xl-3 col-md-4" for="{{ $id }}">{{ $labelTitle }}</label>
    <div class="col-xl-8 col-md-7">
        <select class="custom-select select2 w-100 form-control"
                id="{{ $id }}"
                name="{{ $name }}"
                @isset($multible) multiple @endisset
                @isset($required) required @endisset>
            @if($allowEmpty)
                <option value="" @selected(!isset($value) || $value === null || $value === '')>{{ $emptyLabel }}</option>
            @else
                <option value="" disabled @selected(!isset($multible))>--Select Option--</option>
            @endif
            @foreach($options as $option)
                <option
                    @isset($value)
                        @if(isset($multible) ?
                            in_array(isset($trackBy) ? $option[$trackBy] : $option, $value) :
                             $value==(isset($trackBy) ? $option[$trackBy] : $option))
                            selected
                    @endif

                    @endisset
                    value="{{ isset($trackBy) ? $option[$trackBy] : $option }}">
                    {{ Str::headline( isset($optionLable) ? $option[$optionLable] : $option ) }}
                </option>
            @endforeach
        </select>
        @isset($errorKey)
            @error($errorKey)
            <span class="d-block text-danger">{{ $message }}</span>
            @enderror
        @endisset
    </div>
</div>
