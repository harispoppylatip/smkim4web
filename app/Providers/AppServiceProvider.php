<?php

namespace App\Providers;

use App\Models\PengaturanSosialMedia;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // View Composer untuk social media - inject ke semua view
        View::composer(['layouts.public', 'contact'], function ($view) {
            $data = Cache::remember('pengaturan_sosial_media', 3600, function () {
                $model = PengaturanSosialMedia::first();
                if (!$model) {
                    return null;
                }
                return [
                    'youtube'   => $model->youtube,
                    'instagram' => $model->instagram,
                    'facebook'  => $model->facebook,
                    'tiktok'    => $model->tiktok,
                ];
            });

            // Convert array back to object for blade syntax $social->youtube
            $social = (object) ($data ?? []);
            $view->with('social', $social);
        });
    }
}
