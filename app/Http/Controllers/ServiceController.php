<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::where('active', true);

        $services = $query->paginate(12)->withQueryString();

        return view('services.index', compact(
            'services'
        ));
    }

    public function show(Service $service)
    {
        if (!$service->active) {
            abort(404);
        }


        $relatedServices = Service::where('active', true)
            ->where('id', '!=', $service->id)
            ->limit(4)
            ->get();

        return view('services.show', compact('service', 'relatedServices'));
    }
}
