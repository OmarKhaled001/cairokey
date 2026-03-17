<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Switch the active locale and redirect back.
     */
    public function switch(Request $request, string $locale): RedirectResponse
    {
        // Guard — only allow supported locales
        if (! in_array($locale, ['ar', 'en'], true)) {
            abort(404);
        }

        session(['locale' => $locale]);

        return redirect()->back()->withHeaders([
            // Prevent the browser caching a localised response
            // and serving it again after the locale changes
            'Vary' => 'Accept-Language',
        ]);
    }
}
