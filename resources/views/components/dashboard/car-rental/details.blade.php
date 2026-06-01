@props([
    'carRental' => null,
])

@php
    /** @var \App\Models\CarRental|null $carRental */
    $totalStops = $carRental ? $carRental->stops->sum('price') : 0;
    $symbol = $carRental?->currency?->symbol ?? '';
    $rate = (float) ($carRental?->currency_exchange_rate ?? 1);
    $lineTotal = $carRental ? $rate * ($carRental->car_route_price + $totalStops) : 0;
@endphp

@if ($carRental)
    <div class="table-responsive table-details">
        <table class="table cart-table table-bbookingless">
            <thead>
                <tr>
                    <th style="padding-left: 15px;">Trip</th>
                    <th>Vehicle &amp; passengers</th>
                    <th>Pricing</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td valign="top" style="padding-left: 15px; max-width: 280px">
                        <h5 class="mt-2 mb-1" style="font-size: 15px;">Pickup</h5>
                        <p class="mb-2 text-muted">{{ $carRental->pickup?->name ?? '—' }}</p>
                        <h5 class="mb-1" style="font-size: 15px;">Destination</h5>
                        <p class="mb-0 text-muted">{{ $carRental->destination?->name ?? '—' }}</p>
                        @if ($carRental->stops->isNotEmpty())
                            <h6 class="mt-3 mb-1">Stops</h6>
                            <ul class="list-unstyled small text-muted mb-0">
                                @foreach ($carRental->stops as $stop)
                                    <li>{{ $stop->location?->name ?? 'Stop' }} @if ($stop->price > 0) (+{{ $symbol }}{{ number_format($stop->price, 2) }}) @endif</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td valign="top" style="padding-left: 15px;">
                        <h5 class="mt-2 mb-1" style="font-size: 14px;">{{ $carRental->car_type ?? '—' }}</h5>
                        <p class="mb-1"><strong>Trip:</strong> {{ $carRental->rental_type }}</p>
                        <p class="mb-1"><strong>Adults:</strong> {{ $carRental->adults }}</p>
                        <p class="mb-0"><strong>Children:</strong> {{ $carRental->children }}</p>
                    </td>
                    <td valign="top" style="padding-left: 15px;">
                        <p class="mb-1"><strong>Route price:</strong> {{ $symbol }}{{ number_format($carRental->car_route_price, 2) }}</p>
                        @if ($totalStops > 0)
                            <p class="mb-1"><strong>Stops total:</strong> {{ $symbol }}{{ number_format($totalStops, 2) }}</p>
                        @endif
                        <p class="mb-0 mt-2"><strong>Total:</strong> <span class="theme-color fw-bold">{{ $symbol }}{{ number_format($lineTotal, 2) }}</span></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    @if (filled($carRental->notes))
        <div class="mt-3 rounded border bg-light p-3">
            <h6 class="fw-bold mb-2">Notes</h6>
            <div class="text-muted small" style="white-space: pre-wrap;">{{ $carRental->notes }}</div>
        </div>
    @endif
@endif
