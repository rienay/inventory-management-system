<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    /**
     * Switch the application locale.
     */
    public function switch(Request $request, string $locale): RedirectResponse
    {
        $supportedLocales = ['en', 'id'];

        if (in_array($locale, $supportedLocales)) {
            Session::put('locale', $locale);
            App::setLocale($locale);

            $cookie = cookie('locale', $locale, 60 * 24 * 365); // 1 year

            return redirect()->back()->withCookie($cookie);
        }

        return redirect()->back();
    }
}

