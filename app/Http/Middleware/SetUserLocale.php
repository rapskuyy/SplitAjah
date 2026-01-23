<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SetUserLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = 'en';
        
        if (session()->has('locale')) {
            $locale = session('locale');
        } elseif ($request->hasCookie('locale')) {
            $locale = $request->cookie('locale');
        } elseif (auth()->check() && auth()->user()->language) {
            $locale = auth()->user()->language;
        }
        
        if (!in_array($locale, ['en', 'id'])) {
            $locale = 'en';
        }

        app()->setLocale($locale);
        Log::debug('Locale set to: ' . $locale);
        
        return $next($request);
    }
}