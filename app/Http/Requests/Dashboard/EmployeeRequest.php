<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
"image" => "Image",
"title" => "Title",
"mail_link" => "MailLink",
"facebook_link" => "FacebookLink",
"twitter_link" => "TwitterLink",
"insta_link" => "InstaLink",
"linkedin_link" => "LinkedinLink",
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
'image' => ['required'],
'title' => ['required'],
'mail_link' => ['required'],
'facebook_link' => ['required'],
'twitter_link' => ['required'],
'insta_link' => ['required'],
'linkedin_link' => ['required'],

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
