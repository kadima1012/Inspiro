<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    public static function customUrl($path)
    {
        // Ensure your subfolder path is included here
        return env('APP_URL') . '/storage/' . ltrim($path, '/');
    }
}
