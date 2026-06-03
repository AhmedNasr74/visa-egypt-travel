<!DOCTYPE html>
<html>
<head>
    <title>New Customize Your Trip Request</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2 style="color: #2c5530;">New Customize Your Trip Request</h2>
    <p>You have received a new customize your trip request.</p>

    <table cellpadding="8" cellspacing="0" border="0" style="width: 100%; max-width: 600px;">
        <tr><td><strong>Request ID</strong></td><td>#{{ $data['request_id'] }}</td></tr>
        <tr><td><strong>Name</strong></td><td>{{ $data['name'] }}</td></tr>
        <tr><td><strong>Email</strong></td><td>{{ $data['email'] }}</td></tr>
        <tr><td><strong>Phone</strong></td><td>{{ $data['phone'] }}</td></tr>
        <tr><td><strong>Nationality</strong></td><td>{{ $data['nationality'] }}</td></tr>
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
</body>
</html>
