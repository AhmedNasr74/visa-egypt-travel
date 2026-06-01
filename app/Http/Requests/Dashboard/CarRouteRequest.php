<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class CarRouteRequest extends FormRequest
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
            'pickup_location_id' => 'Pickup Location',
            'destination_id' => 'Destination',
            'airport_limo' => 'Airport Limo',
            'travel_limo' => 'Travel Limo',
            'city_ride_limo' => 'City Ride Limo',
        ];

        foreach ($this->get('prices', []) as $k=>$v) {
            $attributes['prices.' . $k . '.car_type'] = 'Car type ('. ($k+1) .')';
            $attributes['prices.' . $k . '.from'] = 'From ('. ($k+1) .')';
            $attributes['prices.' . $k . '.to'] = 'To ('. ($k+1) .')';
            $attributes['prices.' . $k . '.oneway_price'] = 'Oneway Price ('. ($k+1) .')';
            $attributes['prices.' . $k . '.rounded_price'] = 'Rounded Price ('. ($k+1) .')';
        }

        foreach ($this->get('stops', []) as $k=>$v) {
            $attributes['stops.' . $k . '.stop_location_id'] = 'Stop Location ('. ($k+1) .')';
            $attributes['stops.' . $k . '.price'] = 'Stop Location Price ('. ($k+1) .')';
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

        return [
            'pickup_location_id' => ['required', 'integer', 'exists:locations,id'],
            'destination_id' => ['nullable', 'integer', 'exists:locations,id'],
            'airport_limo' => ['sometimes', 'boolean'],
            'travel_limo' => ['sometimes', 'boolean'],
            'city_ride_limo' => ['sometimes', 'boolean'],
            'prices' => ['required', 'array', 'min:1'],
            'prices.*.id' => ['nullable', 'integer'],
            'prices.*.price_group_index' => ['nullable', 'integer', 'min:0'],
            'prices.*.limo_city_hours' => ['nullable', 'string', 'in:3,6,8,12'],
            'prices.*.car_type' => ['required', 'string', 'min:1', 'max:255'],
            'prices.*.from' => ['required', 'integer', 'min:1'],
            'prices.*.to' => ['required', 'integer', 'min:1'],
            'prices.*.oneway_price' => ['required', 'numeric', 'min:1'],
            'prices.*.rounded_price' => ['required', 'numeric', 'min:1'],
            'stops' => ['nullable', 'array'],
            'stops.*.id' => ['nullable', 'integer'],
            'stops.*.stop_location_id' => ['required', 'integer', 'exists:locations,id'],
            'stops.*.price' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            if (
                ! $this->boolean('airport_limo')
                && ! $this->boolean('travel_limo')
                && ! $this->boolean('city_ride_limo')
            ) {
                $validator->errors()->add(
                    'service_types',
                    __('validation.car_route_at_least_one_service_type')
                );
            }
        });
    }

    /**
     * @return array<string, mixed>
     */
    public function getSanitized(): array
    {
        return [
            'destination_id' => $this->filled('destination_id') ? (int) $this->input('destination_id') : null,
            'pickup_location_id' => $this->input('pickup_location_id'),
            'airport_limo' => $this->boolean('airport_limo'),
            'travel_limo' => $this->boolean('travel_limo'),
            'city_ride_limo' => $this->boolean('city_ride_limo'),
        ];
    }
}
