<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CustomizedTripRequest extends FormRequest
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
"date_type" => "DateType",
"date_from" => "DateFrom",
"date_to" => "DateTo",
"month" => "Month",
"days" => "Days",
"first_name" => "FirstName",
"last_name" => "LastName",
"nationality" => "Nationality",
"phone" => "Phone",
"email" => "Email",
"adults" => "Adults",
"child" => "Child",
"note" => "Note",
"infant" => "Infant",
"min_budget" => "MinBudget",
"max_budget" => "MaxBudget",
"Destinations" => "Destinations",


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
            'date_type' => ['required'],
            'date_from' => ['nullable','date', 'date_format:Y-m-d'],
            'date_to' => ['nullable','date_format:Y-m-d','required_with:date_from', 'date', 'after_or_equal:date_from'],
            'month' => ['nullable'],
            'days' => ['nullable','integer','min:1','max:255'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'Destinations' => ['required'],
            'nationality' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'adults' => ['required','integer','min:1','max:255'],
            'child' => ['nullable','integer'],
            'note' => ['nullable'],
            'infant' => ['nullable','integer'],
            'min_budget' => ['required','integer','min:1','max:255'],
            'max_budget' => ['required','integer','min:1','max:255'],

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
          return $this->validated();
     }
}
