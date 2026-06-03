<?php

namespace App\Mail;

use App\Enums\SettingKey;
use App\Models\CarRental;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LimoBookingGuestMail extends Mailable
{
    use Queueable, SerializesModels;

    public CarRental $rental;

    public function __construct(CarRental $rental)
    {
        $this->rental = $rental;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your transfer booking confirmation #' . $this->rental->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.limo_booking_guest',
            with: [
                'rental' => $this->rental,
                'settings' => $this->siteSettings(),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }

    /**
     * @return array{site_title: string, logo: string, footer_text: string, primary_phone: string}
     */
    private function siteSettings(): array
    {
        $siteTitle = setting(SettingKey::SITE_TITLE->value, true);
        $logo = setting(SettingKey::LOGO->value, true);
        $footerText = setting(SettingKey::FOOTER_TEXT->value, true);
        $primaryPhone = setting(SettingKey::PRIMARY_PHONE->value, true);

        return [
            'site_title' => is_string($siteTitle) && $siteTitle !== '' ? $siteTitle : 'Visa Egypt Travel',
            'logo' => is_string($logo) ? $logo : '',
            'footer_text' => is_string($footerText) ? $footerText : '',
            'primary_phone' => is_string($primaryPhone) ? $primaryPhone : '',
        ];
    }
}
