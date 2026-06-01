<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $isAdminNotification ? 'New ' . ucfirst($formType) . ' Request' : 'Thank You for Your ' . ucfirst($formType) . ' Request' }}</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
        <!-- Header -->
        <div style="background-color: {{ $isAdminNotification ? '#e74c3c' : '#16a085' }}; padding: 30px; text-align: center;">
            @if(isset($settings['logo']) && !empty($settings['logo']))
                <img src="{{ $settings['logo'] }}" alt="Logo" style="max-height: 40px; max-width: 120px;">
            @else
                <h1 style="color: #ffffff; margin: 0; font-size: 24px;">{{ $settings['site_title'] ?? 'Croconile Egypt' }}</h1>
            @endif
        </div>

        <!-- Content -->
        <div style="padding: 40px 30px;">
            @if($isAdminNotification)
                <h2 style="color: #2c3e50; margin-bottom: 20px; font-size: 28px;">📧 New {{ ucfirst($formType) }} Request</h2>
                <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    A new {{ $formType }} request has been received and requires your attention.
                </p>
            @else
                <h2 style="color: #2c3e50; margin-bottom: 20px; font-size: 28px;">💌 Thank You for Your {{ ucfirst($formType) }} Request</h2>
                <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    Dear <strong>{{ $formData['nickname'] ?? '' }} {{ $formData['name'] ?? 'Valued Customer' }}</strong>,
                </p>
                <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    Thank you for submitting your {{ $formType }} request! We've received your information and our team will get back to you as soon as possible to help plan your perfect trip.
                </p>
            @endif

            <!-- Request Information -->
            <div style="background-color: #f8f9fa; border-left: 4px solid #16a085; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">👤 {{ $isAdminNotification ? 'Request Information' : 'Your Information' }}</h3>
                
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold; width: 40%;">Name:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['nickname'] ?? '' }} {{ $formData['name'] ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Email:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['email'] ?? 'N/A' }}</td>
                    </tr>
                    @if(isset($formData['phone']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Phone:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['phone'] }}</td>
                    </tr>
                    @endif
                    @if(isset($formData['nationality']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Nationality:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['nationality'] }}</td>
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
                    @if(isset($formData['arrival_date']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Arrival Date:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['arrival_date'] }}</td>
                    </tr>
                    @endif
                    @if(isset($formData['departure_date']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Departure Date:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['departure_date'] }}</td>
                    </tr>
                    @endif
                    @if(isset($formData['hotel_choice']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Hotel Choice:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['hotel_choice'] }}</td>
                    </tr>
                    @endif
                    @if(isset($formData['age_range']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Age Range:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['age_range'] }}</td>
                    </tr>
                    @endif
                    @if(isset($formData['hear_about_us']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">How did you hear about us:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['hear_about_us'] }}</td>
                    </tr>
                    @endif
                    @if(isset($formData['budget_range']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Budget Range:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['budget_range'] }}</td>
                    </tr>
                    @endif
                </table>
            </div>

            <!-- Cruise Specific Information -->
            @if($formType === 'nile_cruise' && isset($formData['cruise_type']))
            <div style="background-color: #e8f4fd; border-left: 4px solid #3498db; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">🚢 Cruise Preferences</h3>
                
                <table style="width: 100%; border-collapse: collapse;">
                    @if(isset($formData['cruise_type']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold; width: 40%;">Cruise Type:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['cruise_type'] }}</td>
                    </tr>
                    @endif
                    @if(isset($formData['cruise_pick_drop_off']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Pickup/Drop-off:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['cruise_pick_drop_off'] }}</td>
                    </tr>
                    @endif
                    @if(isset($formData['cruise_duration']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Duration:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['cruise_duration'] }}</td>
                    </tr>
                    @endif
                </table>
            </div>
            @endif

            <!-- Notes -->
            @if(isset($formData['notes']) && !empty($formData['notes']))
            <div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">📝 Additional Notes</h3>
                <div style="color: #555; font-size: 16px; line-height: 1.6; background-color: #ffffff; padding: 20px; border-radius: 5px; border: 1px solid #e9ecef;">
                    {{ $formData['notes'] }}
                </div>
            </div>
            @endif

            @if($isAdminNotification)
                <!-- Action Button for Admin -->
                <div style="text-align: center; margin: 40px 0;">
                    <a href="{{ url('/dashboard/appointments') }}" style="background-color: #3498db; color: #ffffff; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px; display: inline-block;">
                        📊 View in Dashboard
                    </a>
                </div>

                <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    Please review this {{ $formType }} request and respond to the customer appropriately.
                </p>
            @else
                <!-- Next Steps for Client -->
                <div style="background-color: #d4edda; border-left: 4px solid #28a745; padding: 25px; margin: 30px 0; border-radius: 5px;">
                    <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">⏰ What to Expect</h3>
                    
                    <ul style="color: #555; font-size: 16px; line-height: 1.6; margin: 0; padding-left: 20px;">
                        <li>We'll review your {{ $formType }} request within 24 hours</li>
                        <li>Our travel experts will create a personalized itinerary for you</li>
                        <li>You'll receive detailed pricing and booking information</li>
                        <li>If you need immediate assistance, please call us at {{ $settings['primary_phone'] ?? 'our contact number' }}</li>
                        <li>You can also reach us via WhatsApp at {{ $settings['whatsapp_phone_number'] ?? 'our WhatsApp number' }}</li>
                    </ul>
                </div>

                <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    We're excited to help you plan your perfect trip to Egypt! Our team of experienced travel experts will work with you to create an unforgettable experience.
                </p>
            @endif

            <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                Best regards,<br>
                <strong>{{ $settings['site_title'] ?? 'Croconile Egypt' }} Team</strong>
            </p>
        </div>

        <!-- Footer -->
        <div style="background-color: #34495e; padding: 30px; text-align: center; color: #ffffff;">
            <p style="margin: 0 0 15px 0; font-size: 14px;">
                {{ $settings['footer_text'] ?? 'Thank you for choosing our services' }}
            </p>
            <p style="margin: 0; font-size: 12px; color: #bdc3c7;">
                © {{ date('Y') }} {{ $settings['site_title'] ?? 'Croconile Egypt' }}. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html> 