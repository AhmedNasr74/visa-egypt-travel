<?php

return [
    'brand_name' => env('MAIL_BRAND_NAME', env('APP_NAME', 'Visa Egypt Travel')),

    'primary_inbox' => env('MAIL_PRIMARY_INBOX', env('ADMIN_EMAIL', env('MAIL_FROM_ADDRESS', 'admin@example.com'))),

    'admin_email' => env('ADMIN_EMAIL', env('MAIL_FROM_ADDRESS', 'admin@example.com')),

    'admin_name' => env('ADMIN_NAME', 'Site Admin'),

    'notification_emails' => array_values(array_filter(array_map(
        'trim',
        explode(',', (string) env('MAIL_NOTIFICATION_EMAILS', ''))
    ))),

    'notification_emails_resolver' => null,
];
