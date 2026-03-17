<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $minAvailablePrice = Car::active()->min('price_per_day') ?? 0;
        $maxAvailablePrice = Car::active()->max('price_per_day') ?? 5000;

        $cars = Car::active()
            ->withTranslation()
            ->filterByPrice($request->price_min, $request->price_max)
            ->filterByBrand($request->brand)
            ->sorted($request->get('sort', 'newest'))
            ->paginate(12)
            ->withQueryString();

        $brands = $this->getBrands();

        return view('cars.index', compact(
            'cars',
            'brands',
            'minAvailablePrice',
            'maxAvailablePrice'
        ));
    }

    public function show(Car $car)
    {
        abort_if(!$car->active, 404);

        $car->load('translations');

        $relatedCars = Car::active()
            ->withTranslation()
            ->where('id', '!=', $car->id)
            ->limit(8)
            ->get();

        return view('cars.show', compact('car', 'relatedCars'));
    }

    // ─── Helpers ─────────────────────────────

    private function getBrands()
    {
        return \App\Models\CarTranslation::query()
            ->where('locale', app()->getLocale())
            ->whereNotNull('brand')
            ->distinct()
            ->pluck('brand');
    }
}
