<?php

use App\Models\Setting;
use Illuminate\Support\Arr;




if (!function_exists('setting')) {

function setting($key = null, $default = null)
{
    static $settings;

    if (!$settings) {
        $settings = cache()->rememberForever('settings', function () {
            return Setting::pluck('value','key')->toArray();
        });
    }

    if (!$key) {
        return $settings;
    }

    $result = Arr::get($settings, $key);
    if(isset($result) && !empty($result))
        return $result;
    return $default;
}


}
