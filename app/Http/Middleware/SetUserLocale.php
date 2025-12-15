<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetUserLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Priority: session -> cookie -> user's language field -> default 'en'
        $locale = 'en';
        
        // Check session first (set by language switch)
        if (session()->has('locale') && in_array(session('locale'), ['en', 'id'])) {
            $locale = session('locale');
        }
        // Check cookie (immediate availability)
        elseif ($request->cookie('locale') && in_array($request->cookie('locale'), ['en', 'id'])) {
            $locale = $request->cookie('locale');
        }
        // Check user's stored language preference if authenticated
        elseif (auth()->check() && auth()->user()->language && in_array(auth()->user()->language, ['en', 'id'])) {
            $locale = auth()->user()->language;
        }
        // Fall back to English
        else {
            $locale = 'en';
        }
        
        // Set the application locale immediately
        app()->setLocale($locale);
        
        return $next($request);
    }
}
