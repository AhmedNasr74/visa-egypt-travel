<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
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
            "name" => "Name",
            "symbol" => "Symbol",
            "exchange_rate" => "ExchangeRate",
            "default" => "Default",
        ];

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
            'name' => ['required'],
            'symbol' => ['required'],
            'exchange_rate' => ['required'],
            'default' => ['nullable'],

        ];

        return $rules;
    }

    /**
     * Get the validated fields.
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $data =  $this->validated();

        $data ['default'] = $this->filled('default');

        return $data ;
    }
}
