<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
        $attributes = [];
        foreach (config('translatable.supported_locales') as $localKey => $local) {
            $attributes[$localKey.".question"] =  $local["native"] ." Question";
$attributes[$localKey.".answer"] =  $local["native"] ." Answer";

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
            'enabled' => ['nullable'],
            'home' => ['nullable'],
            'important' => ['nullable'],
            'category_id' => ['nullable'],

        ];
        foreach (config('translatable.locales') as $local) {
            $rules["$local.question"]  = [$local == config("app.locale") ? "nullable": "nullable"];
            $rules["$local.answer"]  = [$local == config("app.locale") ? "nullable": "nullable"];

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
        $data = $this->validated();
        $data['enabled'] = $this->boolean('enabled');
        $data['home'] = $this->boolean('home');
        $data['important'] = $this->boolean('home');
        return $data;
    }
}
