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
        $featuredItems = collect()
            ->merge(Service::where('featured', true)->latest()->take(6)->get())
            ->merge(Apartment::where('featured', true)->latest()->take(6)->get())
            ->merge(Car::where('featured', true)->latest()->take(6)->get())
            ->merge(Hotel::where('featured', true)->latest()->take(6)->get())
            ->take(6);

        $offers = Offer::latest()->take(6)->get();

        $apartments = Apartment::latest()->take(6)->get();

        $cars = Car::latest()->take(6)->get();

        $hotels = Hotel::latest()->take(6)->get();

        return view('home', compact(
            'featuredItems',
            'offers',
            'apartments',
            'cars',
            'hotels'
        ));
    }
}
