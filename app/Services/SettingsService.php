<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingsService
{

    function getSetting()
    {
        return Cache::rememberForever('settings', function () {
            return Setting::pluck('value', 'key')->toArray(); //['key' => 'value']

        });
    }

    function setGlobalSettings(): void
    {
        $settings = $this->getSetting();
        config()->set('settings', $settings);
    }

    function clearCacheSettings(): void
    {
        Cache::forget('settings');
    }
}
