<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyTypeRequest;
use App\Http\Requests\UpdatePropertyTypeRequest;
use App\Models\PropertyType;
use App\Services\PropertyTypeService;
use Illuminate\Http\RedirectResponse;

class PropertyTypeController extends Controller
{
    public function __construct(private readonly PropertyTypeService $service) {}

    public function index()
    {
        $types = PropertyType::orderBy('name')->paginate(20);
        return view('admin.types.index', compact('types'));
    }

    public function create()
    {
        return view('admin.types.create');
    }

    public function store(StorePropertyTypeRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());
        return redirect()->route('admin.types.index')->with('success','Tipo criado com sucesso.');
    }

    public function edit(PropertyType $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    public function update(UpdatePropertyTypeRequest $request, PropertyType $type): RedirectResponse
    {
        $this->service->update($type, $request->validated());
        return redirect()->route('admin.types.index')->with('success','Tipo atualizado.');
    }

    public function destroy(PropertyType $type): RedirectResponse
    {
        $this->service->delete($type);
        return redirect()->route('admin.types.index')->with('success','Tipo removido.');
    }
}

