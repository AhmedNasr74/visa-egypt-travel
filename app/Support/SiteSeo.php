<?php

namespace App\Support;

use App\Enums\SettingKey;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SiteSeo
{
    public static function applyDefaults(): void
    {
        $siteName = self::siteName();
        $description = self::siteDescription();

        SEOMeta::setTitle($siteName);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical(url()->current());
        SEOMeta::setRobots('index,follow');

        OpenGraph::setTitle($siteName);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::setSiteName($siteName);
        self::addOgImage(self::defaultImage());

        TwitterCard::setTitle($siteName);
        TwitterCard::setDescription($description);
        TwitterCard::setType('summary_large_image');
        self::addTwitterImage(self::defaultImage());

        JsonLd::setTitle($siteName);
        JsonLd::setDescription($description);
        JsonLd::setType('WebSite');
        JsonLd::setUrl(url()->current());
        self::addJsonLdImage(self::defaultImage());
    }

    /**
     * Publish SEO for models using HasSeo (Tour, Blog, Category, etc.).
     */
    public static function fromSeoable(Model $model): void
    {
        $model->loadMissing('seo');

        $fallbackTitle = self::modelFallbackTitle($model);
        $fallbackDescription = self::modelFallbackDescription($model);
        $fallbackImage = self::modelFallbackImage($model);

        $metaTitle = self::value($model->seo?->meta_title) ?: $fallbackTitle;
        $metaDescription = self::value($model->seo?->meta_description) ?: $fallbackDescription;
        $metaKeywords = self::value($model->seo?->meta_keywords);
        $ogTitle = self::value($model->seo?->og_title) ?: $metaTitle;
        $ogDescription = self::value($model->seo?->og_description) ?: $metaDescription;
        $ogImage = self::absoluteUrl($model->seo?->og_image) ?: $fallbackImage;

        self::publish($metaTitle, $metaDescription, $ogTitle, $ogDescription, $ogImage, $metaKeywords, 'article');
    }

    public static function publishPage(
        string $title,
        ?string $description = null,
        ?string $image = null,
        ?string $keywords = null
    ): void {
        $siteName = self::siteName();
        $pageTitle = Str::contains($title, $siteName) ? $title : $title . ' | ' . $siteName;
        $pageDescription = $description ?: self::siteDescription();

        self::publish(
            $pageTitle,
            $pageDescription,
            $pageTitle,
            $pageDescription,
            self::absoluteUrl($image) ?: self::defaultImage(),
            $keywords,
            'website'
        );
    }

    private static function publish(
        string $metaTitle,
        string $metaDescription,
        string $ogTitle,
        string $ogDescription,
        ?string $ogImage,
        ?string $keywords,
        string $ogType
    ): void {
        SEOMeta::setTitle($metaTitle);
        SEOMeta::setDescription($metaDescription);
        SEOMeta::setCanonical(url()->current());
        SEOMeta::setRobots('index,follow');
        if ($keywords !== null && $keywords !== '') {
            SEOMeta::setKeywords($keywords);
        }

        OpenGraph::setTitle($ogTitle);
        OpenGraph::setDescription($ogDescription);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', $ogType);
        OpenGraph::setSiteName(self::siteName());
        self::addOgImage($ogImage);

        TwitterCard::setTitle($ogTitle);
        TwitterCard::setDescription($ogDescription);
        TwitterCard::setType('summary_large_image');
        self::addTwitterImage($ogImage);

        JsonLd::setTitle($metaTitle);
        JsonLd::setDescription($metaDescription);
        JsonLd::setType($ogType === 'article' ? 'Article' : 'WebPage');
        JsonLd::setUrl(url()->current());
        self::addJsonLdImage($ogImage);
    }

    private static function modelFallbackTitle(Model $model): string
    {
        foreach (['title', 'name', 'first_name'] as $key) {
            if (!empty($model->{$key})) {
                return (string) $model->{$key};
            }
        }

        return self::siteName();
    }

    private static function modelFallbackDescription(Model $model): string
    {
        foreach (['overview', 'description', 'content', 'excerpt', 'note'] as $key) {
            $text = $model->{$key} ?? null;
            if (is_string($text) && trim($text) !== '') {
                return self::excerpt($text);
            }
        }

        return self::siteDescription();
    }

    private static function modelFallbackImage(Model $model): ?string
    {
        foreach (['featured_image', 'banner', 'image', 'og_image'] as $key) {
            $image = $model->{$key} ?? null;
            if (is_string($image) && $image !== '') {
                return self::absoluteUrl($image);
            }
        }

        return self::defaultImage();
    }

    public static function siteName(): string
    {
        $title = setting(SettingKey::SITE_TITLE->value, true);

        return is_string($title) && $title !== '' ? $title : (string) config('app.name', 'Visa Egypt Travel');
    }

    public static function siteDescription(): string
    {
        $banner = setting(SettingKey::BANNER_DESCRIPTION->value, true);
        if (is_string($banner) && trim($banner) !== '') {
            return self::excerpt($banner, 320);
        }

        $footer = setting(SettingKey::FOOTER_TEXT->value, true);
        if (is_string($footer) && trim($footer) !== '') {
            return self::excerpt($footer, 320);
        }

        return 'Discover Egypt tours, Nile cruises, airport transfers, and tailor-made travel with ' . self::siteName() . '.';
    }

    public static function defaultImage(): ?string
    {
        return self::absoluteUrl(logo());
    }

    public static function absoluteUrl(?string $path): ?string
    {
        if ($path === null || trim($path) === '') {
            return null;
        }

        $path = trim($path);
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return url($path);
    }

    public static function excerpt(?string $html, int $limit = 160): string
    {
        $text = trim(strip_tags((string) $html));

        return Str::limit($text, $limit);
    }

    private static function value(mixed $value): ?string
    {
        if (!is_string($value)) {
            return null;
        }

        $value = trim($value);

        return $value !== '' ? $value : null;
    }

    private static function addOgImage(?string $image): void
    {
        if ($image !== null) {
            OpenGraph::addImage($image);
        }
    }

    private static function addTwitterImage(?string $image): void
    {
        if ($image !== null) {
            TwitterCard::setImage($image);
        }
    }

    private static function addJsonLdImage(?string $image): void
    {
        if ($image !== null) {
            JsonLd::addImage($image);
        }
    }
}
