<?php

namespace App\Helpers;

use App\Enums\SettingKey;

class EmailHelper
{
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

    public static function getBrandName(): string
    {
        return (string) config('mailing.brand_name', config('app.name', 'Your Site'));
    }

    public static function getPrimaryInbox(): string
    {
        return (string) config('mailing.primary_inbox', self::getAdminEmail());
    }

    public static function isBookingInquiry(string $type): bool
    {
        $bookingTypes = ['booking', 'tour', 'package', 'reservation', 'custom tour', 'group booking', 'contact_form'];

        return in_array(strtolower(trim($type)), $bookingTypes, true);
    }

    /**
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

        $primary = trim(self::getPrimaryInbox());
        if ($primary !== '' && filter_var($primary, FILTER_VALIDATE_EMAIL) && !in_array($primary, $emails, true)) {
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
            if (is_array($fromResolver) && $fromResolver !== []) {
                return self::normalizeEmails($fromResolver);
            }
        }

        $emails = self::normalizeEmails(config('mailing.notification_emails', []));

        if ($emails !== []) {
            return $emails;
        }

        if (function_exists('setting')) {
            try {
                $fromSettings = array_merge(
                    self::normalizeEmails(setting(SettingKey::CONTACT_EMAIL->value) ?? []),
                    self::normalizeEmails(setting(SettingKey::NOTIFICATION_EMAILS->value) ?? [])
                );
                if ($fromSettings !== []) {
                    return $fromSettings;
                }
            } catch (\Throwable) {
                // use env/config only
            }
        }

        return [];
    }

    /**
     * @param mixed $raw
     * @return list<string>
     */
    private static function normalizeEmails(mixed $raw): array
    {
        if (!is_array($raw)) {
            return [];
        }

        $emails = [];
        foreach ($raw as $address) {
            $address = is_string($address) ? trim($address) : '';
            if ($address !== '' && filter_var($address, FILTER_VALIDATE_EMAIL)) {
                $emails[] = $address;
            }
        }

        return array_values(array_unique($emails));
    }
}
