<?php


use App\Enums\SettingKey;
use App\Models\Currency;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;

if (!function_exists('admin')) {
    /**
     * returns authenticated admin user
     * @return User|Authenticatable|null
     */
    function admin(): User|Authenticatable|null
    {
        return auth('web')->user();
    }
}

if (!function_exists('logo')) {
    /**
     * returns site logo
     * @return string
     * @throws Throwable
     */
    function logo(): string
    {
        return setting(SettingKey::LOGO->value, true) ?? asset('assets/admin/images/logo/logo.png');
    }


}
if (!function_exists('email')) {
    /**
     * returns site logo
     * @return string
     * @throws Throwable
     */
    function email(): string
    {
        return setting(SettingKey::CONTACT_EMAIL->value, true) ?? "test@g.com";
    }


}
if (!function_exists('footer_logo')) {
     /**
     * returns site logo
     * @return string
     * @throws Throwable
     */

     function footer_logo(): string
    {
        return setting(SettingKey::FOOTER_LOGO->value, true) ?? asset('assets/admin/images/logo/logo.png');
    }

}
if (!function_exists('banner')) {
    /**
    * returns site logo
    * @return string
    * @throws Throwable
    */

    function banner(): string
   {
       return setting(SettingKey::BANNER_GALLERY->value, true) ?? asset('assets/site/img/banner.png');
   }

}
if (!function_exists('icon')) {
    /**
    * returns site logo
    * @return string
    * @throws Throwable
    */

    function icon(): string
   {
       return setting(SettingKey::FAVICON->value, true) ?? asset('assets/admin/images/logo/logo.png');
   }

}
if (!function_exists('footer_text')) {
    /**
    * returns site logo
    * @return string
    * @throws Throwable
    */

    function footer_text(): string
   {
       return setting(SettingKey::FOOTER_TEXT->value, true) ?? "";
   }

}


if (!function_exists('setting')) {
    /**
     * Get setting by key
     * @param string $key
     * @param bool $parse
     * @return mixed|null
     * @throws Throwable
     */
    function setting(string $key, bool $parse = false): mixed
    {
        throw_if(!in_array($key, SettingKey::all()), new Exception('Invalid Setting Key!'));
        $options = Setting::key($key)->first()?->option_value;
        if ($parse) {
            return is_array($options) && !empty($options) ? $options[0] : '';
        }
        return $options ?? [];
    }
}

if (!function_exists('price_with_currency')) {
    function price_with_currency($price): string
    {
        $c = user_currency();

        return $c->symbol . number_format($price * $c->exchange_rate);
    }
}
if (!function_exists('user_currency')) {
    function user_currency(): Currency
    {
        if (session()->has('currency')) {
            return Currency::whereName(session('currency'))->first();
        }
        return Currency::whereDefault(TRUE)->firstOr(function () {
            return null;
        });
    }
}

if (!function_exists('currencies')) {
    function currencies(): Collection
    {
        return Currency::all();
    }
}


if (!function_exists('change_currency')) {
    function change_currency(Currency $currency): void
    {
        session()->put('currency', $currency->name);
    }
}
