<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
"enabled" => "Enabled",
"slug" => "Slug",
"featured_image" => "FeaturedImage",
"gallery" => "Gallery",
];
        foreach (config('translatable.supported_locales') as $localKey => $local) {
            $attributes[$localKey.".title"] =  $local["native"] ." Title";
$attributes[$localKey.".description"] =  $local["native"] ." Description";

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
'slug' => ['required'],
'featured_image' => ['required'],
'gallery' => ['required'],
'tags' => ['nullable'],
'categories' => ['required', 'min:1', 'array'],
'categories.*' => ['required', 'integer', 'exists:categories,id'],


        ];
        foreach (config('translatable.locales') as $local) {
            $rules["$local.title"]  = [$local == config("app.locale") ? "required": "nullable"];
            $rules["$local.description"]  = [$local == config("app.locale") ? "nullable": "nullable"];

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
        $data=$this->validated();
        $data['enabled'] = $this->boolean('enabled');
        return $data;     }
}
