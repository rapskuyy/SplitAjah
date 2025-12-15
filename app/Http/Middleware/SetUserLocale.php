<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetUserLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Get locale from session, or user preference, or default to 'en'
        $locale = session('locale', auth()->check() ? auth()->user()->language : 'en');
        
        if (in_array($locale, ['en', 'id'])) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}