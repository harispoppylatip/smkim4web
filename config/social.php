<?php

/*
|--------------------------------------------------------------------------
| Social Media Links
|--------------------------------------------------------------------------
|
| Configure social media URLs for the school. These are used in the footer
| and contact page to link to official social media profiles.
|
| NOTE: Data sebenarnya diambil dari database via View Composer di
| AppServiceProvider. Config ini hanya sebagai fallback default.
|
*/

return [
    'youtube' => env('SOCIAL_YOUTUBE', 'https://youtube.com/@smkim4samarinda'),
    'instagram' => env('SOCIAL_INSTAGRAM', 'https://instagram.com/smkim4samarinda'),
    'facebook' => env('SOCIAL_FACEBOOK', 'https://facebook.com/smkim4samarinda'),
    'tiktok' => env('SOCIAL_TIKTOK', 'https://tiktok.com/@smkim4samarinda'),
];
