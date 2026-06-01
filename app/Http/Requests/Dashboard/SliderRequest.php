<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SliderRequest extends FormRequest
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
        return [
            "title" => "Title",
            "key" => "Key",
            "gallery" => "Gallery",
            "active" => "Active",
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {

        return [
            'title' => ['required', 'string', Rule::unique('sliders')->ignore(request('slider'))],
            'active' => ['nullable'],
            'slides' => ['required', 'array', 'min:1'],
            'slides.*.model_type' => ['nullable', 'string', 'in:Category,Product'],
            'slides.*.model_id' => ['nullable', 'integer'],
            'slides.*.image' => ['required', 'string'],
            'slides.*.title' => ['nullable', 'array'],
            'slides.*.description' => ['nullable', 'array'],
        ];
    }

    /**
     * Get the validated fields.
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $data = $this->validated();
        $data['active'] = $this->boolean('active');
        $data['key'] = \Str::slug($this->get('title'));
        return $data;
    }
}
