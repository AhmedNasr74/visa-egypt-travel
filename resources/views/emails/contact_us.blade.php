<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $isAdminNotification ? 'New Contact Form Submission' : 'Thank You for Contacting Us' }}</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
        <!-- Header -->
        <div style="background-color: {{ $isAdminNotification ? '#e74c3c' : '#16a085' }}; padding: 30px; text-align: center;">
            @if(isset($settings['logo']) && !empty($settings['logo']))
                <img src="{{ $settings['logo'] }}" alt="Logo" style="max-height: 40px; max-width: 120px;">
            @else
                <h1 style="color: #ffffff; margin: 0; font-size: 24px;">{{ $settings['site_title'] ?? 'Tour Company' }}</h1>
            @endif
        </div>

        <!-- Content -->
        <div style="padding: 40px 30px;">
            @if($isAdminNotification)
                <h2 style="color: #2c3e50; margin-bottom: 20px; font-size: 28px;">📧 New Contact Form Submission</h2>
                <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    A new contact form submission has been received and requires your attention.
                </p>
            @else
                <h2 style="color: #2c3e50; margin-bottom: 20px; font-size: 28px;">💌 Thank You for Contacting Us</h2>
                <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    Dear <strong>{{ $formData['name'] ?? 'Valued Customer' }}</strong>,
                </p>
                <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    Thank you for reaching out to us! We've received your message and our team will get back to you as soon as possible.
                </p>
            @endif

            <!-- Contact Information -->
            <div style="background-color: #f8f9fa; border-left: 4px solid #16a085; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">👤 {{ $isAdminNotification ? 'Contact Information' : 'Your Information' }}</h3>
                
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold; width: 40%;">Name:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['name'] ?? 'N/A' }}</td>
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
                    @if(isset($formData['subject']))
                    <tr>
                        <td style="padding: 8px 0; color: #555; font-weight: bold;">Subject:</td>
                        <td style="padding: 8px 0; color: #333;">{{ $formData['subject'] }}</td>
                    </tr>
                    @endif
                </table>
            </div>

            <!-- Message Content -->
            @if(isset($formData['message']) && !empty($formData['message']))
            <div style="background-color: #e8f4fd; border-left: 4px solid #3498db; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">💬 Message</h3>
                <div style="color: #555; font-size: 16px; line-height: 1.6; background-color: #ffffff; padding: 20px; border-radius: 5px; border: 1px solid #e9ecef;">
                    {{ $formData['message'] }}
                </div>
            </div>
            @endif

            <!-- Additional Information -->
            @if(isset($formData['additional_info']))
            <div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 25px; margin: 30px 0; border-radius: 5px;">
                <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">📋 Additional Information</h3>
                <p style="color: #555; font-size: 16px; line-height: 1.6; margin: 0;">{{ $formData['additional_info'] }}</p>
            </div>
            @endif

            @if($isAdminNotification)
                <!-- Action Button for Admin -->
                <div style="text-align: center; margin: 40px 0;">
                    <a href="{{ url('/dashboard/contacts') }}" style="background-color: #3498db; color: #ffffff; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px; display: inline-block;">
                        📊 View in Dashboard
                    </a>
                </div>

                <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    Please review this contact form submission and respond to the customer appropriately.
                </p>
            @else
                <!-- Next Steps for Client -->
                <div style="background-color: #d4edda; border-left: 4px solid #28a745; padding: 25px; margin: 30px 0; border-radius: 5px;">
                    <h3 style="color: #2c3e50; margin-top: 0; margin-bottom: 20px; font-size: 20px;">⏰ What to Expect</h3>
                    
                    <ul style="color: #555; font-size: 16px; line-height: 1.6; margin: 0; padding-left: 20px;">
                        <li>We'll review your message within 24 hours</li>
                        <li>Our team will respond with detailed information or answers to your questions</li>
                        <li>If you need immediate assistance, please call us at {{ $settings['primary_phone'] ?? 'our contact number' }}</li>
                        <li>You can also reach us via WhatsApp at {{ $settings['whatsapp_phone_number'] ?? 'our WhatsApp number' }}</li>
                    </ul>
                </div>

                <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    We appreciate your interest in our services and look forward to helping you plan your perfect trip!
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