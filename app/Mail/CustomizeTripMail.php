<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomizeTripMail extends Mailable
{
    use Queueable, SerializesModels;

    public $formData;
    public $isAdminNotification;
    public $tripId;

    /**
     * Create a new message instance.
     */
    public function __construct($formData, $isAdminNotification = false, $tripId = null)
    {
        $this->formData = $formData;
        $this->isAdminNotification = $isAdminNotification;
        $this->tripId = $tripId;
        
        \Log::info('CustomizeTripMail instance created', [
            'is_admin_notification' => $isAdminNotification,
            'trip_id' => $tripId,
            'form_data_keys' => array_keys($formData),
            'recipient_type' => $isAdminNotification ? 'admin' : 'client'
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->isAdminNotification 
            ? 'New Customized Trip Request Received' 
            : 'Your Customized Trip Request Confirmation';

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.customize_trip',
            with: [
                'formData' => $this->formData,
                'isAdminNotification' => $this->isAdminNotification,
                'tripId' => $this->tripId,
                'settings' => $this->getSettings(),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Get site settings
     */
    private function getSettings()
    {
        try {
            $siteTitleSetting = setting('site_title');
            $logoSetting = setting('logo');
            $footerTextSetting = setting('footer_text');
            $primaryPhoneSetting = setting('primary_phone');
            $whatsappPhoneSetting = setting('whatsapp_phone_number');
            
            $settings = [
                'site_title' => is_array($siteTitleSetting) ? $siteTitleSetting[0] : ($siteTitleSetting ?: 'Croconile Egypt'),
                'logo' => is_array($logoSetting) ? $logoSetting[0] : ($logoSetting ?: ''),
                'footer_text' => is_array($footerTextSetting) ? $footerTextSetting[0] : ($footerTextSetting ?: ''),
                'primary_phone' => is_array($primaryPhoneSetting) ? $primaryPhoneSetting[0] : ($primaryPhoneSetting ?: ''),
                'whatsapp_phone_number' => is_array($whatsappPhoneSetting) ? $whatsappPhoneSetting[0] : ($whatsappPhoneSetting ?: ''),
            ];
            
            \Log::info('Site settings retrieved for email', [
                'settings_retrieved' => count($settings),
                'site_title' => $settings['site_title'],
                'has_logo' => !empty($settings['logo']),
                'has_phone' => !empty($settings['primary_phone']),
                'has_whatsapp' => !empty($settings['whatsapp_phone_number'])
            ]);
            
            return $settings;
        } catch (\Exception $e) {
            \Log::error('Failed to retrieve site settings for email', [
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine()
            ]);
            
            // Return default settings
            return [
                'site_title' => 'Croconile Egypt',
                'logo' => '',
                'footer_text' => '',
                'primary_phone' => '',
                'whatsapp_phone_number' => '',
            ];
        }
    }
} 