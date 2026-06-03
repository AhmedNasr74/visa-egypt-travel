<!DOCTYPE html>
<html>
<head>
    <title>Your Customize Trip Request</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2 style="color: #2c5530;">Thank you, {{ $data['name'] }}!</h2>
    <p>We have received your customize your trip request. Our team will review your details and contact you shortly.</p>
    <p><strong>Your reference number:</strong> #{{ $data['request_id'] }}</p>

    <h3 style="color: #2c5530;">Your request summary</h3>
    <table cellpadding="8" cellspacing="0" border="0" style="width: 100%; max-width: 600px;">
        <tr><td><strong>Destinations</strong></td><td>{{ $data['destinations'] }}</td></tr>
        <tr><td><strong>Date type</strong></td><td>{{ $data['date_type'] }}</td></tr>
        @if(($data['date_type'] ?? '') === 'Exact Dates')
            <tr><td><strong>Date from</strong></td><td>{{ $data['date_from'] }}</td></tr>
            <tr><td><strong>Date to</strong></td><td>{{ $data['date_to'] }}</td></tr>
        @else
            <tr><td><strong>Month</strong></td><td>{{ $data['month'] }}</td></tr>
            <tr><td><strong>Duration</strong></td><td>{{ $data['days'] }}</td></tr>
        @endif
        <tr><td><strong>Adults</strong></td><td>{{ $data['adults'] }}</td></tr>
        <tr><td><strong>Children</strong></td><td>{{ $data['children'] }}</td></tr>
        <tr><td><strong>Infants</strong></td><td>{{ $data['infants'] }}</td></tr>
        <tr><td><strong>Notes</strong></td><td>{{ $data['notes'] }}</td></tr>
    </table>

    <p style="margin-top: 24px;">If you have any questions, reply to this email or contact us at {{ \App\Helpers\EmailHelper::BOOKING_NOTIFICATION_EMAIL }}.</p>
    <p>Best regards,<br>Visa Egypt Travel</p>
</body>
</html>
