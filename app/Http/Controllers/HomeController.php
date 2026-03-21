<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Car;
use App\Models\Hotel;
use App\Models\Offer;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class HomeController extends Controller
{
    private const FEATURED_LIMIT = 6;
    private const DISPLAY_LIMIT  = 3;

    private const SEARCHABLE_MODELS = [
        'apartment' => Apartment::class,
        'car'       => Car::class,
        'hotel'     => Hotel::class,
        'service'   => Service::class,
    ];

    public function index(): View
    {
        $featuredItems = $this->getFeaturedItems();
        $offers        = Offer::latest()->take(self::DISPLAY_LIMIT)->get();

        $latest = [
            'services'   => Service::active()->withTranslation()->latest()->take(self::DISPLAY_LIMIT)->get(),
            'apartments' => Apartment::active()->withTranslation()->latest()->take(self::DISPLAY_LIMIT)->get(),
            'cars'       => Car::active()->withTranslation()->latest()->take(self::DISPLAY_LIMIT)->get(),
            'hotels'     => Hotel::active()->withTranslation()->latest()->take(self::DISPLAY_LIMIT)->get(),
        ];

        return view('home', [
            'featuredItems' => $featuredItems,
            'offers'        => $offers,
            ...$latest,
        ]);
    }

    public function search(Request $request): View
    {
        $query = trim($request->input('search', ''));

        if ($query === '') {
            return view('search', ['searchResults' => collect()]);
        }

        $results = collect();

        foreach (self::SEARCHABLE_MODELS as $type => $model) {
            $results = $results->merge(
                $this->searchInModel($model, $query, $type)
            );
        }

        $sortedResults = $results
            ->sortByDesc('search_score')
            ->values();

        return view('search', [
            'searchResults' => $sortedResults,
        ]);
    }

    /**
     * Get merged and sorted featured items (max 3 displayed)
     */
    private function getFeaturedItems(): Collection
    {
        return collect([
            Service::class,
            Apartment::class,
            Car::class,
            Hotel::class,
        ])
            ->flatMap(fn(string $model) => $model::active()
                ->withTranslation()
                ->where('featured', true)
                ->latest()
                ->take(self::FEATURED_LIMIT)
                ->get()
            )
            ->sortByDesc('created_at')
            ->take(self::DISPLAY_LIMIT);
    }

    /**
     * Search inside one translatable model with basic relevance scoring
     */
    private function searchInModel(string $modelClass, string $query, string $type): Collection
    {
        $words = $this->prepareSearchWords($query);

        if (empty($words)) {
            return collect();
        }

        $items = $modelClass::active()
            ->withTranslation()
            ->whereHas('translations', function ($q) use ($words) {
                $q->where('locale', app()->getLocale())
                    ->where(function ($sub) use ($words) {
                        foreach ($words as $word) {
                            $sub->orWhere('name', 'like', "%{$word}%");

                            if (in_array('tags', (new $modelClass())->translatedAttributes ?? [])) {
                                $sub->orWhere('tags', 'like', "%{$word}%");
                            }

                            if (in_array('city', (new $modelClass())->translatedAttributes ?? [])) {
                                $sub->orWhere('city', 'like', "%{$word}%");
                            }
                        }
                    });
            })
            ->get();

        return $items->map(function ($item) use ($query, $type) {
            $score = $this->calculateRelevanceScore($item->name ?? '', $query);

            $item->search_score = $score;
            $item->search_type  = $type;

            return $item;
        });
    }

    /**
     * Split query into meaningful search words (min length 3 chars)
     */
    private function prepareSearchWords(string $query): array
    {
        return collect(explode(' ', trim($query)))
            ->map('mb_strtolower')
            ->filter(fn(string $word) => mb_strlen($word) >= 3)
            ->unique()
            ->values()
            ->all();
    }

    /**
     * Very simple relevance scoring
     * You can extend this later (Levenshtein, word positions, TF-IDF lite, etc.)
     */
    private function calculateRelevanceScore(string $name, string $query): int
    {
        $lowerName  = mb_strtolower($name);
        $lowerQuery = mb_strtolower($query);

        if ($lowerName === $lowerQuery) {
            return 100;
        }

        if (str_contains($lowerName, $lowerQuery)) {
            return 50;
        }

        // You can add more rules here (partial word matches, etc.)
        return 10;
    }
}