# File manifest

Copy files from this folder into a Laravel 9+ / 10+ / 11+ project.

## Core (required)

| Source | Target in new project |
|--------|------------------------|
| `app/Helpers/EmailHelper.php` | `app/Helpers/EmailHelper.php` |
| `app/Services/DualEmailSender.php` | `app/Services/DualEmailSender.php` |
| `config/mailing.php` | `config/mailing.php` |

Register config in `config/app.php` or rely on auto-discovery — in Laravel 11+ add to `bootstrap/app.php` or publish manually:

```php
// If needed, merge in AppServiceProvider:
$this->mergeConfigFrom(base_path('config/mailing.php'), 'mailing');
```

Or copy `config/mailing.php` and Laravel will load it automatically when you `config('mailing.x')`.

## Mailables

| File | Purpose |
|------|---------|
| `app/Mail/ContactFormMail.php` | Admin email for contact / booking inquiries |
| `app/Mail/ContactFormGuestMail.php` | Guest confirmation for contact form |
| `app/Mail/CustomizedTripAdminMail.php` | Admin email for customize-trip form |
| `app/Mail/CustomizedTripGuestMail.php` | Guest confirmation for customize-trip |
| `app/Mail/BookingNotificationMail.php` | Admin email for tour bookings |

## Blade templates

| File | Used by |
|------|---------|
| `resources/views/emails/contact_form_admin.blade.php` | ContactFormMail, BookingNotificationMail (booking type) |
| `resources/views/emails/contact_form_guest.blade.php` | ContactFormGuestMail |
| `resources/views/emails/customized_trip_admin.blade.php` | CustomizedTripAdminMail |
| `resources/views/emails/customized_trip_guest.blade.php` | CustomizedTripGuestMail |
| `resources/views/emails/book_tour_email.blade.php` | NewBookingEmailMail (optional guest receipt) |
| `resources/views/emails/tailor_email.blade.php` | Legacy tailor form (optional) |

## Reference implementations (examples — adapt, do not copy blindly)

| File | Description |
|------|-------------|
| `examples/controllers/ContactController.php` | Contact + homepage form, admin + guest |
| `examples/controllers/CustomizeTripController.php` | Customize trip, admin + guest |
| `examples/controllers/BookController-sendBookingEmail-snippet.php` | Tour booking admin email |
| `examples/views/home-contact-form.blade.php` | Homepage “Keep In Touch” form + AJAX |
| `examples/routes/web-snippet.php` | Route definitions |

## Environment

| File | Action |
|------|--------|
| `env.example` | Merge variables into target `.env` |

## Documentation

| File | Description |
|------|-------------|
| `README.md` | Installation, architecture, testing |
| `MANIFEST.md` | This file |
