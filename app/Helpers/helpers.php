<?php

namespace App\Helpers;

use App\Models\Setting;

if (!function_exists('setting')) {
    function setting($key = null, $default = null)
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                Setting::updateOrCreate(
                    ['key' => $k],
                    ['value' => $v]
                );
            }
            return true;
        }

        return Setting::where('key', $key)->value('value') ?? $default;
    }
}
