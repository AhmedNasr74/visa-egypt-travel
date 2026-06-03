# Dual-recipient mailing system (portable)

Laravel mailing package extracted from **Egypt In Style Tours**. Sends **admin notification** and **guest confirmation** for:

- Homepage / contact forms
- Customize-your-trip requests
- Tour bookings (admin copy)

Designed for **synchronous** delivery (`Mail::send`) so emails work without a queue worker.

---

## Architecture

```
Form submit → Controller validates → Save to DB (optional)
                    ↓
         DualEmailSender / controller methods
                    ↓
    ┌───────────────┴───────────────┐
    ▼                               ▼
 Admin recipients              Guest email
 (notification list +          (address from form)
  primary inbox)
```

### Design rules

1. **Never queue** critical form emails unless `php artisan queue:work` runs 24/7.
2. **Do not** use `Notification::route()` with empty/invalid dashboard emails — validate recipients first.
3. **Admin and guest sends are separate** — one failure must not block the other.
4. **Log every send** to `storage/logs/laravel.log` for debugging.
5. **Do not fail the HTTP response** if mail fails; log and show success to the user (optional policy).

---

## Quick install (new Laravel project)

### 1. Copy files

Copy the entire `mailing-system-portable` folder contents into your project:

```text
app/Helpers/EmailHelper.php
app/Services/DualEmailSender.php
app/Mail/*.php
config/mailing.php
resources/views/emails/*.blade.php
```

See [MANIFEST.md](./MANIFEST.md) for the full file list.

### 2. Environment variables

Merge from [env.example](./env.example):

```env
MAIL_MAILER=smtp
MAIL_HOST=mail.yourdomain.com
MAIL_PORT=465
MAIL_USERNAME=reservations@yourdomain.com
MAIL_PASSWORD=secret
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=reservations@yourdomain.com
MAIL_FROM_NAME="Your Brand"

ADMIN_EMAIL=admin@yourdomain.com
MAIL_PRIMARY_INBOX=info@yourdomain.com
MAIL_NOTIFICATION_EMAILS=reservations@yourdomain.com,sales@yourdomain.com
MAIL_BRAND_NAME="Your Brand"
```

### 3. Load config (Laravel 11+)

If `config/mailing.php` is not auto-loaded, register in `AppServiceProvider::register()`:

```php
$this->mergeConfigFrom(base_path('config/mailing.php'), 'mailing');
```

### 4. Autoload helpers (if needed)

If `EmailHelper` is not found, ensure PSR-4 autoload covers `app/Helpers` or add to `composer.json`:

```json
"autoload": {
    "psr-4": {
        "App\\": "app/"
    }
}
```

Then run `composer dump-autoload`.

### 5. Wire a controller

Use [examples/controllers/ContactController.php](./examples/controllers/ContactController.php) as a template, or the minimal pattern:

```php
use App\Helpers\EmailHelper;
use App\Mail\ContactFormGuestMail;
use App\Mail\ContactFormMail;
use App\Services\DualEmailSender;

$data = $validator->validated();

$isBooking = EmailHelper::isBookingInquiry($data['type']);
$mailType = $isBooking ? 'booking' : 'contact';

DualEmailSender::sendAdmin(
    new ContactFormMail($data, $mailType),
    'contact_form',
    ['type' => $data['type']]
);

DualEmailSender::sendGuest(
    $data['email'],
    new ContactFormGuestMail($data, $isBooking),
    'contact_form'
);
```

### 6. Frontend (AJAX form)

See [examples/views/home-contact-form.blade.php](./examples/views/home-contact-form.blade.php).

Requirements on the target site layout:

- jQuery
- axios
- toastr

Submit with header `Accept: application/json` so the controller returns JSON.

---

## Features included

| Feature | Admin email | Guest email | Reference |
|---------|-------------|-------------|-----------|
| Contact / homepage form | ✅ | ✅ | `ContactController` |
| Customize your trip | ✅ | ✅ | `CustomizeTripController` |
| Tour booking | ✅ | optional* | `BookController` snippet |

\* Guest tour receipt can use `NewBookingEmailMail` + `book_tour_email.blade.php` if you copy that mailable from the main project.

---

## Customization

### Brand name and inbox

Edit `config/mailing.php` or `.env`:

- `MAIL_BRAND_NAME` — subjects and footers
- `MAIL_PRIMARY_INBOX` — always receives admin copies
- `MAIL_NOTIFICATION_EMAILS` — comma-separated extra admins

### Egypt In Style settings table

If the target project has `setting('notification_emails')` (JSON array in DB), `EmailHelper` will use it automatically when the helper exists.

Or wire explicitly in `AppServiceProvider`:

```php
config([
    'mailing.notification_emails_resolver' => fn () => setting('notification_emails') ?? [],
]);
```

### Customize trip mailable

`CustomizedTripAdminMail` / `CustomizedTripGuestMail` expect:

- Model `App\Models\CustomizedTrip`
- Relationship `categories()` with translatable `title`

Adjust mailables if your schema differs.

### Contact form fields

Required request fields:

| Field | Type |
|-------|------|
| `name` | string |
| `email` | email |
| `phone` | string |
| `subject` | string |
| `message` | string |
| `type` | string (e.g. `Booking`, `General Inquiry`) |

`EmailHelper::isBookingInquiry()` treats these as booking: `booking`, `tour`, `package`, `reservation`, `custom tour`, `group booking`.

---

## Adding a new form type

1. Create `app/Mail/YourFormAdminMail.php` and `YourFormGuestMail.php` (no `ShouldQueue`).
2. Create `resources/views/emails/your_form_admin.blade.php` and `your_form_guest.blade.php`.
3. In the controller after validation:

```php
DualEmailSender::sendAdmin(new YourFormAdminMail($data), 'your_form', ['id' => $model->id]);
DualEmailSender::sendGuest($data['email'], new YourFormGuestMail($data), 'your_form', ['id' => $model->id]);
```

---

## Testing

### Artisan (if you have `email:test` command in main project)

```bash
php artisan email:test --type=booking
```

### Manual SMTP test

```bash
php artisan tinker
```

```php
use App\Helpers\EmailHelper;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

$data = [
    'name' => 'Test',
    'email' => 'guest@example.com',
    'phone' => '+1234567890',
    'subject' => 'Test',
    'message' => 'Hello',
    'type' => 'Booking',
];

Mail::to(EmailHelper::getNotificationRecipientEmails())
    ->send(new ContactFormMail($data, 'booking'));
```

### Logs

```bash
tail -f storage/logs/laravel.log
```

Look for:

- `contact_form admin email sent`
- `contact_form guest email sent`
- `Customize trip admin email sent`
- or `*_email failed` with stack trace

---

## Troubleshooting

| Symptom | Likely cause | Fix |
|---------|--------------|-----|
| Tour emails work, forms do not | Wrong recipient list / empty dashboard emails | Use `EmailHelper::getNotificationRecipientEmails()` |
| Nothing sends | SMTP misconfigured | Fix `.env` `MAIL_*`, test with tinker |
| Emails delayed or missing | Mailable implements `ShouldQueue` | Remove `ShouldQueue`; use sync `Mail::send()` |
| Guest never receives | Invalid email on form | Validate `email` field; check logs for `guest email skipped` |
| 419 on AJAX form | Missing CSRF | Include `@csrf` in form |
| JSON errors not shown | Missing `Accept: application/json` | Add header in axios (see example view) |

---

## Migration from Egypt In Style project

1. Zip or copy folder: `mailing-system-portable/`
2. Follow **Quick install** above.
3. Replace hardcoded `info@egyptinstyletours.com` in old `BookController` with `DualEmailSender` + `getNotificationRecipientEmails()`.
4. Update guest blade templates: replace `EmailHelper::BOOKING_NOTIFICATION_EMAIL` with `EmailHelper::getPrimaryInbox()` if you change brands.
5. Run `php artisan config:clear` after `.env` changes.

---

## Version / origin

- **Source project:** Egypt In Style Tours (Laravel)
- **Pattern:** Synchronous dual-recipient mail (admin + guest)
- **Last packaged:** 2026-06-03
