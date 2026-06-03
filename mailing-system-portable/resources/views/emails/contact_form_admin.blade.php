<!DOCTYPE html>
<html>
<head>
    <title>New Booking Contact Form - Visa Egypt Travel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            background: linear-gradient(135deg, #2c5530, #4a7c59);
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px 20px;
        }
        .content h2 {
            color: #2c5530;
            margin-bottom: 20px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            color: #555555;
            margin-bottom: 15px;
        }
        .contact-details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            border-left: 4px solid #4a7c59;
            margin: 20px 0;
        }
        .contact-details h3 {
            color: #2c5530;
            margin-top: 0;
        }
        .detail-row {
            display: flex;
            margin-bottom: 10px;
            padding: 5px 0;
        }
        .detail-label {
            font-weight: bold;
            color: #2c5530;
            min-width: 120px;
        }
        .detail-value {
            color: #555555;
            flex: 1;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #aaaaaa;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin-top: 20px;
            background: linear-gradient(135deg, #2c5530, #4a7c59);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn:hover {
            background: linear-gradient(135deg, #1e3a21, #3a5c47);
        }
        .timestamp {
            color: #888;
            font-size: 12px;
            text-align: right;
            margin-top: 20px;
        }
        .priority-high {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 10px;
            border-radius: 5px;
            margin: 15px 0;
        }
        .priority-high h4 {
            color: #856404;
            margin: 0 0 5px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🏛️ New Booking Contact Form</h1>
            <p>Visa Egypt Travel</p>
        </div>
        <div class="content">
            <h2>Hello Admin,</h2>
            <p>You have received a new booking contact form submission from your website. This requires immediate attention:</p>
            
            <div class="priority-high">
                <h4>⚠️ High Priority - Booking Inquiry</h4>
                <p>This is a potential customer interested in booking a tour. Please respond promptly to secure the booking.</p>
            </div>
            
            <div class="contact-details">
                <h3>📋 Customer Information</h3>
                <div class="detail-row">
                    <span class="detail-label">Name:</span>
                    <span class="detail-value">{{ $data['name'] ?? 'Not provided' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">{{ $data['email'] ?? 'Not provided' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Phone:</span>
                    <span class="detail-value">{{ $data['phone'] ?? 'Not provided' }}</span>
                </div>
                @if(isset($data['subject']))
                <div class="detail-row">
                    <span class="detail-label">Subject:</span>
                    <span class="detail-value">{{ $data['subject'] }}</span>
                </div>
                @endif
                @if(isset($data['type']))
                <div class="detail-row">
                    <span class="detail-label">Inquiry Type:</span>
                    <span class="detail-value">{{ $data['type'] }}</span>
                </div>
                @endif
                @if(isset($data['message']))
                <div class="detail-row">
                    <span class="detail-label">Message:</span>
                    <span class="detail-value">{{ $data['message'] }}</span>
                </div>
                @endif
                @if(isset($data['tour_name']))
                <div class="detail-row">
                    <span class="detail-label">Tour Interest:</span>
                    <span class="detail-value">{{ $data['tour_name'] }}</span>
                </div>
                @endif
                @if(isset($data['travel_date']))
                <div class="detail-row">
                    <span class="detail-label">Preferred Travel Date:</span>
                    <span class="detail-value">{{ $data['travel_date'] }}</span>
                </div>
                @endif
                @if(isset($data['adults_count']))
                <div class="detail-row">
                    <span class="detail-label">Number of Adults:</span>
                    <span class="detail-value">{{ $data['adults_count'] }}</span>
                </div>
                @endif
                @if(isset($data['children_count']))
                <div class="detail-row">
                    <span class="detail-label">Number of Children:</span>
                    <span class="detail-value">{{ $data['children_count'] }}</span>
                </div>
                @endif
                @if(isset($data['nationality']))
                <div class="detail-row">
                    <span class="detail-label">Nationality:</span>
                    <span class="detail-value">{{ $data['nationality'] }}</span>
                </div>
                @endif
                @if(isset($data['payment_status']))
                <div class="detail-row">
                    <span class="detail-label">Payment Status:</span>
                    <span class="detail-value">{{ $data['payment_status'] }}</span>
                </div>
                @endif
                @if(isset($data['booking_id']))
                <div class="detail-row">
                    <span class="detail-label">Booking ID:</span>
                    <span class="detail-value">#{{ $data['booking_id'] }}</span>
                </div>
                @endif
                @if(isset($data['order_id']))
                <div class="detail-row">
                    <span class="detail-label">Order ID:</span>
                    <span class="detail-value">{{ $data['order_id'] }}</span>
                </div>
                @endif
            </div>
            
            <!-- Tour Details Section -->
            @if(isset($data['tour_name']) && $data['tour_name'] !== 'Unknown Tour')
            <div class="contact-details">
                <h3>🏛️ Tour Details</h3>
                @if(isset($data['tour_name']))
                <div class="detail-row">
                    <span class="detail-label">Tour Name:</span>
                    <span class="detail-value">{{ $data['tour_name'] }}</span>
                </div>
                @endif
                @if(isset($data['tour_duration']))
                <div class="detail-row">
                    <span class="detail-label">Duration:</span>
                    <span class="detail-value">{{ $data['tour_duration'] }}</span>
                </div>
                @endif
                @if(isset($data['tour_type']))
                <div class="detail-row">
                    <span class="detail-label">Tour Type:</span>
                    <span class="detail-value">{{ $data['tour_type'] }}</span>
                </div>
                @endif
                @if(isset($data['tour_location']))
                <div class="detail-row">
                    <span class="detail-label">Location:</span>
                    <span class="detail-value">{{ $data['tour_location'] }}</span>
                </div>
                @endif
                @if(isset($data['tour_pickup_time']))
                <div class="detail-row">
                    <span class="detail-label">Pickup Time:</span>
                    <span class="detail-value">{{ $data['tour_pickup_time'] }}</span>
                </div>
                @endif
                @if(isset($data['tour_guests']))
                <div class="detail-row">
                    <span class="detail-label">Max Guests:</span>
                    <span class="detail-value">{{ $data['tour_guests'] }}</span>
                </div>
                @endif
            </div>
            @endif
            
            <!-- Pricing Details Section -->
            <div class="contact-details">
                <h3>💰 Pricing Details</h3>
                @if(isset($data['adult_price']))
                <div class="detail-row">
                    <span class="detail-label">Adult Price:</span>
                    <span class="detail-value">{{ number_format($data['adult_price'], 2) }} {{ $data['currency_code'] ?? 'USD' }}</span>
                </div>
                @endif
                @if(isset($data['child_price']))
                <div class="detail-row">
                    <span class="detail-label">Child Price:</span>
                    <span class="detail-value">{{ number_format($data['child_price'], 2) }} {{ $data['currency_code'] ?? 'USD' }}</span>
                </div>
                @endif
                @if(isset($data['total_price']))
                <div class="detail-row">
                    <span class="detail-label">Total Price:</span>
                    <span class="detail-value"><strong>{{ number_format($data['total_price'], 2) }} {{ $data['currency_code'] ?? 'USD' }}</strong></span>
                </div>
                @endif
                @if(isset($data['remaining_amount']))
                <div class="detail-row">
                    <span class="detail-label">Remaining Amount:</span>
                    <span class="detail-value">{{ number_format($data['remaining_amount'], 2) }} {{ $data['currency_code'] ?? 'USD' }}</span>
                </div>
                @endif
                @if(isset($data['tour_deposit']))
                <div class="detail-row">
                    <span class="detail-label">Deposit Required:</span>
                    <span class="detail-value">{{ number_format($data['tour_deposit'], 2) }} {{ $data['currency_code'] ?? 'USD' }}</span>
                </div>
                @endif
            </div>
            
            <!-- Tour Information Section -->
            @if(isset($data['tour_overview']) || isset($data['tour_highlights']))
            <div class="contact-details">
                <h3>📖 Tour Information</h3>
                @if(isset($data['tour_overview']))
                <div class="detail-row">
                    <span class="detail-label">Overview:</span>
                    <span class="detail-value">{{ Str::limit($data['tour_overview'], 200) }}</span>
                </div>
                @endif
                @if(isset($data['tour_highlights']))
                <div class="detail-row">
                    <span class="detail-label">Highlights:</span>
                    <span class="detail-value">{{ Str::limit($data['tour_highlights'], 200) }}</span>
                </div>
                @endif
                @if(isset($data['tour_included']))
                <div class="detail-row">
                    <span class="detail-label">Included:</span>
                    <span class="detail-value">{{ Str::limit($data['tour_included'], 200) }}</span>
                </div>
                @endif
                @if(isset($data['tour_excluded']))
                <div class="detail-row">
                    <span class="detail-label">Excluded:</span>
                    <span class="detail-value">{{ Str::limit($data['tour_excluded'], 200) }}</span>
                </div>
                @endif
            </div>
            @endif
            
            <p><strong>Action Required:</strong> Please contact this customer within 24 hours to discuss their booking requirements and provide a personalized quote.</p>
            
            <div class="timestamp">
                Received on: {{ date('F j, Y \a\t g:i A') }}
            </div>
        </div>
        <div class="footer">
            <p>This email was automatically generated from your website booking contact form.</p>
            <p>&copy; {{ date('Y') }} Visa Egypt Travel. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
