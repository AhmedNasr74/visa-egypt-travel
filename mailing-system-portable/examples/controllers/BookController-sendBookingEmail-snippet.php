<?php

/**
 * Tour booking admin email (synchronous).
 * Paste into your BookController after a booking is saved.
 */
use App\Helpers\EmailHelper;
use App\Mail\BookingNotificationMail;
use App\Services\DualEmailSender;
use Illuminate\Support\Facades\Mail;

private function sendBookingEmail(Booking $booking): void
{
    $tour = $booking->tour;
    $bookingData = [
        'name' => $booking->name ?? 'Not provided',
        'email' => $booking->email ?? 'Not provided',
        'phone' => $booking->phone ?? 'Not provided',
        'nationality' => $booking->nationality ?? 'Not specified',
        'tour_name' => $tour ? $tour->title : 'Not specified',
        'tour_id' => $booking->tour_id ?? 'Not specified',
        'date' => $booking->date
            ? (is_string($booking->date) ? $booking->date : $booking->date->format('Y-m-d'))
            : 'Not specified',
        'adults_count' => $booking->adults_count ?? 0,
        'children_count' => $booking->children_count ?? 0,
        'total_price' => $booking->total_price ?? 0,
        'remaining_amount' => $booking->remaining_amount ?? 0,
        'payment_status' => $booking->payment_status ?? 'Pending',
        'payment_method' => $booking->payment_status === 'Pending' ? 'Cash' : 'PayPal',
        'currency_code' => $booking->currency_code ?? 'USD',
        'notes' => $booking->notes ?? 'No notes',
        'booking_id' => $booking->id,
        'order_id' => $booking->order_id ?? 'Not assigned',
        'booking_created_at' => $booking->created_at
            ? $booking->created_at->format('Y-m-d H:i:s')
            : 'Not available',
    ];

    // Admin copy (all notification recipients)
    DualEmailSender::sendAdmin(
        new BookingNotificationMail($bookingData, 'booking'),
        'booking',
        ['booking_id' => $booking->id]
    );

    // Optional: guest receipt — use NewBookingEmailMail if you have it
    // DualEmailSender::sendGuest($booking->email, new NewBookingEmailMail($booking), 'booking', ['booking_id' => $booking->id]);
}
