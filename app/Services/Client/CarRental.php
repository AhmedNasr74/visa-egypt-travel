<?php

namespace App\Services\Client;

use App\Models\CarRoute;

class CarRental
{
    /**
     * Whether a car route already exists for the given pickup and destination locations.
     */
    public function search(int $pickupLocationId, int $destinationId): bool
    {
        return CarRoute::query()
            ->where('pickup_location_id', $pickupLocationId)
            ->when(
                $destinationId !== null,
                fn ($q) => $q->where('destination_id', $destinationId),
                fn ($q) => $q->whereNull('destination_id')
            )
            ->exists();
    }
}
