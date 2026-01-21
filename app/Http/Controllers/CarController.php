<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Apartment;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::where('active', true);

        // جلب أقل وأعلى سعر موجودين فعلياً في قاعدة البيانات
        $minAvailablePrice = Car::where('active', true)->min('price_per_day') ?? 0;
        $maxAvailablePrice = Car::where('active', true)->max('price_per_day') ?? 5000;

        // تطبيق الفلتر
        if ($request->filled('price_min')) {
            $query->where('price_per_day', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price_per_day', '<=', $request->price_max);
        }

        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'lowest_price':
                $query->orderBy('price_per_day', 'asc');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        $cars = $query->paginate(12)->withQueryString();
        $brands = Car::where('active', true)->distinct()->pluck('brand');


        return view('cars.index', compact(
            'cars',
            'brands',
            'minAvailablePrice',
            'maxAvailablePrice'
        ));
    }

    public function show(Car $car)
    {
        if (!$car->active) {
            abort(404);
        }

        $relatedCars = Car::where('active', true)
            ->where('id', '!=', $car->id)
            ->limit(8)
            ->get();

        return view('cars.show', compact('car', 'relatedCars'));
    }
}
