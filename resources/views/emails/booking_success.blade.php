<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
        <!-- Header -->
        <div style="background-color: #2c3e50; padding: 30px; text-align: center;">
            @if(isset($settings['logo']) && !empty($settings['logo']))
                <img src="{{ $settings['logo'] }}" alt="Logo" style="max-height: 60px; max-width: 200px;">
            @else
                <h1 style="color: #ffffff; margin: 0; font-size: 24px;">{{ $settings['site_title'] ?? 'Tour Company' }}</h1>
            @endif
        </div>

        <!-- Content -->
        <div style="padding: 40px 30px;">
            <h2 style="color: #2c3e50; margin-bottom: 20px; font-size: 28px;">🎉 Your Tour Booking is Confirmed!</h2>
            
            <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                Dear <strong>{{ $booking->name }}</strong>,
            </p>
            
            <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                Thank you for choosing us for your tour! We're excited to confirm your booking and look forward to providing you with an amazing experience.
            </p>

            <!-- Booking Details -->
            <div style="background-color: #f8f9fa; border-left: 4px solid #3498db; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">📋 Booking Details</h3>
                
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
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Number of Adults:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $booking->adults_count }}</td>
                    </tr>
                    @if($booking->children_count > 0)
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Number of Children:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $booking->children_count }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Total Price:</td>
                        <td style="padding: 8px 0; color: #27ae60; font-weight: bold; font-size: 18px;">${{ number_format($booking->total_price, 2) }}</td>
                    </tr>
                </table>
            </div>

            <!-- Contact Information -->
            <div style="background-color: #e8f4fd; border-left: 4px solid #3498db; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">📞 Contact Information</h3>
                
                <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 15px;">
                    <strong>Email:</strong> {{ $booking->email }}<br>
                    <strong>Phone:</strong> {{ $booking->phone }}<br>
                    <strong>Nationality:</strong> {{ $booking->nationality }}
                </p>
            </div>

            <!-- Next Steps -->
            <div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">📅 What's Next?</h3>
                
                <ul style="color: #555; font-size: 16px; line-height: 1.6; margin: 0; padding-left: 20px;">
                    <li>You will receive a detailed itinerary 24 hours before your tour</li>
                    <li>Please arrive 15 minutes before the scheduled departure time</li>
                    <li>Don't forget to bring comfortable walking shoes and a camera</li>
                    <li>If you have any questions, feel free to contact us</li>
                </ul>
            </div>

            <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                We're committed to making your tour experience unforgettable. Thank you for choosing us!
            </p>

            <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                Best regards,<br>
                <strong>{{ $settings['site_title'] ?? 'Tour Company' }} Team</strong>
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