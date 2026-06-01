<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
"tour_id" => "TourId",
"blog_id" => "Blog",
"client_id" => "ClientId",
"comment" => "Comment",
"email" => "Email",
"first_name" => "FirstName",
"money_rate" => "MoneyRate",
"destination_rate" => "DestinationRate",
"accommodation_rate" => "AccommodationRate",
"transport_rate" => "TransportRate",
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
            'tour_id' => ['nullable'],
            'client_id' => ['nullable'],
            'blog_id' => ['nullable'],
            'comment' => ['required'],
            'email' => ['required'],
            'first_name' => ['required'],
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
