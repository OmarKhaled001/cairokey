<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Car;
use App\Models\Hotel;
use App\Models\Offer;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    /* ──────────────────────────────────────────────
     | Models included in search & featured queries
     ─────────────────────────────────────────────── */
    private const SEARCHABLE = [
        'apartment' => Apartment::class,
        'car'       => Car::class,
        'hotel'     => Hotel::class,
        'service'   => Service::class,
    ];

    /* ══════════════════════════════════════════════
     |  HOME
     ══════════════════════════════════════════════ */
    public function index()
    {
        $featuredItems = collect(self::SEARCHABLE)
            ->flatMap(fn($model) => $model::active()
                ->withTranslation()
                ->where('featured', true)
                ->latest()
                ->take(6)
                ->get()
            )
            ->sortByDesc('created_at')
            ->take(3)
            ->values();

        return view('home', [
            'featuredItems' => $featuredItems,
            'offers'        => Offer::latest()->take(3)->get(),
            'services'      => Service::active()->withTranslation()->latest()->take(3)->get(),
            'apartments'    => Apartment::active()->withTranslation()->latest()->take(3)->get(),
            'cars'          => Car::active()->withTranslation()->latest()->take(3)->get(),
            'hotels'        => Hotel::active()->withTranslation()->latest()->take(3)->get(),
        ]);
    }

    /* ══════════════════════════════════════════════
     |  SEARCH
     ══════════════════════════════════════════════ */
    

public function search(Request $request)
{
    $query = trim($request->input('search', ''));

    if (blank($query)) {
        return view('search', ['searchResults' => collect(), 'query' => '']);
    }

    $searchResults = collect(self::SEARCHABLE)
        ->flatMap(fn($model, $type) => $model::active()
            ->withTranslation()
            ->whereHas('translations', fn($q) => $q
                ->where('locale', app()->getLocale())
                ->where('name', 'like', "%{$query}%")
            )
            ->get()
            ->each(fn($item) => $item->search_type = $type)
        )
        ->values();

    return view('search', compact('searchResults', 'query'));
}

    /* ──────────────────────────────────────────────
     | Query one model and score its results
     ─────────────────────────────────────────────── */
    private function searchModel(
        string $model,
        string $type,
        string $normalized,
        array  $words
    ): Collection {
        $results = $model::active()
            ->withTranslation()
            ->whereHas('translations', function ($q) use ($normalized, $words) {
                $q->where('locale', app()->getLocale())
                  ->where(function ($sub) use ($normalized, $words) {
                      // Full phrase first
                      $sub->where('name', 'like', "%{$normalized}%")
                          ->orWhere('description', 'like', "%{$normalized}%");

                      // Individual words
                      foreach ($words as $word) {
                          $sub->orWhere('name', 'like', "%{$word}%")
                              ->orWhere('description', 'like', "%{$word}%");
                      }
                  });
            })
            ->orWhere('city', 'like', "%{$normalized}%") // city is on the main table
            ->get();

        return $results->map(function ($item) use ($type, $normalized, $words) {
            $item->search_type  = $type;
            $item->search_score = $this->score($item, $normalized, $words);
            return $item;
        });
    }

    /* ──────────────────────────────────────────────
     | Score a single result (higher = more relevant)
     ─────────────────────────────────────────────── */
    private function score(mixed $item, string $normalized, array $words): int
    {
        $name = $this->normalize((string) ($item->name        ?? ''));
        $desc = $this->normalize((string) ($item->description ?? ''));
        $city = $this->normalize((string) ($item->city        ?? ''));
        $tags = $this->normalize(
            is_array($item->tags) ? implode(' ', $item->tags) : (string) ($item->tags ?? '')
        );

        $score = 0;

        // Exact / phrase matches (weighted by field importance)
        if ($name === $normalized)              $score += 100;
        if (str_contains($name, $normalized))   $score += 50;
        if (str_contains($city, $normalized))   $score += 30;
        if (str_contains($tags, $normalized))   $score += 25;
        if (str_contains($desc, $normalized))   $score += 10;

        // Per-word matches
        foreach ($words as $word) {
            if (str_contains($name, $word))     $score += 15;
            if (str_contains($city, $word))     $score += 10;
            if (str_contains($tags, $word))     $score += 8;
            if (str_contains($desc, $word))     $score += 3;
        }

        // Boost featured items slightly
        if ($item->featured)                    $score += 5;

        return $score;
    }

    /* ──────────────────────────────────────────────
     | Normalize Arabic text for comparison
     ─────────────────────────────────────────────── */
    private function normalize(string $text): string
    {
        $text = mb_strtolower(trim($text));

        // Unify Alef variants → ا
        $text = str_replace(['أ', 'إ', 'آ', 'ٱ'], 'ا', $text);

        // Unify Yaa variants → ي
        $text = str_replace(['ى', 'ئ'], 'ي', $text);

        // Unify Taa Marbuta → ه
        $text = str_replace('ة', 'ه', $text);

        // Strip diacritics (tashkeel)
        $text = preg_replace('/[\x{064B}-\x{065F}]/u', '', $text);

        return $text;
    }

    /* ──────────────────────────────────────────────
     | Split query into meaningful tokens
     ─────────────────────────────────────────────── */
    private function tokenize(string $normalized): array
    {
        return collect(preg_split('/[\s،,]+/u', $normalized))
            ->map(fn($w) => trim($w))
            ->filter(fn($w) => mb_strlen($w) > 1)
            ->unique()
            ->values()
            ->all();
    }
}
