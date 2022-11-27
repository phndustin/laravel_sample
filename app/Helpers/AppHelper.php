<?php

namespace App\Helpers;

class AppHelper {
    public static function getFEUrl($path) {
        return config('app.fe_url') . $path;
    }
}