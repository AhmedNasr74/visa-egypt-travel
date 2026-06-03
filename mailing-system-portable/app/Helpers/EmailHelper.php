<?php

namespace App\Helpers;

class EmailHelper
{
    public const BOOKING_NOTIFICATION_EMAIL = 'info@egyptinstyletours.com';

    public static function getAdminEmail(): string
    {
        return (string) config('mailing.admin_email', env('ADMIN_EMAIL', 'admin@example.com'));
    }

    public static function getAdminName(): string
    {
        return (string) config('mailing.admin_name', env('ADMIN_NAME', 'Site Admin'));
    }

    public static function getFromEmail(): string
    {
        return env('MAIL_FROM_ADDRESS', self::getAdminEmail());
    }

    public static function getFromName(): string
    {
        return env('MAIL_FROM_NAME', (string) config('mailing.brand_name', 'Your Site'));
    }

    public static function getPrimaryInbox(): string
    {
        return (string) config('mailing.primary_inbox', self::getAdminEmail());
    }

    public static function isBookingInquiry(string $type): bool
    {
        $bookingTypes = ['booking', 'tour', 'package', 'reservation', 'custom tour', 'group booking'];

        return in_array(strtolower($type), $bookingTypes, true);
    }

    /**
     * Admin recipients: config list + primary inbox, validated and deduplicated.
     *
     * @return list<string>
     */
    public static function getNotificationRecipientEmails(): array
    {
        $emails = self::resolveNotificationEmails();

        $emails = array_values(array_unique(array_filter($emails, function ($email) {
            return is_string($email) && filter_var(trim($email), FILTER_VALIDATE_EMAIL);
        })));

        if ($emails === []) {
            $emails = [self::getAdminEmail()];
        }

        $primary = self::getPrimaryInbox();
        if (!in_array($primary, $emails, true)) {
            $emails[] = $primary;
        }

        return $emails;
    }

    /**
     * @return list<string>
     */
    private static function resolveNotificationEmails(): array
    {
        $resolver = config('mailing.notification_emails_resolver');
        if (is_callable($resolver)) {
            $fromResolver = $resolver();
            if (is_array($fromResolver)) {
                return $fromResolver;
            }
        }

        $fromConfig = config('mailing.notification_emails', []);
        if (is_array($fromConfig) && $fromConfig !== []) {
            return $fromConfig;
        }

        // Egypt In Style: optional settings table helper (if present in target project)
        if (function_exists('setting')) {
            try {
                $fromSettings = setting('notification_emails');
                if (is_array($fromSettings)) {
                    return $fromSettings;
                }
            } catch (\Throwable) {
                // ignore — use env/config only
            }
        }

        return [];
    }
}
