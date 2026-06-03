<!DOCTYPE html>
<html>
<head>
    <title>Thank You - Visa Egypt Travel</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2 style="color: #2c5530;">Thank you, {{ $data['name'] }}!</h2>
    <p>We have received your message and will get back to you as soon as possible.</p>

    <table cellpadding="8" cellspacing="0" border="0" style="width: 100%; max-width: 600px;">
        <tr><td><strong>Subject</strong></td><td>{{ $data['subject'] }}</td></tr>
        <tr><td><strong>Inquiry type</strong></td><td>{{ $data['type'] }}</td></tr>
        <tr><td><strong>Phone</strong></td><td>{{ $data['phone'] }}</td></tr>
        <tr><td><strong>Message</strong></td><td>{{ $data['message'] }}</td></tr>
    </table>

    <p style="margin-top: 24px;">If you need immediate assistance, contact us at {{ \App\Helpers\EmailHelper::BOOKING_NOTIFICATION_EMAIL }}.</p>
    <p>Best regards,<br>Visa Egypt Travel</p>
</body>
</html>
