<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $isAdminNotification ? 'New Tailor Made Request' : 'Tailor Made Request Confirmation' }}</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
        <!-- Header -->
        <div style="background-color: {{ $isAdminNotification ? '#e74c3c' : '#9b59b6' }}; padding: 30px; text-align: center;">
            @if(isset($settings['logo']) && !empty($settings['logo']))
                <img src="{{ $settings['logo'] }}" alt="Logo" style="max-height: 40px; max-width: 120px;">
            @else
                <h1 style="color: #ffffff; margin: 0; font-size: 24px;">{{ $settings['site_title'] ?? 'Tour Company' }}</h1>
            @endif
        </div>

        <!-- Content -->
        <div style="padding: 40px 30px;">
            @if($isAdminNotification)
                <h2 style="color: #2c3e50; margin-bottom: 20px; font-size: 28px;">🔔 New Tailor Made Tour Request</h2>
                <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    A new tailor-made tour request has been submitted and requires your attention.
                </p>
            @else
                <h2 style="color: #2c3e50; margin-bottom: 20px; font-size: 28px;">🎨 Your Tailor Made Request Received</h2>
                <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    Dear <strong>{{ $formData['name'] ?? 'Valued Customer' }}</strong>,
                </p>
                <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    Thank you for your tailor-made tour request! We've received your inquiry and our team will review it carefully to create the perfect custom experience for you.
                </p>
            @endif

            <!-- Client Details -->
            <div style="background-color: #f8f9fa; border-left: 4px solid #9b59b6; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">👤 {{ $isAdminNotification ? 'Client Details' : 'Your Information' }}</h3>
                
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold; width: 40%;">Name:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['name'] ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Email:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['email'] ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Phone:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['phone'] ?? 'N/A' }}</td>
                    </tr>
                    @if(isset($formData['nationality']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Nationality:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['nationality'] }}</td>
                    </tr>
                    @endif
                </table>
            </div>

            <!-- Tour Requirements -->
            <div style="background-color: #e8f4fd; border-left: 4px solid #3498db; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">🎯 Tour Requirements</h3>
                
                <table style="width: 100%; border-collapse: collapse;">
                    @if(isset($formData['destination']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold; width: 40%;">Destination:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['destination'] }}</td>
                    </tr>
                    @endif
                    @if(isset($formData['duration']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Duration:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['duration'] }}</td>
                    </tr>
                    @endif
                    @if(isset($formData['adults']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Adults:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['adults'] }}</td>
                    </tr>
                    @endif
                    @if(isset($formData['children']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Children:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['children'] }}</td>
                    </tr>
                    @endif
                    @if(isset($formData['budget']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Budget:</td>
                        <td style="padding: 8px 0; color: #27ae60; font-weight: bold;">${{ number_format($formData['budget'], 2) }}</td>
                    </tr>
                    @endif
                    @if(isset($formData['travel_date']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Travel Date:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['travel_date'] }}</td>
                    </tr>
                    @endif
                </table>
            </div>

            <!-- Special Requirements -->
            @if(isset($formData['requirements']) && !empty($formData['requirements']))
            <div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">📝 Special Requirements</h3>
                <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 0;">{{ $formData['requirements'] }}</p>
            </div>
            @endif

            @if($isAdminNotification)
                <!-- Action Button for Admin -->
                <div style="text-align: center; margin: 40px 0;">
                    <a href="{{ url('/dashboard/tailor-made') }}" style="background-color: #3498db; color: #ffffff; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px; display: inline-block;">
                        📊 View in Dashboard
                    </a>
                </div>

                <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    Please review this tailor-made request and create a custom proposal for the client.
                </p>
            @else
                <!-- Next Steps for Client -->
                <div style="background-color: #d4edda; border-left: 4px solid #28a745; padding: 25px; margin: 30px 0; border-radius: 5px;">
                    <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">📅 What's Next?</h3>
                    
                    <ul style="color: #555; font-size: 16px; line-height: 1.6; margin: 0; padding-left: 20px;">
                        <li>Our travel experts will review your requirements within 24 hours</li>
                        <li>You'll receive a customized tour proposal with detailed itinerary</li>
                        <li>We'll work with you to refine the plan until it's perfect</li>
                        <li>Once approved, we'll handle all the booking arrangements</li>
                    </ul>
                </div>

                <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    We're excited to create the perfect custom experience for you. Our team will be in touch soon!
                </p>
            @endif

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