# Install checklist (5 minutes)

Copy this folder into your new Laravel project root, then:

- [ ] **1.** Copy `app/Helpers/EmailHelper.php` → `app/Helpers/`
- [ ] **2.** Copy `app/Services/DualEmailSender.php` → `app/Services/`
- [ ] **3.** Copy `app/Mail/*` → `app/Mail/`
- [ ] **4.** Copy `resources/views/emails/*` → `resources/views/emails/`
- [ ] **5.** Copy `config/mailing.php` → `config/`
- [ ] **6.** Merge `env.example` into `.env`
- [ ] **7.** Run `composer dump-autoload`
- [ ] **8.** Run `php artisan config:clear`
- [ ] **9.** Copy/adapt `examples/controllers/ContactController.php`
- [ ] **10.** Add routes from `examples/routes/web-snippet.php`
- [ ] **11.** Test with `php artisan tinker` (see README)
- [ ] **12.** Submit a real form; check `storage/logs/laravel.log`

Full details: [README.md](./README.md)
