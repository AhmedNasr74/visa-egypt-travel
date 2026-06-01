@component('mail::message')
# Hello {{ $booking->name   }}

<x-mail::panel>
    You have a new booking request.
</x-mail::panel>

<table border="0" cellpadding="0" cellspacing="0" align="left" style="width: 100%;margin-bottom: 50px;">
    <tbody>
    <tr align="left" >
        <td style="border-bottom: 1px solid #0003; padding: 8px">Tour</td>
        <td style="border-bottom: 1px solid #0003; padding: 8px;">{{ $booking->tour?->name }}</td>
    </tr>
    <tr align="left" >
        <td style="border-bottom: 1px solid #0003; padding: 8px">Adults</td>
        <td style="border-bottom: 1px solid #0003; padding: 8px;">({{ $booking->adults_count }}) x {{ number_format($booking->adult_price).'$' }}</td>
    </tr>
    <tr align="left" >
        <td style="border-bottom: 1px solid #0003; padding: 8px">Children</td>
        <td style="border-bottom: 1px solid #0003; padding: 8px;">({{ $booking->children_count }}) x {{ number_format($booking->child_price).'$' }}</td>
    </tr>
    <tr align="left" >
        <td style="border-bottom: 1px solid #0003; padding: 8px">Total Price</td>
        <td style="border-bottom: 1px solid #0003; padding: 8px;">{{ number_format($booking->total_price) . '$' }}</td>
    </tr>
    <tr align="left" >
        <td style="border-bottom: 1px solid #0003; padding: 8px">Nationality</td>
        <td style="border-bottom: 1px solid #0003; padding: 8px;">{{ $booking->nationality }}</td>
    </tr>
    <tr align="left" >
        <td style="border-bottom: 1px solid #0003; padding: 8px">Phone</td>
        <td style="border-bottom: 1px solid #0003; padding: 8px;">{{ $booking->phone }}</td>
    </tr>
    <tr align="left" >
        <td style="border-bottom: 1px solid #0003; padding: 8px">Email</td>
        <td style="border-bottom: 1px solid #0003; padding: 8px;">{{ $booking->email }}</td>
    </tr>
    <tr align="left" >
        <td style="border-bottom: 1px solid #0003; padding: 8px">Additional Notes</td>
        <td style="border-bottom: 1px solid #0003; padding: 8px;">{{ $booking->message ?? '-' }}</td>
    </tr>
    </tbody>
</table>

Thanks for using our application,<br>
{{ setting(\App\Enums\SettingKey::SITE_TITLE->value, true) }}
@endcomponent
