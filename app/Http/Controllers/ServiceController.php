<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::active()
            ->withTranslation()
            ->sorted($request->get('sort', 'newest'))
            ->paginate(12)
            ->withQueryString();

        return view('services.index', compact('services'));
    }

    public function show(Service $service)
    {
        abort_if(!$service->active, 404);

        $service->load('translations');

        $relatedServices = Service::active()
            ->withTranslation()
            ->where('id', '!=', $service->id)
            ->limit(4)
            ->get();

        return view('services.show', compact('service', 'relatedServices'));
    }
}
