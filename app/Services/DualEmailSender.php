<?php

namespace App\Services;

use App\Helpers\EmailHelper;
use Exception;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DualEmailSender
{
    public static function sendAdmin(Mailable $mailable, string $logKey, array $context = []): void
    {
        try {
            $recipients = EmailHelper::getNotificationRecipientEmails();
            if ($recipients === []) {
                Log::warning("{$logKey} admin email skipped: no recipients configured", $context);

                return;
            }

            Mail::to($recipients)->send($mailable);

            Log::info("{$logKey} admin email sent", array_merge($context, [
                'recipients' => $recipients,
            ]));
        } catch (Exception $exception) {
            Log::error("{$logKey} admin email failed: " . $exception->getMessage(), array_merge($context, [
                'trace' => $exception->getTraceAsString(),
            ]));
        }
    }

    public static function sendGuest(?string $email, Mailable $mailable, string $logKey, array $context = []): void
    {
        $guestEmail = trim((string) $email);

        if ($guestEmail === '' || !filter_var($guestEmail, FILTER_VALIDATE_EMAIL)) {
            Log::warning("{$logKey} guest email skipped: invalid address", $context);

            return;
        }

        try {
            Mail::to($guestEmail)->send($mailable);

            Log::info("{$logKey} guest email sent", array_merge($context, [
                'guest_email' => $guestEmail,
            ]));
        } catch (Exception $exception) {
            Log::error("{$logKey} guest email failed: " . $exception->getMessage(), array_merge($context, [
                'guest_email' => $guestEmail,
                'trace' => $exception->getTraceAsString(),
            ]));
        }
    }
}
