<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $hotels = Hotel::active()
            ->withTranslation()
            ->filterByCity($request->city)
            ->filterByRating($request->rating)
            ->sorted($request->get('sort', 'newest'))
            ->paginate(12)
            ->withQueryString();

        $cities = $this->getCities();

        return view('hotels.index', compact(
            'hotels',
            'cities'
        ));
    }

    public function show(Hotel $hotel)
    {
        abort_if(!$hotel->active, 404);

        $hotel->load('translations');

        $relatedHotels = Hotel::active()
            ->withTranslation()
            ->where('id', '!=', $hotel->id)
            ->limit(8)
            ->get();

        return view('hotels.show', compact('hotel', 'relatedHotels'));
    }

    // ─── Helpers ─────────────────────────────

    private function getCities()
    {
        return \App\Models\HotelTranslation::query()
            ->where('locale', app()->getLocale())
            ->whereNotNull('city')
            ->distinct()
            ->pluck('city');
    }
}
