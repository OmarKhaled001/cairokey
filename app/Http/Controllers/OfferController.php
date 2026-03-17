<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $offers = Offer::available()
            ->withTranslation()
            ->sorted($request->get('sort', 'newest'))
            ->paginate(12)
            ->withQueryString();

        return view('offers.index', compact('offers'));
    }

    public function show(Offer $offer)
    {
        abort_if(!$offer->isActive(), 404);

        $offer->load('translations');

        $relatedOffers = Offer::available()
            ->withTranslation()
            ->where('id', '!=', $offer->id)
            ->limit(4)
            ->get();

        return view('offers.show', compact('offer', 'relatedOffers'));
    }
}
