<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
"nickname" => "Nickname",
"name" => "Name",
"email" => "Email",
"country_phone_code" => "CountryPhoneCode",
"phone" => "Phone",
"meeting_language" => "MeetingLanguage",
"meeting_date" => "MeetingDate",
"meeting_hour" => "MeetingHour",
"adults" => "Adults",
"children" => "Children",
"arrival_date" => "ArrivalDate",
"departure_date" => "DepartureDate",
"days" => "Days",
"expected_budget" => "ExpectedBudget",
"notes" => "Notes",
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
            'nickname' => ['required'],
'name' => ['required'],
'email' => ['required'],
'country_phone_code' => ['required'],
'phone' => ['required'],
'meeting_language' => ['required'],
'meeting_date' => ['required'],
'meeting_hour' => ['required'],
'adults' => ['required'],
'children' => ['required'],
'arrival_date' => ['required'],
'departure_date' => ['required'],
'days' => ['required'],
'expected_budget' => ['required'],
'notes' => ['required'],

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
