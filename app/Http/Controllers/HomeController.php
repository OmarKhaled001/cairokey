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
        // ─── Featured Items ─────────────────────

        $featuredItems = collect()
            ->merge(Service::active()->withTranslation()->where('featured', true)->latest()->take(6)->get())
            ->merge(Apartment::active()->withTranslation()->where('featured', true)->latest()->take(6)->get())
            ->merge(Car::active()->withTranslation()->where('featured', true)->latest()->take(6)->get())
            ->merge(Hotel::active()->withTranslation()->where('featured', true)->latest()->take(6)->get())
            ->sortByDesc('created_at')
            ->take(3);

        // ─── Offers ────────────────────────────

        $offers = Offer::latest()->take(3)->get();

        // ─── Latest Sections ───────────────────

        $services = Service::active()->withTranslation()->latest()->take(3)->get();
        $apartments = Apartment::active()->withTranslation()->latest()->take(3)->get();
        $cars = Car::active()->withTranslation()->latest()->take(3)->get();
        $hotels = Hotel::active()->withTranslation()->latest()->take(3)->get();

        return view('home', compact(
            'featuredItems',
            'offers',
            'services',
            'apartments',
            'cars',
            'hotels'
        ));
    }

    public function search(Request $request)
    {
        $query = $request->search;

        $apartments = $this->searchInModel(Apartment::class, $query, 'apartment');
        $cars       = $this->searchInModel(Car::class, $query, 'car');
        $hotels     = $this->searchInModel(Hotel::class, $query, 'hotel');
        $services   = $this->searchInModel(Service::class, $query, 'service');

        $searchResults = collect()
            ->merge($apartments)
            ->merge($cars)
            ->merge($hotels)
            ->merge($services);

        return view('search', compact('searchResults'));
    }


 private function searchInModel(string $model, string $query, string $type)
{
    $instance = new $model;

    // 1. تنظيف وتفكيك النص (عشان لو كتب "عايز شقة" يدور على "شقة")
    $searchWords = collect(explode(' ', $query))
        ->filter(fn($word) => mb_strlen($word) > 2)
        ->toArray();

    if (empty($searchWords)) return collect();

    return $model::active()
        ->withTranslation()
        ->whereHas('translations', function ($q) use ($searchWords, $instance) {
            $q->where('locale', app()->getLocale())
              ->where(function ($sub) use ($searchWords, $instance) {
                  foreach ($searchWords as $word) {
                      $sub->orWhere('name', 'like', "%$word%")
                          ->orWhere('tags', 'like', "%$word%");

                      if (in_array('city', $instance->translatedAttributes)) {
                          $sub->orWhere('city', 'like', "%$word%");
                      }
                  }
              });
        })
        ->get()
        ->map(function ($item) use ($query, $type) {
            // 2. حساب الـ Relevance Score
            $score = 0;
            $lowerName = mb_strtolower($item->name);
            $lowerQuery = mb_strtolower($query);

            if ($lowerName == $lowerQuery) $score += 100; // تطابق تام
            if (str_contains($lowerName, $lowerQuery)) $score += 50; // الجملة كاملة موجودة

            $item->setAttribute('search_score', $score);
            $item->setAttribute('search_type', $type);
            return $item;
        })
        ->sortByDesc('search_score')
        ->values();
}
}
