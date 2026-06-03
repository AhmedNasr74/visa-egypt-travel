<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TailorMadeMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $formData;
    public array $settings;
    public bool $isAdminNotification;

    public function __construct(array $formData, bool $isAdminNotification = false)
    {
        $this->formData = $formData;
        $this->isAdminNotification = $isAdminNotification;
        
        // Get settings using the helper function approach
        $this->settings = [
            'site_title' => setting(\App\Enums\SettingKey::SITE_TITLE->value, true),
            'logo' => setting(\App\Enums\SettingKey::LOGO->value, true),
            'footer_text' => setting(\App\Enums\SettingKey::FOOTER_TEXT->value, true),
        ];
    }

    public function build(): self
    {
        $subject = $this->isAdminNotification 
            ? 'New Tailor Made Tour Request' 
            : 'Your Tailor Made Tour Request Received';

        return $this->view('emails.tailor_made')
            ->subject($subject)
            ->with([
                'formData' => $this->formData,
                'settings' => $this->settings,
                'isAdminNotification' => $this->isAdminNotification,
            ]);
    }
} 