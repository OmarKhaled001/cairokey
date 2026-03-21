<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Car;
use App\Models\Hotel;
use App\Models\Service;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Collection;

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

        $offers = Offer::latest()->take(3)->get();

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
        $query = $request->input('search', '');
        
        if (empty(trim($query))) {
            return view('search', ['searchResults' => collect()]);
        }

        $apartments = $this->searchInModel(Apartment::class, $query, 'apartment');
        $cars       = $this->searchInModel(Car::class, $query, 'car');
        $hotels     = $this->searchInModel(Hotel::class, $query, 'hotel');
        $services   = $this->searchInModel(Service::class, $query, 'service');

        $searchResults = collect()
            ->merge($apartments)
            ->merge($cars)
            ->merge($hotels)
            ->merge($services)
            ->sortByDesc('search_score');

        return view('search', compact('searchResults'));
    }

    private function searchInModel(string $model, string $query, string $type): Collection
    {
        if (!class_exists($model)) {
            return collect();
        }

        $instance = new $model;
        
        if (!method_exists($instance, 'active') || !method_exists($instance, 'withTranslation')) {
            return collect();
        }

        $query = trim($query);
        if (empty($query)) {
            return collect();
        }

        $searchWords = collect(explode(' ', $query))
            ->filter(fn($word) => mb_strlen(trim($word)) > 2)
            ->values()
            ->toArray();

        if (empty($searchWords)) {
            $searchWords = [$query];
        }

        try {
            $results = $model::active()
                ->withTranslation()
                ->whereHas('translations', function ($q) use ($searchWords, $instance) {
                    $q->where('locale', app()->getLocale())
                      ->where(function ($sub) use ($searchWords, $instance) {
                          foreach ($searchWords as $word) {
                              $sub->orWhere('name', 'like', "%$word%");
                              $sub->orWhere('tags', 'like', "%$word%");
                              
                              if (property_exists($instance, 'translatedAttributes') && 
                                  in_array('city', $instance->translatedAttributes ?? [])) {
                                  $sub->orWhere('city', 'like', "%$word%");
                              }
                          }
                      });
                })
                ->get();
        } catch (\Exception $e) {
            \Log::error("Search error in {$model}: " . $e->getMessage());
            return collect();
        }

        if ($results->isEmpty()) {
            return collect();
        }

        return $results
            ->map(function ($item) use ($query, $type) {
                $score = 0;
                
                $name = $item->name ?? '';
                $lowerName = mb_strtolower($name);
                $lowerQuery = mb_strtolower($query);
                
                if ($lowerName === $lowerQuery) {
                    $score += 100;
                }
                elseif (str_contains($lowerName, $lowerQuery)) {
                    $score += 50;
                }
                
                if (!empty($item->tags) && str_contains(mb_strtolower($item->tags), $lowerQuery)) {
                    $score += 30;
                }
                
                if (!empty($item->city) && str_contains(mb_strtolower($item->city), $lowerQuery)) {
                    $score += 20;
                }
                
                $queryWords = explode(' ', $lowerQuery);
                foreach ($queryWords as $word) {
                    if (mb_strlen($word) > 2 && str_contains($lowerName, $word)) {
                        $score += 10;
                    }
                }

                $item->setAttribute('search_score', $score);
                $item->setAttribute('search_type', $type);
                return $item;
            })
            ->filter(function ($item) {
                return $item->search_score > 0;
            })
            ->sortByDesc('search_score')
            ->values();
    }
}