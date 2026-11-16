<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supportedLocales = ['en', 'id'];

        $locale = Session::get('locale');

        if (!$locale) {
            $locale = $request->cookie('locale');
        }

        if (!$locale || !in_array($locale, $supportedLocales)) {
            $locale = config('app.locale', 'id');
        }

        App::setLocale($locale);
        Carbon::setLocale($locale);

        return $next($request);
    }
}

