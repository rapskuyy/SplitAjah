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
        // Set the application locale based on user preference
        $this->setApplicationLocale();
    }

    /**
     * Set the application locale
     */
    private function setApplicationLocale(): void
    {
        $locale = 'en';
        
        if (session()->has('locale')) {
            $locale = session('locale');
        }
        elseif (request()->hasCookie('locale')) {
            $locale = request()->cookie('locale');
        }
        elseif (auth()->check() && auth()->user()->language) {
            $locale = auth()->user()->language;
        }
        
        if (!in_array($locale, ['en', 'id'])) {
            $locale = 'en';
        }
        
        app()->setLocale($locale);
    }
}
