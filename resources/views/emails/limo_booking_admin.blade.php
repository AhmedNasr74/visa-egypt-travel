<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Limo Booking</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
        <div style="background-color: #1a2744; padding: 30px; text-align: center;">
            @if(!empty($settings['logo']))
                <img src="{{ $settings['logo'] }}" alt="Logo" style="max-height: 60px; max-width: 200px;">
            @else
                <h1 style="color: #ffffff; margin: 0; font-size: 24px;">{{ $settings['site_title'] }}</h1>
            @endif
        </div>

        <div style="padding: 40px 30px;">
            <h2 style="color: #2c3e50; margin-bottom: 20px; font-size: 28px;">New limo booking received</h2>
            <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                Booking reference: <strong>#{{ $rental->id }}</strong> — pay on arrival.
            </p>

            <div style="background-color: #f8f9fa; border-left: 4px solid #1a2744; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">Guest details</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold; width: 40%;">Name:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $rental->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Email:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $rental->email }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Phone:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $rental->phone }}</td>
                    </tr>
                    @if($rental->nationality)
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Nationality:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $rental->nationality }}</td>
                    </tr>
                    @endif
                </table>
            </div>

            <div style="background-color: #e8f4fd; border-left: 4px solid #3498db; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">Trip details</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold; width: 40%;">Pickup:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $rental->pickup?->name ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Drop-off:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $rental->destination?->name ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Pickup date:</td>
                        <td style="padding: 8px 0; color: #333;">
                            {{ $rental->pickup_date ? $rental->pickup_date->format('F j, Y') : '—' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Pickup time:</td>
                        <td style="padding: 8px 0; color: #333;">
                            @if($rental->pickup_time)
                                {{ $rental->pickup_time->format('g:i A') }}
                            @else
                                —
                            @endif
                        </td>
                    </tr>
                    @if($rental->return_date)
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Return date:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $rental->return_date->format('F j, Y') }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Trip type:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $rental->rental_type }}</td>
                    </tr>
                    @if($rental->car_type)
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Vehicle:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $rental->car_type }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Passengers:</td>
                        <td style="padding: 8px 0; color: #333;">
                            {{ $rental->adults }} adult(s)@if($rental->children > 0), {{ $rental->children }} child(ren)@endif
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Price:</td>
                        <td style="padding: 8px 0; color: #27ae60; font-weight: bold; font-size: 18px;">
                            {{ ($rental->currency?->symbol ?? '$') . number_format((float) $rental->car_route_price, 2) }}
                        </td>
                    </tr>
                </table>
            </div>

            @if($rental->notes)
            <div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">Notes</h3>
                <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 0; white-space: pre-wrap;">{{ $rental->notes }}</p>
            </div>
            @endif

            <div style="text-align: center; margin: 40px 0;">
                <a href="{{ url('/dashboard/car-rentals/' . $rental->id) }}" style="background-color: #3498db; color: #ffffff; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px; display: inline-block;">
                    View in dashboard
                </a>
            </div>
        </div>

        <div style="background-color: #34495e; padding: 30px; text-align: center; color: #ffffff;">
            <p style="margin: 0 0 15px 0; font-size: 14px;">{{ $settings['footer_text'] }}</p>
            <p style="margin: 0; font-size: 12px; color: #bdc3c7;">
                © {{ date('Y') }} {{ $settings['site_title'] }}. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
