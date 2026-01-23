<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        if (!in_array($locale, ['en', 'id'])) {
            $locale = 'en';
        }

        session(['locale' => $locale]);

        $response = redirect()->back();
        
        $response->cookie(Cookie::make('locale', $locale, 60 * 24 * 365, path: '/', sameSite: 'lax'));

        if (auth()->check()) {
            auth()->user()->update(['language' => $locale]);
        }

        return $response;
    }
}
