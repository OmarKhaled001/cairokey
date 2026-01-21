<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $query = Hotel::where('active', true);




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
        $cities = Hotel::where('active', true)->distinct()->pluck('city');

        return view('hotels.index', compact(
            'hotels',
            'cities',

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
