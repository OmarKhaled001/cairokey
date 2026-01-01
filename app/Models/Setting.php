<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public $timestamps = false;

    /* =========================
     | Get single setting
     ========================= */
    public static function get(string $key, mixed $default = null): mixed
    {
        return static::allCached()[$key] ?? $default;
    }

    /* =========================
     | Set single setting
     ========================= */
    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => is_array($value) ? json_encode($value) : $value]
        );

        Cache::forget('settings');
    }

    /* =========================
     | Set multiple settings
     ========================= */
    public static function setMany(array $data): void
    {
        foreach ($data as $key => $value) {
            static::updateOrCreate(
                ['key' => $key],
                ['value' => is_array($value) ? json_encode($value) : $value]
            );
        }

        Cache::forget('settings');
    }

    /* =========================
     | Get all settings (cached)
     ========================= */
    public static function allCached(): array
    {
        return Cache::rememberForever('settings', function () {
            return static::pluck('value', 'key')->toArray();
        });
    }
}
