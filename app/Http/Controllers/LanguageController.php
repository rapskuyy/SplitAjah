<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        // Validate locale
        if (!in_array($locale, ['en', 'id'])) {
            $locale = 'en';
        }

        // Store in session (will be available after middleware runs next time)
        session(['locale' => $locale]);

        // Store in cookie (immediate availability)
        cookie()->queue('locale', $locale, 60*24*365); // 1 year

        // Store in user profile if authenticated
        if (auth()->check()) {
            auth()->user()->update(['language' => $locale]);
        }

        // Redirect back to previous page
        return redirect()->back();
    }
}
