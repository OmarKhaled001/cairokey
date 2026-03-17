<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (! function_exists('setting')) {
    /**
     * Get or set settings.
     *
     * @param  string|array  $key
     * @param  mixed         $default
     * @param  string|null   $locale
     * @return mixed
     */
    function setting(string|array $key, mixed $default = null, ?string $locale = null): mixed
    {
        // =========================
        // Bulk write mode
        // =========================
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                Setting::updateOrCreate(
                    ['key' => $k],
                    ['value_en' => $v]
                );
            }

            // 🔥 clear all cache
            Cache::forget('settings:all');

            return true;
        }

        $locale ??= app()->getLocale();

        // =========================
        // Load all settings once
        // =========================
        $settings = Cache::rememberForever('settings:all', function () {
            return Setting::all()->keyBy('key');
        });

        if (! $settings->has($key)) {
            return $default;
        }

        $setting = $settings[$key];

        // =========================
        // Non-translatable
        // =========================
        if (! $setting->translatable) {
            return $setting->value_en ?? $default;
        }

        // =========================
        // Translatable (dynamic)
        // =========================
        $value = $setting->{'value_' . $locale} ?? null;

        // fallback chain
        if (! $value) {
            $value = $setting->value_en
                ?? $setting->value_ar
                ?? $default;
        }

        return $value;
    }
}

if (! function_exists('setting_set')) {
    /**
     * Create or update setting.
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

        // 🔥 clear global cache
        Cache::forget('settings:all');

        return $setting;
    }
}

if (! function_exists('setting_forget')) {
    /**
     * Clear all cached settings.
     */
    function setting_forget(): void
    {
        Cache::forget('settings:all');
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
        return in_array(app_locale(), ['ar', 'fa', 'ur']);
    }
}
