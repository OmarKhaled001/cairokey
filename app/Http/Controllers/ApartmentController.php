<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Apartment::where('active', true);

        // جلب أقل وأعلى سعر موجودين فعلياً في قاعدة البيانات
        $minAvailablePrice = Apartment::where('active', true)->min('min_price') ?? 0;
        $maxAvailablePrice = Apartment::where('active', true)->max('max_price') ?? 5000;

        // تطبيق الفلتر
        if ($request->filled('price_min')) {
            $query->where('max_price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('min_price', '<=', $request->price_max);
        }

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'lowest_price':
                $query->orderBy('min_price', 'asc');
                break;

            case 'newest':
            default:
                $query->latest();
                break;
        }

        $apartments = $query->with(['bookings' => function ($q) {
            $q->whereIn('status', ['confirmed', 'pending']);
        }])->paginate(1)->withQueryString();

        $apartments = $query->paginate(12)->withQueryString();
        $cities = Apartment::where('active', true)->distinct()->pluck('city');

        return view('apartments.index', compact(
            'apartments',
            'cities',
            'minAvailablePrice',
            'maxAvailablePrice'
        ));
    }

    public function show(Apartment $apartment)
    {
        if (!$apartment->active) {
            abort(404);
        }

        $relatedApartments = Apartment::where('active', true)
            ->where('id', '!=', $apartment->id)
            ->limit(8)
            ->get();

        return view('apartments.show', compact('apartment', 'relatedApartments'));
    }
}
