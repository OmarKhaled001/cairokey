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
    public function index()
    {
        // Featured Items
        $featuredItems = collect()
            ->merge(Service::where('featured', true)->latest()->take(6)->get())
            ->merge(Apartment::where('featured', true)->latest()->take(6)->get())
            ->merge(Car::where('featured', true)->latest()->take(6)->get())
            ->merge(Hotel::where('featured', true)->latest()->take(6)->get())
            ->sortByDesc('created_at')
            ->take(6);

        // Offers
        $offers = Offer::latest()->take(6)->get();

        // Latest Sections
        $services = Service::latest()->take(6)->get();
        $apartments = Apartment::latest()->take(6)->get();
        $cars = Car::latest()->take(6)->get();
        $hotels = Hotel::latest()->take(6)->get();

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
        $query = $request->search;

        // 1. البحث في الشقق (اسم، تاجز، مدينة، محافظة)
        $apartments = Apartment::where('name', 'like', "%$query%")
            ->orWhere('tags', 'like', "%$query%")
            ->orWhere('city', 'like', "%$query%")
            ->orWhere('governorate', 'like', "%$query%")
            ->get()
            ->map(fn($item) => $item->setAttribute('search_type', 'apartment'));

        // 2. البحث في السيارات (اسم، تاجز فقط)
        $cars = Car::where('name', 'like', "%$query%")
            ->orWhere('tags', 'like', "%$query%")
            ->get()
            ->map(fn($item) => $item->setAttribute('search_type', 'car'));

        // 3. البحث في الفنادق (اسم، تاجز، مدينة، محافظة)
        $hotels = Hotel::where('name', 'like', "%$query%")
            ->orWhere('tags', 'like', "%$query%")
            ->orWhere('city', 'like', "%$query%")
            ->orWhere('governorate', 'like', "%$query%")
            ->get()
            ->map(fn($item) => $item->setAttribute('search_type', 'hotel'));

        // 4. البحث في الخدمات (اسم، تاجز فقط - أو حسب حقولها المتوفرة)
        $services = Service::where('name', 'like', "%$query%")
            ->orWhere('tags', 'like', "%$query%")
            ->get()
            ->map(fn($item) => $item->setAttribute('search_type', 'service'));

        // دمج النتائج كلها في متغير واحد
        $searchResults = collect()
            ->merge($apartments)
            ->merge($cars)
            ->merge($hotels)
            ->merge($services);

        return view('search', compact('searchResults'));
    }
}
