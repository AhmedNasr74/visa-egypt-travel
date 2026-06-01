<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            "featured" => "Featured",
            "parent_id" => "Parent Category",
            "banner" => "Banner",
            "gallery" => "Gallery",
            "seo.og_image" => "Open Graph",
        ];
        foreach (config('translatable.supported_locales') as $localKey => $local) {
            $attributes[$localKey . ".title"] = $local["native"] . " Title";
            $attributes[$localKey . ".description"] = $local["native"] . " Description";
            $attributes[$localKey . ".slug"] = $local["native"] . " Slug";

            $attributes['seo.' . $localKey . ".meta_title"] = $local["native"] . " Meta Title";
            $attributes['seo.' . $localKey . ".meta_description"] = $local["native"] . " Meta Description";
            $attributes['seo.' . $localKey . ".meta_keywords"] = $local["native"] . " Meta Keywords";
            $attributes['seo.' . $localKey . ".og_title"] = $local["native"] . " Open Graph Title";
            $attributes['seo.' . $localKey . ".og_description"] = $local["native"] . " Open Graph Description";
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
            'parent_id' => ['nullable', 'exists:categories,id'],
            'enabled' => ['nullable'],
            'featured' => ['nullable'],
            'featured_image' => ['nullable', 'string'],
            'banner' => ['nullable', 'string'],
            'gallery' => ['nullable','array'],
            'order_id' => ['nullable','numeric'],
            'seo' => ['nullable', 'array'],
            'seo.og_image' => ['nullable', 'string', 'max:255'],
        ];

        foreach (config('translatable.locales') as $local) {
            $rules["$local.title"] = [$local == config("app.locale") ? "required" : "nullable"];
            $rules["$local.description"] = [$local == config("app.locale") ? "nullable" : "nullable"];
            $rules["$local.slug"] = [$local == config("app.locale") ? "required" : "nullable"];

            $rules["seo.$local.meta_title"] = ["nullable", 'string', 'max:255'];
            $rules["seo.$local.meta_description"] = ["nullable", 'string', 'max:255'];
            $rules["seo.$local.meta_keywords"] = ["nullable", 'string', 'max:255'];
            $rules["seo.$local.og_title"] = ["nullable", 'string', 'max:255'];
            $rules["seo.$local.og_description"] = ["nullable", 'string', 'max:255'];

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
        $data['enabled']= $this->boolean('enabled');
        $data['featured']= $this->boolean('featured');
        unset($data['seo']);
        return $data;
    }
}
