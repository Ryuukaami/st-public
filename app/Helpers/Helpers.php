<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

if (!function_exists('getProfilePhotoUrl')) {
    function getProfilePhotoUrl()
    {
        $user = Auth::user();
        $picture = Storage::url($user->profile_picture);

        // Return the asset URL for the profile photo or a default image
        return $picture;
    }
}
