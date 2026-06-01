<?php

namespace App\Providers;

use App\Enums\SettingKey;
use App\Models\Category;
use App\Models\Destination;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        View::share('defaultLocale', config('app.locale'));

        File::macro('isEmptyDir', function ($path) {
            return count(glob("$path/*")) === 0;
        });

        Str::macro('htmlEntityDecode', fn($value) => Str::of(html_entity_decode($value)));
        Stringable::macro('htmlEntityDecode', function () {
            /** @var Stringable $this */
            return new Stringable(html_entity_decode((string) $this));
        });

        try {
            $destinations = Destination::all();
            $categories = Category::whereHas('translation', function ($query) {
                $query->whereIn('slug', ['shore-excursions', 'overlay-tours']);
            })->get();
            $nile_cruise_children = Category::whereHas('parent', function ($query) {
                $query->whereTranslation('slug', 'nile-cruise');
            })->get();
        } catch (\Throwable $e) {
            $destinations = collect();
            $categories = collect();
            $nile_cruise_children = collect();
        }

        View::share('destinations', $destinations);
        View::share('nav_categories', $categories);
        View::share('nile_cruise_children', $nile_cruise_children);
        try {
            View::share('social_links', collect(setting(SettingKey::SOCIAL_LINKS->value) ?? []));
        } catch (\Exception $e) {
            View::share('social_links', collect([]));
        }
    }
}
