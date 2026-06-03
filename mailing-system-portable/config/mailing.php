<?php

/**
 * Portable mailing configuration.
 * Copy to: config/mailing.php in your Laravel project.
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Brand / site name (used in email subjects and footers)
    |--------------------------------------------------------------------------
    */
    'brand_name' => env('MAIL_BRAND_NAME', 'Your Site Name'),

    /*
    |--------------------------------------------------------------------------
    | Primary inbox (always receives admin copies)
    |--------------------------------------------------------------------------
    */
    'primary_inbox' => env('MAIL_PRIMARY_INBOX', env('ADMIN_EMAIL', 'info@example.com')),

    /*
    |--------------------------------------------------------------------------
    | Fallback admin email when notification list is empty
    |--------------------------------------------------------------------------
    */
    'admin_email' => env('ADMIN_EMAIL', 'admin@example.com'),

    'admin_name' => env('ADMIN_NAME', 'Site Admin'),

    /*
    |--------------------------------------------------------------------------
    | Extra admin recipients (comma-separated in .env)
    | Example: MAIL_NOTIFICATION_EMAILS="sales@x.com,reservations@x.com"
    |--------------------------------------------------------------------------
    */
    'notification_emails' => array_values(array_filter(array_map(
        'trim',
        explode(',', (string) env('MAIL_NOTIFICATION_EMAILS', ''))
    ))),

    /*
    |--------------------------------------------------------------------------
    | Optional: hook into your settings table (see README)
    | Set to a callable: fn (): array => setting('notification_emails')
    |--------------------------------------------------------------------------
    */
    'notification_emails_resolver' => null,
];
