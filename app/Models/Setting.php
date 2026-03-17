<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'key',
        'value_en',
        'value_ar',
        'translatable',
    ];

    protected $casts = [
        'translatable' => 'boolean',
    ];

    // ──────────────────────────────────────────
    //  Read
    // ──────────────────────────────────────────

    /**
     * Get a plain (non-translatable) value.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return static::remember($key)?->value_en ?? $default;
    }

    /**
     * Get translatable value for the current / given locale.
     */
    public static function getTranslated(string $key, ?string $locale = null, mixed $default = null): mixed
    {
        $setting = static::remember($key);

        if (! $setting) {
            return $default;
        }

        $locale ??= app()->getLocale();

        return ($locale === 'ar' ? $setting->value_ar : $setting->value_en) ?? $default;
    }

    /**
     * Get all translations as ['en' => ..., 'ar' => ...].
     */
    public static function getWithTranslations(string $key): ?array
    {
        $setting = static::remember($key);

        if (! $setting) {
            return null;
        }

        return [
            'en' => $setting->value_en,
            'ar' => $setting->value_ar,
        ];
    }

    // ──────────────────────────────────────────
    //  Write
    // ──────────────────────────────────────────

    /**
     * Upsert a single setting.
     *
     * Pass a scalar for plain keys, or ['en' => ..., 'ar' => ...] for translatable ones.
     */
    public static function set(string $key, mixed $value): void
    {
        $isTranslatable = is_array($value);

        static::updateOrCreate(
            ['key' => $key],
            $isTranslatable
                ? [
                    'value_en'     => $value['en'] ?? null,
                    'value_ar'     => $value['ar'] ?? null,
                    'translatable' => true,
                ]
                : [
                    'value_en'     => $value,
                    'value_ar'     => null,
                    'translatable' => false,
                ]
        );

        static::forget($key);
    }

    /**
     * Upsert many settings at once.
     *
     * @param  array<string, scalar|array>  $data
     */
    public static function setMany(array $data): void
    {
        foreach ($data as $key => $value) {
            static::set($key, $value);
        }
    }

    // ──────────────────────────────────────────
    //  Cache helpers
    // ──────────────────────────────────────────

    private static function remember(string $key): ?self
    {
        return Cache::rememberForever(
            static::cacheKey($key),
            fn () => static::where('key', $key)->first()
        );
    }

    private static function forget(string $key): void
    {
        Cache::forget(static::cacheKey($key));
    }

    private static function cacheKey(string $key): string
    {
        return "setting:{$key}";
    }

}
