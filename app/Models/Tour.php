<?php

namespace App\Models;

use App\Enums\TourPricingType;
use App\Traits\Models\AutoTranslate;
use App\Traits\Models\HasSeo;
use App\Traits\Models\TourDateHelper;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @property string $title
 * @property string $slug
 * @property string $overview
 * @property string $highlights
 * @property string $included
 * @property string $excluded
 * @property string $type
 * @property string $run
 * @property string $pickup_time
 * @property string $duration
 * @property string $prices
 * @property string $pricing_policy
 * @property string $children_policy
 * @property string $cancellation_policy
 * @property string $deposit_payment
 */
class Tour extends Model
{
    use Translatable, SoftDeletes, HasSeo, AutoTranslate, TourDateHelper;

    public array $translatedAttributes = [
        'title',
        'overview',
        'highlights',
        'excluded',
        'included',
        'type',
        'run',
        'pickup_time',
        'prices',
        'pricing_policy',
        'children_policy',
        'cancellation_policy',
        'deposit_payment',
    ];

    protected $fillable = [
        'enabled',
        'featured',
        'slug',
        'duration',
        'featured_image',
        'banner',
        'gallery',
        'adult_price',
        'child_price',
        'pricing_groups',
        'start_from_price',
        'tour_for',
        'location',
        'reward_points',
        'seasons',
        'deposit',
        'guests',
        'order_id',
        'available',
        'type',
        'accommodation',
        'without_accommodation',

    ];

    protected $casts = [
        'enabled' => 'boolean',
        'featured' => 'boolean',
        'gallery' => 'array',
        'seasons' => 'array',
        'accommodation' => 'array',
        'without_accommodation' => 'array',
        'pricing_groups' => 'collection',
        'available' => 'array',

    ];

    protected $with = ['translation'];

    protected $appends = [
        'overview_text',
        'whatsapp_link',
        'facebook_share_link',
        'linkedin_share_link',
        'google_plus_share_link',
        'twitter_share_link',
        'pinterest_share_link',
    ];

    public function days(): HasMany
    {
        return $this->hasMany(TourDay::class);
    }

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

    public function accommodation(): Attribute
    {
        return new Attribute(
            get: fn($value) => collect(json_decode($value, true) ?? [])->mapWithKeys(function ($group, $key) {
                // Ensure the group is structured properly with default fallback values
                return [
                    $key => [
                        'solo' => (float)$group['solo'] ?? '',
                        '2-4' => (float)$group['2-4'] ?? '',
                        '5-8' => (float)$group['5-8'] ?? '',
                        '9-16' => (float)$group['9-16'] ?? '',
                    ],
                ];
            })->toArray() // Convert the collection to an array
        );
    }

    public function overviewText(): Attribute
    {
        return new Attribute(
            get: fn($value) => \Str::of($this->overview)->replace([PHP_EOL, '\\n', '\\t', '\\r'], '')
                ->stripTags()->htmlEntityDecode()->toString()
        );
    }

    public function rate(): Attribute
    {
        return new Attribute(
            get: fn() => $this->reviews_number == 0 ? 0 : (float)number_format($this->rates / $this->reviews_number, 1)
        );
    }

    public function startFrom(): Attribute
    {
        return new Attribute(
            get: fn() => $this->isEmptyPricingGroups() ? 0 : min($this->adult_price, $this->pricing_groups->min('price'))
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

    public function adultPrice($number)
    {
        foreach ($this->pricing_groups ?? [] as $group) {
            if ($number >= $group['from'] && $number <= $group['to']) {
                return $group['price'];
            }
        }
        return $this->adult_price;
    }

    public function whatsappLink(): Attribute
    {
        return new Attribute(
            get: fn() => Str::of('https://wa.me/+201005243949?text=' . __('main.tour-share-whatsapp', [
                    'tour' => $this->link
                ]))->replace(' ', "%20")
        );
    }

    public function facebookShareLink(): Attribute
    {
        return new Attribute(
            get: fn() => Str::of('https://www.facebook.com/sharer/sharer.php?u=' . $this->link)
        );
    }

    public function twitterShareLink(): Attribute
    {
        return new Attribute(
            get: fn() => Str::of('https://twitter.com/intent/tweet?text=' . $this->link)
        );
    }

    public function linkedinShareLink(): Attribute
    {
        return new Attribute(
            get: fn() => Str::of('https://www.linkedin.com/shareArticle?mini=true&text=' . $this->title . '&url=' . $this->link)
        );
    }

    public function googlePlusShareLink(): Attribute
    {
        return new Attribute(
            get: fn() => Str::of('https://plus.google.com/share?url=' . $this->link)
        );
    }

    public function pinterestShareLink(): Attribute
    {
        return new Attribute(
            get: fn() => Str::of('https://www.pinterest.com/pin/create/button?url=' . $this->link . '&media=&description=' . $this->title)
        );
    }

    public function link(): Attribute
    {
        return new Attribute(
            get: function () {
                $identifier = $this->slug;

                if (empty($identifier)) {
                    $identifier = $this->translateOrDefault('en')?->slug;
                }

                if (empty($identifier)) {
                    $identifier = $this->id;
                }

                return route('site.tour_details', $identifier);
            }
        );
    }

    public function duplicate(): self
    {
        $temp = $this->replicate();
        $temp->slug = $this->slug . '-' . (Tour::whereTranslationLike('slug', "%" . $this->slug . "%")->count() + 1);
        $this->translations->each(function ($relation) use (&$temp) {
            unset($relation->tour_id);
            $temp->{$relation->locale} = $relation->toArray();
        });

        $new = self::create($temp->toArray());
        $this->comments->each(fn($relation) => $new->comments()->create($relation->toArray()));
        $this->days->each(function ($relation) use (&$new) {
            unset($relation->tour_id);
            $day = $relation;
            $day->tour_id = $new->id;
            foreach ($relation->translations as $translation) {
                $day->{$translation->locale} = $translation->toArray();
            }
            TourDay::create($day->toArray());
        });
        $this->destinations->each(fn($relation) => $new->destinations()->attach($relation));
        $this->categories->each(fn($relation) => $new->categories()->attach($relation));
        $this->discount->each(fn($relation) => $new->discount()->attach($relation));
        $this->options->each(fn($relation) => $new->options()->attach($relation));
        $this->raise->each(fn($relation) => $new->raise()->attach($relation));
        $this->seasons->each(fn($relation) => $new->seasons()->save($relation));

        $seo = $this->seo()->firstOrNew();
        foreach ($seo->translations ?? [] as $translation) {
            $seo->{$translation->locale} = $translation->toArray();
        }
        $new->seo()->create($seo->toArray());
        return $new;
    }

    public function comments(): HasMany
    {
        return $this->HasMany(Comment::class);
    }

    public function destinations(): BelongsToMany
    {
        return $this->belongsToMany(Destination::class, 'tour_destinations');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'tour_categories');
    }

    public function discount(): BelongsToMany
    {
        return $this->belongsToMany(Discount::class, 'discount_tours');
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(TourOption::class, 'tour_option_tours');
    }

    public function raise(): BelongsToMany
    {
        return $this->belongsToMany(Raise::class, 'raise_tours');
    }

    public function seasons(): HasMany
    {
        return $this->hasMany(SeasonTour::class);
    }

    public function collectPrices(): \Illuminate\Support\Collection
    {
        return collect([
            'group_pricing' => [
                ['from' => 1, 'to' => 1, 'adult_price' => $this->adult_price ?? 0, 'child_price' => $this->child_price ?? 0],
                ...array_map(fn($group) => [
                    'from' => $group['from'],
                    'to' => $group['to'],
                    'adult_price' => $group['price'] ?? 0,
                    'child_price' => $this->child_price ?? 0
                ], $this->pricing_groups->toArray())
            ],
            'package_pricing' => [
                'accommodation' => $this->accommodation ?? [],
                'without_accommodation' => $this->without_accommodation ?? [],
            ],
            'seasons' => $this->seasons ?? null,
        ]);
    }

    private function getSeason($date)
    {
        if (!($date instanceof Carbon)) {
            $date = Carbon::parse($date);
        }

        if ($this->isBetweenMayAndSeptember($date)) {
            return $this->seasons[1] ?? null;
        }

        if ($this->isBetweenOctoberAndDecember($date)) {
            return $this->seasons[2] ?? null;
        }

        if ($this->isInPeakPeriods($date)) {
            return $this->seasons[3] ?? null;
        }

        return $this->seasons[0] ?? null;
    }

    public function getPrice($date, $adults, $accommodation_type, $price_category): array
    {
        if ($this->tour_for === TourPricingType::PRICING_GROUP->value) {
            return $this->getGroupPricing($adults);
        }

        $package_pricing = $this->getSeason($date)[$accommodation_type][$price_category];

        if ($adults >= 2 && $adults <= 4)
            return ['adult_price' => $package_pricing['2-4'], 'child_price' => $package_pricing['2-4']];

        if ($adults >= 5 && $adults <= 8)
            return ['adult_price' => $package_pricing['5-8'], 'child_price' => $package_pricing['5-8']];

        if ($adults >= 9)
            return ['adult_price' => $package_pricing['9-16'], 'child_price' => $package_pricing['9-16']];

        return ['adult_price' => $package_pricing['solo'], 'child_price' => $package_pricing['solo']];
    }

    private function getGroupPricing($adults): array
    {
        foreach ($this->pricing_groups->toArray() as $group) {
            if ($group['from'] <= $adults && $group['to'] >= $adults) {
                return ['adult_price' => $group['price'] ?? 0, 'child_price' => $this->child_price ?? 0];
            }
        }
        return ['adult_price' => $this->adult_price ?? 0, 'child_price' => $this->child_price ?? 0];
    }
}
