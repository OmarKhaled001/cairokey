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
            ->take(3);

        // Offers
        $offers = Offer::latest()->take(3)->get();

        // Latest Sections
        $services = Service::latest()->take(3)->get();
        $apartments = Apartment::latest()->take(3)->get();
        $cars = Car::latest()->take(3)->get();
        $hotels = Hotel::latest()->take(3)->get();

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

        $apartments = Apartment::where('name', 'like', "%$query%")
            ->orWhere('tags', 'like', "%$query%")
            ->orWhere('city', 'like', "%$query%")
            ->get()
            ->map(fn($item) => $item->setAttribute('search_type', 'apartment'));

        $cars = Car::where('name', 'like', "%$query%")
            ->orWhere('tags', 'like', "%$query%")
            ->get()
            ->map(fn($item) => $item->setAttribute('search_type', 'car'));

        $hotels = Hotel::where('name', 'like', "%$query%")
            ->orWhere('tags', 'like', "%$query%")
            ->orWhere('city', 'like', "%$query%")
            ->get()
            ->map(fn($item) => $item->setAttribute('search_type', 'hotel'));

        $services = Service::where('name', 'like', "%$query%")
            ->orWhere('tags', 'like', "%$query%")
            ->get()
            ->map(fn($item) => $item->setAttribute('search_type', 'service'));

        $searchResults = collect()
            ->merge($apartments)
            ->merge($cars)
            ->merge($hotels)
            ->merge($services);

        return view('search', compact('searchResults'));
    }
}
