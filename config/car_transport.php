<?php

/**
 * City ride tiers: car_type strings MUST match what the limo site uses (radio values / LIMO_CITY_PRICES keys).
 * Dashboard create/edit uses these rows with from=1, to=50 (any passenger count for the package).
 */
$cityRideTiers = [
    [
        'car_type' => 'Short Ride (3 Hours)',
        'hours' => '3',
        'label' => 'Short Ride — 3 Hours',
    ],
    [
        'car_type' => 'Long Ride (6 Hours)',
        'hours' => '6',
        'label' => 'Long Ride — 6 Hours',
    ],
    [
        'car_type' => 'Full Day Ride (8 Hours)',
        'hours' => '8',
        'label' => 'Full Day Ride — 8 Hours',
    ],
    [
        'car_type' => 'Full Day Ride — 12 Hours (Full Day)',
        'hours' => '12',
        'label' => 'Full Day Ride — 12 Hours (Full Day)',
    ],
];

return [
    'city_ride_tiers' => $cityRideTiers,

    'car_ride_tier_hours' => array_column($cityRideTiers, 'hours', 'car_type'),
    'city_ride_default_prices' => [
        '3' => 515,
        '6' => 920,
        '8' => 1180,
        '12' => 1650,
    ],
];
