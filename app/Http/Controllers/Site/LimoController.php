<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\LimoBookingAdminMail;
use App\Mail\LimoBookingGuestMail;
use App\Models\CarRental;
use App\Models\CarRoute;
use App\Models\Currency;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Services\DualEmailSender;
use Illuminate\View\View;

class LimoController extends Controller
{
    public function completingBooking(Request $request): View
    {
        $type = $request->query('type', '');
        if (!in_array($type, ['airport', 'travel', 'city'], true)) {
            $type = 'airport';
        }

        $pickupId = max(0, (int)$request->query('pickup_id', 0));
        $destId = $request->filled('dest_id') ? max(0, (int)$request->query('dest_id')) : null;
        $limoMaxPax = $this->maxLimoPassengersGlobal();
        if ($type === 'city' && $pickupId > 0) {
            $caps = collect($this->limoCityRouteRules())
                ->where('pickup', $pickupId)
                ->pluck('max_pax');
            if ($caps->isNotEmpty()) {
                $limoMaxPax = (int)$caps->max();
            }
        }
        $pax = max(1, min($limoMaxPax, (int)$request->query('pax', 1)));
        $trip = $type === 'city'
            ? ''
            : ($request->query('trip', 'one') === 'round' ? 'round' : 'one');
        $pickupDate = (string)$request->query('pickup_date', '');
        $returnDate = (string)$request->query('return_date', '');
        $cityHours = (string)$request->query('city_hours', '');
        $priceRaw = $request->query('price');
        $estimatedPrice = is_numeric($priceRaw) ? (float)$priceRaw : null;

        $cityHoursKey = in_array($cityHours, ['3', '6', '8', '12'], true) ? $cityHours : '';
        $cityHoursLabel = match ($cityHoursKey) {
            '3' => '3 Hours',
            '6' => '6 Hours',
            '8' => '8 Hours',
            '12' => '12 Hours (Full Day)',
            default => '',
        };

        $pickupName = '';
        $destName = '';
        if ($pickupId > 0) {
            $pickupName = (string)(Location::active()->find($pickupId)?->name ?? '');
        }
        if ($destId !== null && $destId > 0) {
            $destName = (string)(Location::active()->find($destId)?->name ?? '');
        }

        $vehicle = $this->resolveLimoVehicleForBooking(
            $type,
            $pickupId,
            $destId,
            $pax,
            $trip === 'round',
            $cityHoursKey,
            $estimatedPrice
        );

        $limoPrefill = [
            'type' => $type,
            'pickup_id' => $pickupId,
            'dest_id' => $destId,
            'pickup_name' => $pickupName,
            'dest_name' => $destName,
            'pax' => $pax,
            'trip' => $trip,
            'pickup_date' => $pickupDate,
            'return_date' => $returnDate,
            'city_hours' => $cityHoursKey,
            'city_hours_label' => $cityHoursLabel,
            'estimated_price' => $estimatedPrice,
            'max_pax' => $limoMaxPax,
            'vehicle_car_type' => $vehicle['car_type'],
            'vehicle_image' => $vehicle['image'],
        ];

        return view('site.limo.completing-booking', compact('limoPrefill'));
    }

    private function sendLimoBookingEmails(CarRental $rental): void
    {
        DualEmailSender::sendGuest(
            $rental->email,
            new LimoBookingGuestMail($rental),
            'limo_booking',
            ['rental_id' => $rental->id]
        );

        DualEmailSender::sendAdmin(
            new LimoBookingAdminMail($rental),
            'limo_booking',
            ['rental_id' => $rental->id]
        );
    }

    /**
     * Largest last-group cap across all limo routes (airport / travel / city).
     */
    private function maxLimoPassengersGlobal(): int
    {
        $routes = CarRoute::query()
            ->where(function ($q) {
                $q->where('airport_limo', true)
                    ->orWhere('travel_limo', true)
                    ->orWhere('city_ride_limo', true);
            })
            ->with(['prices' => function ($q) {
                $q->select(
                    'id',
                    'car_route_id',
                    'from',
                    'to',
                    'car_type',
                    'limo_city_hours',
                    'price_group_index'
                );
            }])
            ->get(['id']);

        $caps = $routes
            ->map(fn(CarRoute $r) => $this->maxPassengersFromLastBandGroup(
                $r->prices->filter(fn($p) => !$p->isLimoCityPackage())
            ))
            ->filter();

        return $caps->isNotEmpty() ? (int)$caps->max() : 50;
    }

    /**
     * Max "To" passengers among band rows in the last dashboard price group (highest price_group_index).
     */
    private function maxPassengersFromLastBandGroup(Collection $bandPrices): ?int
    {
        if ($bandPrices->isEmpty()) {
            return null;
        }

        $maxGroup = (int)$bandPrices->max(fn($p) => (int)$p->price_group_index);

        $inLastGroup = $bandPrices->filter(fn($p) => (int)$p->price_group_index === $maxGroup);
        $to = (int)$inLastGroup->max('to');

        return $to >= 1 ? $to : null;
    }

    /**
     * City Ride Limo: band rows (from–to pax) linked to city package prices by price_group_index.
     *
     * @return list<array{pickup: int, dest: int|null, bands: list<array{group: int, from: int, to: int, car_type: string}>, city_prices: list<array{group: int, hours: string, ow: float}>}>
     */
    private function limoCityRouteRules(): array
    {
        $tierHours = config('car_transport.car_ride_tier_hours', []);

        return CarRoute::query()
            ->where('city_ride_limo', true)
            ->with(['prices' => function ($q) {
                $q->select(
                    'id',
                    'car_route_id',
                    'from',
                    'to',
                    'oneway_price',
                    'rounded_price',
                    'car_type',
                    'limo_city_hours',
                    'price_group_index'
                );
            }])
            ->get([
                'id',
                'pickup_location_id',
                'destination_id',
            ])
            ->map(function (CarRoute $r) use ($tierHours) {
                $bandPrices = $r->prices->filter(fn($p) => !$p->isLimoCityPackage());

                return [
                    'pickup' => (int)$r->pickup_location_id,
                    'dest' => $r->destination_id !== null ? (int)$r->destination_id : null,
                    'max_pax' => $this->maxPassengersFromLastBandGroup($bandPrices) ?? 50,
                    'bands' => $bandPrices
                        ->map(fn($p) => [
                            'group' => (int)$p->price_group_index,
                            'from' => (int)$p->from,
                            'to' => (int)$p->to,
                            'car_type' => (string)($p->car_type ?? ''),
                        ])->values()->all(),
                    'city_prices' => $r->prices
                        ->filter(fn($p) => $p->isLimoCityPackage())
                        ->map(function ($p) use ($tierHours) {
                            $hours = $p->limo_city_hours;
                            if ($hours === null || $hours === '') {
                                $hours = $tierHours[$p->car_type] ?? null;
                            }

                            return [
                                'group' => (int)$p->price_group_index,
                                'hours' => $hours !== null ? (string)$hours : '',
                                'ow' => round((float)$p->oneway_price, 2),
                                'car_type' => (string)($p->car_type ?? ''),
                            ];
                        })
                        ->filter(fn(array $row) => $row['hours'] !== '')
                        ->values()
                        ->all(),
                ];
            })
            ->values()
            ->all();
    }

    /**
     * Store a limo “complete booking” request as a car rental (pay on arrival).
     */
    public function storeLimoBooking(Request $request): JsonResponse
    {
        $limoMaxPax = $this->maxLimoPassengersGlobal();

        $validated = $request->validate([
            'pickup_location_id' => ['required', 'integer', 'exists:locations,id'],
            'destination_id' => ['nullable', 'integer', 'exists:locations,id'],
            'adults' => ['required', 'integer', 'min:1', 'max:' . $limoMaxPax],
            'children' => ['nullable', 'integer', 'min:0', 'max:30'],
            'car_route_price' => ['required', 'numeric', 'min:0', 'max:10000000'],
            'car_type' => ['nullable', 'string', 'max:255'],
            'oneway' => ['required', 'boolean'],
            'pickup_date' => ['required', 'date'],
            'pickup_time' => ['required', 'string', 'max:32'],
            'return_date' => ['nullable', 'date'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:60'],
            'nationality' => ['nullable', 'string', 'max:120'],
            'notes' => ['nullable', 'string', 'max:5000'],
        ]);

        $pickupId = (int)$validated['pickup_location_id'];
        $destinationId = isset($validated['destination_id']) ? (int)$validated['destination_id'] : 0;
        if ($destinationId < 1) {
            $destinationId = $pickupId;
        }

        $pickupDate = Carbon::parse($validated['pickup_date'])->startOfDay();
        $pickupTimeRaw = trim($validated['pickup_time']);
        try {
            $pickupTime = Carbon::parse($pickupDate->format('Y-m-d') . ' ' . $pickupTimeRaw)->format('H:i:s');
        } catch (\Throwable) {
            return response()->json([
                'message' => 'Invalid pickup time.',
                'errors' => ['pickup_time' => ['Invalid pickup time.']],
            ], 422);
        }

        $returnDate = !empty($validated['return_date'])
            ? Carbon::parse($validated['return_date'])->format('Y-m-d')
            : null;

        $currency = Currency::query()->where('name', 'USD')->first()
            ?? Currency::query()->where('default', true)->first()
            ?? Currency::query()->first();

        $rental = CarRental::query()->create([
            'booking_id' => null,
            'pickup_location_id' => $pickupId,
            'destination_id' => $destinationId,
            'car_route_price' => round((float)$validated['car_route_price'], 2),
            'car_type' => $validated['car_type'] ?? null,
            'adults' => (int)$validated['adults'],
            'children' => (int)($validated['children'] ?? 0),
            'oneway' => (bool)$validated['oneway'],
            'pickup_date' => $pickupDate->format('Y-m-d'),
            'pickup_time' => $pickupTime,
            'return_date' => $returnDate,
            'return_time' => null,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'nationality' => $validated['nationality'] ?? null,
            'notes' => trim((string) ($validated['notes'] ?? '')),
            'currency_id' => $currency?->id,
            'currency_exchange_rate' => $currency !== null ? (float)$currency->exchange_rate : 1.0,
        ]);

        $rental->load(['pickup', 'destination', 'currency']);
        $this->sendLimoBookingEmails($rental);

        return response()->json([
            'ok' => true,
            'message' => __('site.limo_booking_recorded'),
            'id' => $rental->id,
        ]);
    }

    public function index(): View
    {
        $limoAirportLocations = $this->locationsForServiceFlag('airport_limo');
        $limoAirportDestinations = $this->getAirportDestinations($limoAirportLocations->pluck('id')->toArray());
        $limoTravelLocations = $this->locationsForServiceFlag('travel_limo');
        $limoCityLocations = $this->locationsForServiceFlag('city_ride_limo');

        $limoHasAirport = $limoAirportLocations->isNotEmpty();
        $limoHasTravel = $limoTravelLocations->isNotEmpty();
        $limoHasCity = $limoCityLocations->isNotEmpty();

        $limoDefaultTab = $limoHasAirport
            ? 'airport'
            : ($limoHasTravel ? 'travel' : ($limoHasCity ? 'city' : 'airport'));

        $cityRidePrices = config('car_transport.city_ride_default_prices', []);

        $limoTripRouteRules = $this->limoTripRouteRules();
        $limoCityRouteRules = $this->limoCityRouteRules();
        $limoGlobalMaxPassengers = $this->maxLimoPassengersGlobal();
        $limoLocationLabels = $this->limoLocationLabels(
            $limoAirportLocations,
            $limoAirportDestinations,
            $limoTravelLocations,
            $limoCityLocations
        );

        return view('site.limo.new-home', [
            'limoAirportLocations' => $limoAirportLocations,
            'limoAirportDestinations' => $limoAirportDestinations,
            'limoLocationLabels' => $limoLocationLabels,
            'limoTravelLocations' => $limoTravelLocations,
            'limoCityLocations' => $limoCityLocations,
            'limoHasAirport' => $limoHasAirport,
            'limoHasTravel' => $limoHasTravel,
            'limoHasCity' => $limoHasCity,
            'limoDefaultTab' => $limoDefaultTab,
            'cityRidePrices' => $cityRidePrices,
            'limoTripRouteRules' => $limoTripRouteRules,
            'limoCityRouteRules' => $limoCityRouteRules,
            'limoGlobalMaxPassengers' => $limoGlobalMaxPassengers,
        ]);
    }

    /**
     * Active locations that appear on at least one car route for the given service flag.
     */
    private function locationsForServiceFlag(string $column): Collection
    {
        if ($column === 'airport_limo') {
            return Location::active()
                ->whereHas('translation', function ($q) {
                    return $q->where('name', 'like', '%Sphinx International%')->orWhere('name', 'like', '%Cairo International%');
                })
                ->get()
                ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
                ->values();
        }
        $ids = CarRoute::query()
            ->where($column, true)
            ->get(['pickup_location_id', 'destination_id'])
            ->flatMap(fn(CarRoute $r) => [$r->pickup_location_id, $r->destination_id])
            ->unique()
            ->filter()
            ->values();

        if ($ids->isEmpty()) {
            return collect();
        }

        return Location::active()
            ->whereIn('id', $ids)
            ->get()
            ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
            ->values();
    }

    public function getAirportDestinations($pickUpIds)
    {
        $locations = collect([]);
        CarRoute::query()
            ->whereIn('pickup_location_id', $pickUpIds)->with('destination')
            ->get()
            ->filter(fn(CarRoute$cR) => !in_array($cR->destination->id, $pickUpIds))
            ->each(fn(CarRoute $cR) => $locations->push($cR->destination));
        return $locations;
    }

    /**
     * @param  Collection<int, \App\Models\Location>  ...$locationSets
     * @return array<int, string>
     */
    private function limoLocationLabels(Collection ...$locationSets): array
    {
        $labels = [];
        foreach ($locationSets as $locations) {
            foreach ($locations as $location) {
                $labels[(int)$location->id] = (string)$location->name;
            }
        }

        return $labels;
    }

    /**
     * Rules for One Way / Round Trip visibility and per-pax pricing on the limo form.
     *
     * @return list<array{pickup: int, dest: int|null, airport: bool, travel: bool, ow: bool, rt: bool, prices: list<array{from: int, to: int, ow: float, rt: float}>}>
     */
    private function limoTripRouteRules(): array
    {
        return CarRoute::query()
            ->where(function ($q) {
                $q->where('airport_limo', true)
                    ->orWhere('travel_limo', true);
            })
            ->with(['prices' => function ($q) {
                $q->select(
                    'id',
                    'car_route_id',
                    'from',
                    'to',
                    'oneway_price',
                    'rounded_price',
                    'car_type',
                    'limo_city_hours',
                    'price_group_index'
                );
            }])
            ->get([
                'id',
                'pickup_location_id',
                'destination_id',
                'airport_limo',
                'travel_limo',
                'supports_one_way',
                'supports_round_trip',
            ])
            ->map(function (CarRoute $r) {
                $bandPrices = $r->prices->filter(fn($p) => !$p->isLimoCityPackage());

                return [
                    'pickup' => (int)$r->pickup_location_id,
                    'dest' => $r->destination_id !== null ? (int)$r->destination_id : null,
                    'airport' => (bool)$r->airport_limo,
                    'travel' => (bool)$r->travel_limo,
                    'ow' => (bool)$r->supports_one_way,
                    'rt' => (bool)$r->supports_round_trip,
                    'max_pax' => $this->maxPassengersFromLastBandGroup($bandPrices) ?? 50,
                    'prices' => $bandPrices
                        ->map(fn($p) => [
                            'from' => (int)$p->from,
                            'to' => (int)$p->to,
                            'ow' => round((float)$p->oneway_price, 2),
                            'rt' => round((float)$p->rounded_price, 2),
                            'car_type' => (string)($p->car_type ?? ''),
                        ])->values()->all(),
                ];
            })
            ->values()
            ->all();
    }

    /**
     * @return array{car_type: string, image: string}
     */
    private function resolveLimoVehicleForBooking(
        string $type,
        int $pickupId,
        ?int $destId,
        int $pax,
        bool $isRoundTrip,
        string $cityHours,
        ?float $estimatedPrice
    ): array {
        $carType = '';

        if ($type === 'city' && $pickupId > 0 && $cityHours !== '') {
            $carType = $this->resolveCityRideCarType($pickupId, $pax, $cityHours, $estimatedPrice);
        } elseif ($pickupId > 0 && in_array($type, ['airport', 'travel'], true)) {
            $carType = $this->resolveTripCarType($type, $pickupId, $destId, $pax, $isRoundTrip, $estimatedPrice);
        }

        return [
            'car_type' => $carType,
            'image' => $this->limoVehicleImageUrl($carType),
        ];
    }

    private function resolveTripCarType(
        string $type,
        int $pickupId,
        ?int $destId,
        int $pax,
        bool $isRoundTrip,
        ?float $estimatedPrice
    ): string {
        $pool = $this->matchingTripRoutePool($this->limoTripRouteRules(), $type, $pickupId, $destId);
        $candidates = [];

        foreach ($pool as $route) {
            foreach ($route['prices'] as $tier) {
                if ($pax < $tier['from'] || $pax > $tier['to']) {
                    continue;
                }
                $amount = $isRoundTrip ? $tier['rt'] : $tier['ow'];
                if ($amount <= 0) {
                    continue;
                }
                $candidates[] = [
                    'price' => round((float)$amount, 2),
                    'car_type' => (string)($tier['car_type'] ?? ''),
                ];
            }
        }

        return $this->pickCarTypeFromPriceCandidates($candidates, $estimatedPrice);
    }

    private function resolveCityRideCarType(
        int $pickupId,
        int $pax,
        string $cityHours,
        ?float $estimatedPrice
    ): string {
        $candidates = [];

        foreach ($this->limoCityRouteRules() as $route) {
            if ((int)$route['pickup'] !== $pickupId) {
                continue;
            }
            $bands = $route['bands'];
            if ($bands === [] && $route['city_prices'] !== []) {
                $bands = [['group' => $route['city_prices'][0]['group'], 'from' => 1, 'to' => 50, 'car_type' => '']];
            }
            foreach ($bands as $band) {
                if ($pax < $band['from'] || $pax > $band['to']) {
                    continue;
                }
                foreach ($route['city_prices'] as $package) {
                    if ((int)$package['group'] !== (int)$band['group'] || (string)$package['hours'] !== $cityHours) {
                        continue;
                    }
                    if ($package['ow'] <= 0) {
                        continue;
                    }
                    $candidates[] = [
                        'price' => round((float)$package['ow'], 2),
                        'car_type' => (string)($package['car_type'] ?: $band['car_type']),
                    ];
                }
            }
        }

        return $this->pickCarTypeFromPriceCandidates($candidates, $estimatedPrice);
    }

    /**
     * @param  list<array{pickup: int, dest: int|null, airport: bool, travel: bool, prices: list<array{from: int, to: int, ow: float, rt: float, car_type: string}>}>  $rules
     * @return list<array{pickup: int, dest: int|null, airport: bool, travel: bool, prices: list<array{from: int, to: int, ow: float, rt: float, car_type: string}>}>
     */
    private function matchingTripRoutePool(array $rules, string $type, int $pickupId, ?int $destId): array
    {
        $svc = $type === 'airport' ? 'airport' : 'travel';
        $candidates = array_values(array_filter(
            $rules,
            fn(array $r) => $r[$svc] && (int)$r['pickup'] === $pickupId
        ));

        if ($candidates === []) {
            return [];
        }

        if ($destId === null || $destId < 1) {
            return array_values(array_filter(
                $candidates,
                fn(array $r) => $r['dest'] === null
            ));
        }

        $exact = array_values(array_filter(
            $candidates,
            fn(array $r) => $r['dest'] !== null && (int)$r['dest'] === $destId
        ));

        if ($exact !== []) {
            return $exact;
        }

        return array_values(array_filter(
            $candidates,
            fn(array $r) => $r['dest'] === null
        ));
    }

    /**
     * @param  list<array{price: float, car_type: string}>  $candidates
     */
    private function pickCarTypeFromPriceCandidates(array $candidates, ?float $estimatedPrice): string
    {
        if ($candidates === []) {
            return '';
        }

        if ($estimatedPrice !== null && $estimatedPrice > 0) {
            $target = round($estimatedPrice, 2);
            foreach ($candidates as $row) {
                if ($row['price'] === $target && $row['car_type'] !== '') {
                    return $row['car_type'];
                }
            }
        }

        $minPrice = min(array_column($candidates, 'price'));
        foreach ($candidates as $row) {
            if ($row['price'] === $minPrice && $row['car_type'] !== '') {
                return $row['car_type'];
            }
        }

        return (string)($candidates[0]['car_type'] ?? '');
    }

    private function limoVehicleImageUrl(string $carType): string
    {
        $default = (string)config(
            'car_transport.limo_vehicle_image_default',
            'assets/site/limo/image/visa/Visacar5.png'
        );
        $keywords = config('car_transport.limo_vehicle_image_keywords', []);
        $haystack = strtolower($carType);

        if (is_array($keywords)) {
            foreach ($keywords as $keyword => $path) {
                if ($keyword !== '' && str_contains($haystack, strtolower((string)$keyword))) {
                    return asset((string)$path);
                }
            }
        }

        return asset($default);
    }
}
