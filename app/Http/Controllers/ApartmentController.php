<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Apartment::where('active', true);

        // Filters
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

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'lowest_price':
                $query->orderBy('price_per_night', 'asc');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        $apartments = $query->paginate(12)->withQueryString();

        $governorates = Apartment::where('active', true)->distinct()->pluck('governorate');
        $cities = Apartment::where('active', true)->distinct()->pluck('city');

        return view('apartments.index', compact('apartments', 'governorates', 'cities'));
    }

    public function show(Apartment $apartment)
    {
        if (!$apartment->active) {
            abort(404);
        }

        return view('apartments.show', compact('apartment'));
    }
}
