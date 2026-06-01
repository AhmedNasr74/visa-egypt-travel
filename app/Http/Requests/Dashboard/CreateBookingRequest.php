<?php

namespace App\Http\Requests\Dashboard;

use App\Models\TourOption;
use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'country_phone_code' => ['required', 'string', 'exists:countries,phone_code'],
            'nickname' => ['required', 'string', 'in:Mr,Mrs'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string', 'min:10'],
            'date' => ['required', 'string', 'date'],
            'notes' => ['nullable', 'string'],
            'nationality' => ['required', 'string', 'exists:countries,name'],
            'tour_id' => ['required', 'integer', 'exists:tours,id'],
            'adults_count' => ['required', 'integer', 'min:1'],
            'child_count' => ['required', 'integer', 'min:0'],
            'tour_options' => ['nullable', 'array'],
            'tour_options.*' => ['exists:tour_options,id']
        ];
    }

    public function getSanitized(): array
    {
        return array_merge($this->validated(), [
            'tour_operator_id' => admin()->id,
            'tour_options' => TourOption::select(['id', 'price'])
                ->whereIn('id', $this->get('tour_options'))
                ->get()
                ->map(fn(TourOption $tourOption) => [
                    'id' => $tourOption->id,
                    'name' => $tourOption->name,
                    'price' => $tourOption->price,
                ])
                ->toArray()
        ]);
    }
}
