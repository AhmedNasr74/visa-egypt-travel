<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['site_title'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 20px;
        }
        .logo {
             max-width: 120px;
             height: auto;
            margin-bottom: 15px;
        }
        .title {
            color: #2c3e50;
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
        }
        .subtitle {
            color: #7f8c8d;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 30px;
        }
        .greeting {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .trip-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            color: #495057;
            min-width: 120px;
        }
        .detail-value {
            color: #6c757d;
            text-align: right;
        }
        .cta-button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
        }
        .cta-button:hover {
            background-color: #0056b3;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e0e0e0;
            color: #6c757d;
            font-size: 14px;
        }
        .contact-info {
            background-color: #e3f2fd;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        .contact-info h4 {
            color: #1976d2;
            margin-bottom: 10px;
        }
        .contact-item {
            margin: 5px 0;
        }
        .alert {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            @if($settings['logo'])
                <img src="{{ $settings['logo'] }}" alt="{{ $settings['site_title'] }}" class="logo">
            @endif
            <div class="title">{{ $settings['site_title'] }}</div>
            <div class="subtitle">
                @if($isAdminNotification)
                    New Customized Trip Request
                @else
                    Customized Trip Request Confirmation
                @endif
            </div>
        </div>

        <div class="content">
            @if($isAdminNotification)
                <!-- Admin Notification Content -->
                <div class="alert">
                    <strong>⚠️ New Request Alert:</strong> A new customized trip request has been submitted and requires your attention.
                </div>
                
                <div class="greeting">Hello Admin,</div>
                <p>A new customized trip request has been submitted with the following details:</p>
            @else
                <!-- Client Confirmation Content -->
                <div class="greeting">Dear {{ $formData['name'] }},</div>
                <p>Thank you for submitting your customized trip request! We have received your inquiry and our team will review it carefully.</p>
                <p>Here are the details of your request:</p>
            @endif

            <div class="trip-details">
                <div class="detail-row">
                    <span class="detail-label">Name:</span>
                    <span class="detail-value">{{ $formData['name'] }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">{{ $formData['email'] }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Phone:</span>
                    <span class="detail-value">{{ $formData['phone'] }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Nationality:</span>
                    <span class="detail-value">{{ $formData['nationality'] }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Destination:</span>
                    <span class="detail-value">{{ $formData['destination'] }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Duration:</span>
                    <span class="detail-value">{{ $formData['duration'] }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Travel Date:</span>
                    <span class="detail-value">{{ $formData['travel_date'] }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Adults:</span>
                    <span class="detail-value">{{ $formData['adults'] }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Children:</span>
                    <span class="detail-value">{{ $formData['children'] }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Infants:</span>
                    <span class="detail-value">{{ $formData['infants'] }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Accommodation:</span>
                    <span class="detail-value">{{ $formData['budget'] }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Requirements:</span>
                    <span class="detail-value">{{ $formData['requirements'] }}</span>
                </div>
            </div>

            @if($isAdminNotification)
                <!-- Admin specific content -->
                <div style="text-align: center; margin: 30px 0;">
                    <a href="{{ url('/dashboard/customized-trips/' . $tripId) }}" class="cta-button">
                        View Trip Details in Dashboard
                    </a>
                </div>
                
                <div class="contact-info">
                    <h4>📞 Contact Information</h4>
                    <div class="contact-item"><strong>Client Email:</strong> {{ $formData['email'] }}</div>
                    <div class="contact-item"><strong>Client Phone:</strong> {{ $formData['phone'] }}</div>
                    <div class="contact-item"><strong>Nationality:</strong> {{ $formData['nationality'] }}</div>
                </div>

                <p><strong>Next Steps:</strong></p>
                <ul>
                    <li>Review the trip requirements carefully</li>
                    <li>Prepare a customized itinerary</li>
                    <li>Contact the client with your proposal</li>
                    <li>Update the trip status in the dashboard</li>
                </ul>
            @else
                <!-- Client specific content -->
                <div class="contact-info">
                    <h4>📞 What's Next?</h4>
                    <p>Our travel experts will review your request and contact you within 24-48 hours with a customized itinerary and pricing.</p>
                    <p>If you have any urgent questions, please don't hesitate to contact us:</p>
                    @if($settings['primary_phone'])
                        <div class="contact-item"><strong>Phone:</strong> {{ $settings['primary_phone'] }}</div>
                    @endif
                    @if($settings['whatsapp_phone_number'])
                        <div class="contact-item"><strong>WhatsApp:</strong> {{ $settings['whatsapp_phone_number'] }}</div>
                    @endif
                </div>

                <p><strong>What to expect:</strong></p>
                <ul>
                    <li>Personalized itinerary based on your requirements</li>
                    <li>Detailed pricing breakdown</li>
                    <li>Flexible booking options</li>
                    <li>24/7 support during your trip</li>
                </ul>
            @endif
        </div>

        <div class="footer">
            <p>{{ $settings['footer_text'] ?: 'Thank you for choosing ' . $settings['site_title'] }}</p>
            <p>© {{ date('Y') }} {{ $settings['site_title'] }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html> 