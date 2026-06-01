<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            "key" => "Key",
            'data' => 'data'
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
            'key' => ['required'],
            'data' => ['nullable', 'array']
        ];
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
