<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Tour;
use Illuminate\Http\Response;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [];
        $now = now()->toAtomString();
        $locales = array_keys(LaravelLocalization::getSupportedLocales());

        foreach ($locales as $locale) {
            foreach ($this->staticPaths() as $path) {
                $urls[] = $this->entry(LaravelLocalization::getLocalizedURL($locale, $path), $now, 'weekly', '0.8');
            }
        }

        Tour::query()
            ->where('enabled', true)
            ->with(['translations' => fn ($q) => $q->select('tour_id', 'locale', 'slug')])
            ->get()
            ->each(function (Tour $tour) use (&$urls, $now, $locales) {
                foreach ($locales as $locale) {
                    $translation = $tour->translate($locale);
                    $slug = $translation?->slug ?? $tour->slug;
                    if (!$slug) {
                        continue;
                    }
                    $urls[] = $this->entry(
                        LaravelLocalization::getLocalizedURL($locale, 'tour-details/' . $slug),
                        $tour->updated_at?->toAtomString() ?? $now,
                        'weekly',
                        '0.9'
                    );
                }
            });

        Blog::query()
            ->where('enabled', true)
            ->orderByDesc('updated_at')
            ->get(['id', 'updated_at'])
            ->each(function (Blog $blog) use (&$urls, $now, $locales) {
                foreach ($locales as $locale) {
                    $urls[] = $this->entry(
                        LaravelLocalization::getLocalizedURL($locale, 'blog-details/' . $blog->id),
                        $blog->updated_at?->toAtomString() ?? $now,
                        'weekly',
                        '0.7'
                    );
                }
            });

        $xml = view('site.sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    /**
     * @return list<string>
     */
    private function staticPaths(): array
    {
        return [
            '',
            'about',
            'contact',
            'blog',
            'Customize-your-trip',
            'tour-tailors',
            'limo',
            'nile-cruise',
            'day-tours',
            'travel-packages',
            'transportation',
            'faq',
            'terms&conditions',
            'privacy',
        ];
    }

    /**
     * @return array{loc: string, lastmod: string, changefreq: string, priority: string}
     */
    private function entry(string $loc, string $lastmod, string $changefreq, string $priority): array
    {
        return compact('loc', 'lastmod', 'changefreq', 'priority');
    }
}
