<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TourOptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function attributes(): array
    {
        $attributes = [
            "price" => "Price",
            "icon" => "Featured Image",
        ];
        foreach (config('translatable.supported_locales') as $localKey => $local) {
            $attributes[$localKey . ".name"] = $local["native"] . " Name";
            $attributes[$localKey . ".description"] = $local["native"] . " Description";
        }

        return $attributes;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = [
            'price' => ['nullable', 'numeric'],
            'option_Type' => ['nullable'],
            'icon' => ['required'],
          ];
        foreach (config('translatable.locales') as $local) {
            $rules["$local.name"] = [
                $local == config("app.locale") ? "required" : "nullable", 'string', 'max:255',
                Rule::unique('tour_option_translations', 'name')
                    ->where('locale', $local)
                    ->ignore(
                        request('tour_option')?->translations?->firstWhere('locale', $local)?->id
                    )
            ];
            $rules["$local.description"] = [$local == config("app.locale") ? "required" : "nullable", 'string', 'max:500'];
        }
        return $rules;
    }

    /**
     * Get the validated fields.
     *
     * @return array
     */
    public function getSanitized(): array
    {
        return $this->validated();
    }
}
