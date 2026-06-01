<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class SeasonTour extends Model
{
    use HasFactory;
   protected $fillable=[
        'season_Start_day',
     	'season_Start_month',
     	'season_End_month',
     	'season_End_day',
     	'season_adult_price',
     	'season_child_price',
     	'season_type',
     	'pricing_groups',
     	'start_from_price',
     	'tour_id',
   ];
   public function pricingGroups(): Attribute
   {
       return new Attribute(
           get: fn($value) => collect(json_decode($value, true))->map(fn($group) => [
               'from' => (int)$group['from'],
               'to' => (int)$group['to'],
               'price' => (float)$group['price'],
           ])
       );
   }
   public function startFrom(): Attribute
    {
        return new Attribute(
            get: fn() => $this->isEmptyPricingGroups() ? $this->season_adult_price : min($this->season_adult_price, $this->pricing_groups->min('price'))
        );
    }

    public function isEmptyPricingGroups(): bool
    {
        if (!$this->pricing_groups) {
            $this->pricing_groups = collect([]);
        }
        if ($this->pricing_groups->count() == 1) {
            $firstGroup = $this->pricing_groups->first();
            return !$firstGroup['from'] && !$firstGroup['to'] && !$firstGroup['price'];
        }
        return false;
    }
    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }
}
