
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
    // ─── الـ models اللي بنبحث فيها ────────────────────────────────────────────
    private array $searchableModels = [
        Apartment::class => 'apartment',
        Car::class       => 'car',
        Hotel::class     => 'hotel',
        Service::class   => 'service',
    ];

    // ─── كلمات يتجاهلها البحث (عربي + إنجليزي) ─────────────────────────────────
    private array $stopWords = [
        'عايز','عاوز','أريد','اريد','ابغى','أبغى','بدي','محتاج','محتاجة',
        'في','من','على','الى','إلى','عن','مع','هل','هناك','فيه','ايه','إيه',
        'احسن','أحسن','افضل','أفضل','كويس','رخيص','قريب','ممكن','عندك',
        'i','want','need','find','looking','for','a','an','the','in',
        'near','best','good','cheap','any','show','me','some',
    ];

    // ─────────────────────────────────────────────────────────────────────────────

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

        return view('home', compact(
            'featuredItems', 'offers', 'services', 'apartments', 'cars', 'hotels'
        ));
    }

    // ─────────────────────────────────────────────────────────────────────────────

    public function search(Request $request)
    {
        $query = trim($request->input('search', ''));

        if (blank($query)) {
            return view('search', ['searchResults' => collect(), 'query' => '']);
        }

        $searchResults = collect($this->searchableModels)
            ->flatMap(fn($type, $model) => $this->searchInModel($model, $query, $type))
            ->sortByDesc('search_score')
            ->values();

        return view('search', compact('searchResults', 'query'));
    }

    // ─────────────────────────────────────────────────────────────────────────────

    private function searchInModel(string $model, string $query, string $type)
    {
        $normalized = $this->normalize($query);
        $keywords   = $this->extractKeywords($normalized);

        if (empty($keywords)) {
            return collect();
        }

        $instance = new $model;
        $hasCity  = in_array('city', $instance->translatedAttributes ?? []);

        return $model::active()
            ->withTranslation()
            ->whereHas('translations', function ($q) use ($keywords, $normalized, $hasCity) {
                $q->where(function ($sub) use ($keywords, $normalized, $hasCity) {
                    // بحث في اللغتين عربي + إنجليزي
                    foreach (['ar', 'en'] as $locale) {
                        $sub->orWhere(function ($loc) use ($locale, $keywords, $normalized, $hasCity) {
                            $loc->where('locale', $locale)
                                ->where(function ($w) use ($keywords, $normalized, $hasCity) {
                                    // الجملة كاملة
                                    $w->orWhere('name', 'like', "%{$normalized}%");
                                    if ($hasCity) {
                                        $w->orWhere('city', 'like', "%{$normalized}%");
                                    }
                                    // كل كلمة لوحدها
                                    foreach ($keywords as $kw) {
                                        $w->orWhere('name', 'like', "%{$kw}%")
                                          ->orWhere('tags', 'like', "%{$kw}%");
                                        if ($hasCity) {
                                            $w->orWhere('city', 'like', "%{$kw}%");
                                        }
                                    }
                                });
                        });
                    }
                });
            })
            ->get()
            ->map(fn($item) => $this->attachScore($item, $normalized, $keywords, $type));
    }

    // ─── Scoring ─────────────────────────────────────────────────────────────────

    private function attachScore($item, string $normalized, array $keywords, string $type)
    {
        $name = $this->normalize((string) ($item->name ?? ''));
        $city = $this->normalize((string) ($item->city ?? ''));
        $tags = $this->normalize($this->tagsToString($item->tags));

        $score = 0;

        // exact full match → أعلى score
        if ($name === $normalized)              $score += 100;
        if (str_contains($name, $normalized))   $score += 50;
        if (str_contains($city, $normalized))   $score += 30;
        if (str_contains($tags, $normalized))   $score += 20;

        // كل keyword موجودة تزيد الـ score
        foreach ($keywords as $kw) {
            if (str_contains($name, $kw)) $score += 10;
            if (str_contains($city, $kw)) $score += 5;
            if (str_contains($tags, $kw)) $score += 3;
        }

        $item->setAttribute('search_score', $score);
        $item->setAttribute('search_type',  $type);

        return $item;
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────────

    /**
     * توحيد النص: lowercase + توحيد الألف + حذف التشكيل
     */
    private function normalize(string $text): string
    {
        $text = mb_strtolower(trim($text));
        $text = str_replace(['أ','إ','آ','ٱ'], 'ا', $text);
        $text = preg_replace('/[\x{064B}-\x{065F}]/u', '', $text);
        return $text;
    }

    /**
     * استخراج الكلمات المفيدة بعد حذف الـ stop words
     */
    private function extractKeywords(string $normalized): array
    {
        $words = preg_split('/[\s،,]+/u', $normalized, -1, PREG_SPLIT_NO_EMPTY);

        return collect($words)
            ->filter(fn($w) => mb_strlen($w) > 1 && ! in_array($w, $this->stopWords))
            ->unique()
            ->values()
            ->toArray();
    }

    /**
     * tags ممكن تكون array (JSON cast) أو string
     */
    private function tagsToString(mixed $tags): string
    {
        if (is_array($tags)) {
            return implode(' ', $tags);
        }
        return (string) ($tags ?? '');
    }
