<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::where('active', true)->latest()->paginate(12);
        return view('offers.index', compact('offers'));
    }

    public function show(Offer $offer)
    {
        if (!$offer->active) {
            abort(404);
        }

        $relatedOffers = Offer::where('active', true)
            ->where('id', '!=', $offer->id)
            ->limit(4)
            ->get();

        return view('offers.show', compact('offer', 'relatedOffers'));
    }
}
