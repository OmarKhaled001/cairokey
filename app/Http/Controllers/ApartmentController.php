<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;


class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        // Price range for slider
        $minAvailablePrice = Apartment::active()->min('min_price') ?? 0;
        $maxAvailablePrice = Apartment::active()->max('max_price') ?? 5000;

        $apartments = Apartment::active()
            ->withTranslation()
            ->filterByPrice($request->price_min, $request->price_max)
            ->filterByCity($request->city)
            ->sorted($request->get('sort', 'newest'))
            ->paginate(12)
            ->withQueryString();

        $cities = $this->getCities();

        return view('apartments.index', compact(
            'apartments',
            'cities',
            'minAvailablePrice',
            'maxAvailablePrice',
        ));
    }

    public function show(Apartment $apartment)
    {
        abort_if(!$apartment->active, 404);

        $apartment->load('translations');

        $relatedApartments = Apartment::active()
            ->withTranslation()
            ->where('id', '!=', $apartment->id)
            ->limit(8)
            ->get();

        return view('apartments.show', compact('apartment', 'relatedApartments'));
    }

    // ─── Private Helpers ──────────────────────────────────────────

    private function getCities(): \Illuminate\Support\Collection
    {
        return \App\Models\ApartmentTranslation::query()
            ->where('locale', app()->getLocale())
            ->whereNotNull('city')
            ->distinct()
            ->pluck('city');
    }
}
