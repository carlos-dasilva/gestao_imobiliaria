<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyType;
use App\Services\PropertyService;
use Illuminate\Http\Request;

class PropertyPublicController extends Controller
{
    public function __construct(private readonly PropertyService $service) {}

    public function index(Request $request)
    {
        $filters = $request->only(['city','max_price','type','bedrooms','bathrooms','garages','min_area']);
        $types = PropertyType::orderBy('name')->get();
        $properties = $this->service->searchPublic($filters, 16);
        return view('properties.index', compact('properties','types','filters'));
    }

    public function show(string $slug)
    {
        $property = Property::with(['type','images','videos'])
            ->where('slug', $slug)
            ->where('status','Disponível')
            ->firstOrFail();

        $this->service->incrementViews($property);

        return view('properties.show', compact('property'));
    }
}
