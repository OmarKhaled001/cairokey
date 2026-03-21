<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Car;
use App\Models\Hotel;
use App\Models\Service;
use App\Models\Offer;

class HomeController extends Controller
{
    public function index()
    {
        $featuredItems = collect()
            ->merge(Service::active()->withTranslation()->where('featured', true)->latest()->take(6)->get())
            ->merge(Apartment::active()->withTranslation()->where('featured', true)->latest()->take(6)->get())
            ->merge(Car::active()->withTranslation()->where('featured', true)->latest()->take(6)->get())
            ->merge(Hotel::active()->withTranslation()->where('featured', true)->latest()->take(6)->get())
            ->sortByDesc('created_at')
            ->take(3);

        $offers     = Offer::latest()->take(3)->get();
        $services   = Service::active()->withTranslation()->latest()->take(3)->get();
        $apartments = Apartment::active()->withTranslation()->latest()->take(3)->get();
        $cars       = Car::active()->withTranslation()->latest()->take(3)->get();
        $hotels     = Hotel::active()->withTranslation()->latest()->take(3)->get();

        return view('home', compact('featuredItems', 'offers', 'services', 'apartments', 'cars', 'hotels'));
    }

    public function search(Request $request)
    {
        // ✅ Fix 1: validate + trim + null guard
        $query = trim($request->input('search', ''));

        if (blank($query)) {
            return view('search', ['searchResults' => collect(), 'query' => '']);
        }

        $apartments = $this->searchInModel(Apartment::class, $query, 'apartment');
        $cars       = $this->searchInModel(Car::class,       $query, 'car');
        $hotels     = $this->searchInModel(Hotel::class,     $query, 'hotel');
        $services   = $this->searchInModel(Service::class,   $query, 'service');

        $searchResults = collect()
            ->merge($apartments)
            ->merge($cars)
            ->merge($hotels)
            ->merge($services)
            ->sortByDesc('search_score') // ✅ Fix 2: sort the final merged collection
            ->values();

        return view('search', compact('searchResults', 'query'));
    }

    private function searchInModel(string $model, string $query, string $type)
    {
        // ✅ Fix 3: normalize Arabic + remove diacritics
        $normalized = $this->normalizeArabic($query);

        // ✅ Fix 4: filter empty words properly (was breaking on blank query)
        $words = collect(preg_split('/[\s،,]+/u', $normalized))
            ->filter(fn($w) => mb_strlen(trim($w)) > 1)
            ->unique()
            ->values()
            ->toArray();

        if (empty($words)) {
            return collect();
        }

        $instance = new $model;
        $hasCity  = in_array('city', $instance->translatedAttributes ?? []);

        $results = $model::active()
            ->withTranslation()
            ->whereHas('translations', function ($q) use ($words, $normalized, $hasCity) {
                $q->where('locale', app()->getLocale())
                  ->where(function ($sub) use ($words, $normalized, $hasCity) {

                      // ✅ Fix 5: search full normalized query first (exact phrase)
                      $sub->orWhere('name', 'like', "%{$normalized}%")
                          ->orWhere('tags', 'like', "%{$normalized}%");

                      if ($hasCity) {
                          $sub->orWhere('city', 'like', "%{$normalized}%");
                      }

                      // then each word separately
                      foreach ($words as $word) {
                          $sub->orWhere('name', 'like', "%{$word}%")
                              ->orWhere('tags', 'like', "%{$word}%");

                          if ($hasCity) {
                              $sub->orWhere('city', 'like', "%{$word}%");
                          }
                      }
                  });
            })
            ->get();

        // ✅ Fix 6: score null-safe with fallback to empty string
        return $results->map(function ($item) use ($query, $normalized, $words, $type) {
            $score = 0;

            $name = mb_strtolower((string) ($item->name ?? ''));
            $tags = mb_strtolower((string) ($item->tags ?? ''));
            $city = mb_strtolower((string) ($item->city ?? ''));
            $hay  = $name . ' ' . $tags . ' ' . $city;

            $lowerNorm = mb_strtolower($normalized);

            if ($name === $lowerNorm)                    $score += 100; // exact name match
            if (str_contains($name, $lowerNorm))         $score += 50;  // phrase in name
            if (str_contains($tags, $lowerNorm))         $score += 30;  // phrase in tags
            if (str_contains($city, $lowerNorm))         $score += 20;  // phrase in city

            foreach ($words as $word) {
                $w = mb_strtolower($word);
                if (str_contains($name, $w)) $score += 10;
                if (str_contains($tags, $w)) $score += 5;
                if (str_contains($city, $w)) $score += 5;
            }

            $item->setAttribute('search_score', $score);
            $item->setAttribute('search_type',  $type);
            $item->setAttribute('search_query', $query); // ✅ مفيد في الـ view
            return $item;
        })
        ->sortByDesc('search_score')
        ->values();
    }

    private function normalizeArabic(string $text): string
    {
        $text = mb_strtolower(trim($text));
        // توحيد الألف
        $text = str_replace(['أ','إ','آ','ٱ'], 'ا', $text);
        // حذف التشكيل
        $text = preg_replace('/[\x{064B}-\x{065F}]/u', '', $text);
        return $text;
    }
}