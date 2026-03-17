<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Read the locale from the session and apply it to the application.
     * Falls back to config('app.locale') when nothing is stored yet.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale', config('app.locale'));

        // Extra safety — reject anything that snuck past the route constraint
        if (! in_array($locale, ['ar', 'en'], true)) {
            $locale = config('app.locale');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
