<?php

namespace App\Traits\Models;

use App\Models\Seo;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasSeo
{
    public function seo(): MorphOne
    {
        return $this->morphOne(Seo::class, 'seo');
    }

    public function publish(): void
    {
        SEOMeta::setTitle($this->seo?->meta_title);
        SEOMeta::setDescription($this->seo?->meta_description);
        SEOMeta::setKeywords($this->seo?->meta_keywords);
        SEOMeta::setCanonical(route('site.home'));
        SEOMeta::setCanonical(route('site.home'));

        OpenGraph::setDescription($this->seo?->og_description);
        OpenGraph::setTitle($this->seo?->og_title);
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', class_basename($this));
        OpenGraph::addImage($this->seo?->og_image ?? $this->featured_image);

        TwitterCard::setTitle($this->seo?->meta_title);
        TwitterCard::setSite(config('app.name'));

        JsonLd::setTitle($this->seo?->meta_title);
        JsonLd::setDescription($this->seo?->meta_description);
        JsonLd::addImage($this->seo?->og_image);
    }
}
