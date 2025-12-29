<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $query = Hotel::where('active', true);

        $minAvailablePrice = Hotel::where('active', true)->min('price_per_night') ?? 0;
        $maxAvailablePrice = Hotel::where('active', true)->max('price_per_night') ?? 5000;

        if ($request->filled('price_min')) {
            $query->where('price_per_night', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price_per_night', '<=', $request->price_max);
        }

        if ($request->filled('governorate')) {
            $query->where('governorate', $request->governorate);
        }
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // Rating filter - using hotel's own rating field
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'lowest_price':
                $query->orderBy('price_per_night', 'asc');
                break;
            case 'highest_rated':
                $query->orderByDesc('rating');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        $hotels = $query->paginate(12)->withQueryString();
        $governorates = Hotel::where('active', true)->distinct()->pluck('governorate');
        $cities = Hotel::where('active', true)->distinct()->pluck('city');

        return view('hotels.index', compact(
            'hotels',
            'governorates',
            'cities',
            'minAvailablePrice',
            'maxAvailablePrice'
        ));
    }

    public function show(Hotel $hotel)
    {
        if (!$hotel->active) {
            abort(404);
        }

        $relatedHotels = Hotel::where('active', true)
            ->where('id', '!=', $hotel->id)
            ->limit(8)
            ->get();

        return view('hotels.show', compact('hotel', 'relatedHotels'));
    }
}
