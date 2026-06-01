<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Booking Notification</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
        <!-- Header -->
        <div style="background-color: #e74c3c; padding: 30px; text-align: center;">
            @if(isset($settings['logo']) && !empty($settings['logo']))
                <img src="{{ $settings['logo'] }}" alt="Logo" style="max-height: 60px; max-width: 200px;">
            @else
                <h1 style="color: #ffffff; margin: 0; font-size: 24px;">{{ $settings['site_title'] ?? 'Tour Company' }}</h1>
            @endif
        </div>

        <!-- Content -->
        <div style="padding: 40px 30px;">
            <h2 style="color: #2c3e50; margin-bottom: 20px; font-size: 28px;">🔔 New Tour Booking Received</h2>
            
            <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                A new tour booking has been submitted and requires your attention.
            </p>

            <!-- Client Details -->
            <div style="background-color: #f8f9fa; border-left: 4px solid #e74c3c; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">👤 Client Details</h3>
                
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold; width: 40%;">Name:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $booking->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Email:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $booking->email }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Phone:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $booking->phone }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Nationality:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $booking->nationality }}</td>
                    </tr>
                </table>
            </div>

            <!-- Tour Details -->
            <div style="background-color: #e8f4fd; border-left: 4px solid #3498db; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">🏖️ Tour Details</h3>
                
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold; width: 40%;">Tour Name:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $booking->tour->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Booking Date:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $booking->date ? $booking->date->format('F j, Y') : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Adults:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $booking->adults_count }} ({{ number_format($booking->adult_price, 2) }} each)</td>
                    </tr>
                    @if($booking->children_count > 0)
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Children:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $booking->children_count }} ({{ number_format($booking->child_price, 2) }} each)</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Total Price:</td>
                        <td style="padding: 8px 0; color: #27ae60; font-weight: bold; font-size: 18px;">${{ number_format($booking->total_price, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Payment Status:</td>
                        <td style="padding: 8px 0; color: #333;">
                            <span style="background-color: {{ $booking->payment_status === 'paid' ? '#27ae60' : '#f39c12' }}; color: white; padding: 4px 8px; border-radius: 3px; font-size: 12px;">
                                {{ ucfirst($booking->payment_status ?? 'pending') }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Additional Information -->
            @if($booking->notes)
            <div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">📝 Additional Notes</h3>
                <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 0;">{{ $booking->notes }}</p>
            </div>
            @endif

            <!-- Action Button -->
            <div style="text-align: center; margin: 40px 0;">
                <a href="{{ url('/dashboard/bookings') }}" style="background-color: #3498db; color: #ffffff; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px; display: inline-block;">
                    📊 View in Dashboard
                </a>
            </div>

            <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                Please review this booking and take appropriate action. You can access the full booking details through the dashboard.
            </p>

            <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                Best regards,<br>
                <strong>{{ $settings['site_title'] ?? 'Tour Company' }} System</strong>
            </p>
        </div>

        <!-- Footer -->
        <div style="background-color: #34495e; padding: 30px; text-align: center; color: #ffffff;">
            <p style="margin: 0 0 15px 0; font-size: 14px;">
                {{ $settings['footer_text'] ?? 'Thank you for choosing our services' }}
            </p>
            <p style="margin: 0; font-size: 12px; color: #bdc3c7;">
                © {{ date('Y') }} {{ $settings['site_title'] ?? 'Tour Company' }}. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html> 