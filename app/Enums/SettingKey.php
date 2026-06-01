<?php

namespace App\Enums;

enum SettingKey: string
{
    case SOCIAL_LINKS = 'social_links';
    case WHATSAPP_PHONE_NUMBER = 'whatsapp_phone_number';
    case NOTIFICATION_EMAILS = 'notification_emails';
    case SITE_TITLE = 'site_title';
    case FAVICON = 'favicon';
    case LOGO = 'logo';
    case FOOTER_LOGO = 'footer_logo';
    case FOOTER_TEXT = 'footer_text';
    case CONTACT_EMAIL = 'contact_email';
    case ADDRESS = 'address';
    case PRIMARY_PHONE = 'primary_phone';
    case CUSTOM_CSS = 'custom_css';
    case BANNER_IMAGE = 'banner_image';
    case BANNER_TITLE = 'banner_title';
    case BANNER_DESCRIPTION = 'banner_description';
    case BANNER_TARGET_URL = 'banner_target_url';
    case BANNER_ENABLED = 'banner_enabled';
    case MAIN_HOME_SLIDER = 'main-home-slider';
    case HOME_FIRST_SECTION_TOURS = 'home_first_section_tours';
    case HOME_SECOND_SECTION_TOURS = 'home_second_section_tours';
    case ABOUT_US = 'about_us';
    case TERMS_AND_CONDITIONS = 'terms_and_conditions';
    case PRIVACY = 'privacy';
    case SEARCH_IMG = 'search_img';
    case GALLERY = 'gallery';
    case BANNER_GALLERY = 'banner_gallery';
    case OUR_GROUP = 'our_group';

    public static function all(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

}
