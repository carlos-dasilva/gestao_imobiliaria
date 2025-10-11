<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyType;
use App\Services\PropertyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function __construct(private readonly PropertyService $service) {}

    public function index(Request $request)
    {
        $filters = $request->only(['city','max_price','type','bedrooms','bathrooms','garages','min_area']);
        $properties = $this->service->searchAdmin($filters, 20);
        $types = PropertyType::orderBy('name')->get();
        return view('admin.properties.index', compact('properties','types','filters'));
    }

    public function create()
    {
        $types = PropertyType::orderBy('name')->get();
        return view('admin.properties.create', compact('types'));
    }

    public function store(StorePropertyRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $files = $request->file('images', []);
        $this->service->create($data, $files ?? []);
        return redirect()->route('admin.properties.index')->with('success', 'Imóvel criado com sucesso.');
    }

    public function edit(Property $property)
    {
        $property->load('images');
        $types = PropertyType::orderBy('name')->get();
        return view('admin.properties.edit', compact('property','types'));
    }

    public function update(UpdatePropertyRequest $request, Property $property): RedirectResponse
    {
        $data = $request->validated();
        $files = $request->file('images', []);
        $this->service->update($property, $data, $files ?? []);
        return redirect()->route('admin.properties.edit', $property)->with('success', 'Imóvel atualizado.');
    }

    public function destroy(Property $property): RedirectResponse
    {
        $this->service->delete($property);
        return redirect()->route('admin.properties.index')->with('success', 'Imóvel removido.');
    }

    public function setCover(Property $property, PropertyImage $image): RedirectResponse
    {
        $this->service->setCover($property, $image);
        return redirect()->back()->with('success', 'Capa atualizada.');
    }

    public function deleteImage(Property $property, PropertyImage $image): RedirectResponse
    {
        $this->service->removeImage($image);
        return redirect()->back()->with('success', 'Imagem removida.');
    }
}

