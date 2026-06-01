<?php

namespace Database\Seeders;

use App\Enums\SettingKey;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $this->addSocialLinks();
        $this->addBookingNotifiableEmails();
    }

    private function addSocialLinks(): void
    {
        $platforms = [
            ['type' => 'facebook', 'url' => '#'],
            ['type' => 'twitter', 'url' => '#'],
            ['type' => 'google-plus', 'url' => '#'],
            ['type' => 'instagram', 'url' => '#'],
            ['type' => 'pinterest', 'url' => '#'],
            ['type' => 'youtube', 'url' => '#'],
            ['type' => 'tripadvisor', 'url' => '#'],
        ];

        Setting::firstOrCreate([
            'option_key' => SettingKey::SOCIAL_LINKS->value
        ], [
            'option_key' => SettingKey::SOCIAL_LINKS->value,
            'option_value' => $platforms
        ]);
    }

    private function addBookingNotifiableEmails(): void
    {
        Setting::firstOrCreate(['option_key' => SettingKey::NOTIFICATION_EMAILS->value], [
            'option_key' => SettingKey::NOTIFICATION_EMAILS->value,
            'option_value' => ['ahmednasr2589@gmail.com']
        ]);
    }
}
