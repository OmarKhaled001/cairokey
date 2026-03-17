<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (! function_exists('setting')) {
    /**
     * Get a setting value by key, or bulk-set values when an array is passed.
     *
     * @param  string|array  $key          Key string, or associative array of [key => value_en] for bulk writes.
     * @param  mixed         $default      Fallback value returned when the key does not exist (read mode only).
     * @param  string|null   $locale       Force a specific locale ('en' or 'ar'); defaults to the active locale.
     * @return mixed                       The setting value in read mode, or true in bulk-write mode.
     */
    function setting(string|array $key, mixed $default = null, ?string $locale = null): mixed
    {
        // Bulk-write mode: setting(['key' => 'value', ...])
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                Setting::updateOrCreate(
                    ['key' => $k],
                    ['value_en' => $v]
                );
                Cache::forget("setting:{$k}");
            }

            return true;
        }

        // Read mode
        $setting = Cache::rememberForever("setting:{$key}", function () use ($key) {
            return Setting::where('key', $key)->first();
        });

        if (! $setting) {
            return $default;
        }

        if ($setting->translatable) {
            $locale ??= app()->getLocale();

            return ($locale === 'ar' ? $setting->value_ar : $setting->value_en) ?? $default;
        }

        return $setting->value_en ?? $default;
    }
}

if (! function_exists('setting_set')) {
    /**
     * Create or update a setting and invalidate its cache entry.
     *
     * @param  string       $key
     * @param  string|null  $valueEn
     * @param  string|null  $valueAr
     * @param  bool         $translatable
     */
    function setting_set(
        string $key,
        ?string $valueEn = null,
        ?string $valueAr = null,
        bool $translatable = false
    ): Setting {
        $setting = Setting::updateOrCreate(
            ['key' => $key],
            [
                'value_en'     => $valueEn,
                'value_ar'     => $valueAr,
                'translatable' => $translatable,
            ]
        );

        Cache::forget("setting:{$key}");

        return $setting;
    }
}

if (! function_exists('app_locale')) {
    function app_locale(): string
    {
        return app()->getLocale();
    }
}

if (! function_exists('is_rtl')) {
    function is_rtl(): bool
    {
        return app_locale() === 'ar';
    }
}
