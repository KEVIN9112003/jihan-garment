<?php

namespace App\Providers;

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
        /** 
         * Memastikan Laravel menggunakan folder public yang benar di Vercel 
         * agar aset seperti gambar jihan23.png dan CSS tidak pecah.
         */
        $this->app->bind('path.public', function() {
            return base_path('public');
        });
    }
}