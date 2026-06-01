<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TourRequest extends FormRequest
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
            "featured_image" => "Featured Image",
            "gallery" => "Gallery",
            "days" => "Tour Days",
            "adult_price" => "Adult Price",
            "child_price" => "Child Price",
            "pricing_groups" => "Pricing Groups",
            "categories" => "Categories",
            "destinations" => "Destinations",
            "options" => "Tour Options",
            "location" => "Location",
            'Season.0.season_Start_day' => 'Start Day',
            'Season.0.season_Start_month' => 'Start Month',
            'Season.0.season_End_month' => 'End Month',
            'Season.0.season_End_day' => 'End Day',
            'reward_points' => 'Reward Points',
            'deposit' => 'Deposit',
            'slug' => 'Slug',
        ];
        for ($i = 0; $i < $this->collect('pricing_groups')->count(); $i++) {
            $attributes['pricing_groups.' . $i . ".from"] = "Group Price From at " . ($i + 1);
            $attributes['pricing_groups.' . $i . ".to"] = "Group Price To at " . ($i + 1);
            $attributes['pricing_groups.' . $i . ".price"] = "Group Price Price at " . ($i + 1);
        }
        foreach (config('translatable.supported_locales') as $localKey => $local) {
            $attributes[$localKey . ".title"] = $local["native"] . " Title";
            $attributes[$localKey . ".overview"] = $local["native"] . " Overview";
            $attributes[$localKey . ".prices"] = $local["native"] . " prices";
            $attributes[$localKey . ".pricing_policy"] = $local["native"] . " pricing policy";
            $attributes[$localKey . ".children_policy"] = $local["native"] . " children policy";
            $attributes[$localKey . ".cancellation_policy"] = $local["native"] . " cancellation policy";
            $attributes[$localKey . ".deposit_payment"] = $local["native"] . " deposit payment";
            $attributes[$localKey . ".highlights"] = $local["native"] . " Highlights";
            $attributes[$localKey . ".excluded"] = $local["native"] . " Excluded";
            $attributes[$localKey . ".included"] = $local["native"] . " Included";
            $attributes[$localKey . ".duration"] = $local["native"] . " Duration";
            $attributes[$localKey . ".type"] = $local["native"] . " Type";
            $attributes[$localKey . ".run"] = $local["native"] . " Run";
            $attributes[$localKey . ".pickup_time"] = $local["native"] . " PickupTime";
            for ($i = 0; $i < $this->collect('days')->count(); $i++) {
                $attributes['days.' . $i . '.' . $localKey . ".title"] = $local["native"] . " Day Title at " . ($i + 1);
                $attributes['days.' . $i . '.' . $localKey . ".description"] = $local["native"] . " Day Description at " . ($i + 1);
            }
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
            'slug' => ['required', 'string', 'max:255', Rule::unique('tours')->ignore($this->route('tour')?->id)],
            'enabled' => ['nullable'],
            'featured' => ['nullable'],
            'featured_image' => ['nullable'],
            'adult_price' => ['nullable'],
            'child_price' => ['nullable'],
            'pricing_groups' => ['nullable', 'array'],
            'pricing_groups.*.from' => ['nullable', 'integer'],
            'pricing_groups.*.to' => ['nullable', 'integer'],
            'pricing_groups.*.price' => ['nullable', 'numeric'],
            'gallery' => ['nullable', 'array'],
            'seo' => ['nullable', 'array'],
            'days' => ['array', 'min:1'],
            'days.0.en.title' => ['nullable', 'string'],
            'days.0.en.description' => ['nullable', 'string'],
            'categories' => ['nullable', 'min:1', 'array'],
            'categories.*' => ['nullable', 'integer', 'exists:categories,id'],
            'destinations' => ['nullable', 'min:1', 'array'],
            'destinations.*' => ['nullable', 'integer', 'exists:destinations,id'],
            'seo.og_image' => ['nullable', 'string', 'max:255'],
            'options' => ['nullable', 'array'],
            'options.*' => ['integer', 'exists:tour_options,id'],
            'days.0.tour_day_image' => ['nullable'],
            'location' => ['nullable'],
            'deposit' => ['nullable', 'numeric'],
            'reward_points' => ['nullable', 'numeric'],
            'order_id' => ['nullable', 'numeric'],
            'duration' => ['nullable', 'numeric'],
            'guests' => ['nullable', 'numeric'],
            'banner' => ['nullable', 'string'],
            'type' => ['nullable', 'string'],
            'available' => ['nullable'],
            'available.Days' => ['nullable'],
            'available.Month' => ['nullable'],
            'available.Year' => ['nullable'],
            'tour_for' => ['nullable', 'string'],
//            'accommodation' => ['nullable'],
//            'without_accommodation' => ['nullable'],
            'seasons' => ['array', 'nullable'],
        ];

        foreach (config('translatable.locales') as $local) {
            $rules["$local.title"] = ['nullable', 'string'];
            $rules["$local.overview"] = ['nullable', 'string'];
            $rules["$local.prices"] = ["nullable"];
            $rules["$local.pricing_policy"] = ["nullable"];
            $rules["$local.children_policy"] = ["nullable"];
            $rules["$local.cancellation_policy"] = ["nullable"];
            $rules["$local.deposit_payment"] = ["nullable"];
            $rules["$local.highlights"] = ["nullable"];

            $rules["$local.included"] = ["nullable"];
            $rules["$local.excluded"] = ["nullable"];
            $rules["$local.duration"] = ["nullable"];
            $rules["$local.type"] = ["nullable"];
            $rules["$local.run"] = ["nullable"];
            $rules["$local.pickup_time"] = ["nullable"];

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
     * @return array
     */
    public function getSanitized(): array
    {
        $data = $this->validated();
        $data['enabled'] = $this->boolean('enabled');
        $data['featured'] = $this->boolean('featured');
        $data['pricing_groups'] = array_values($this->get('pricing_groups', []));
        $data['available'] = json_encode($this->get('available'));
        unset($data['seo'], $data['categories'], $data['destinations']);
        return $data;
    }
}
