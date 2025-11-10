<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['city','max_price','type','bedrooms','bathrooms','garages','min_area']);

        $types = PropertyType::orderBy('name')->get();

        $mostViewed = Property::with(['type','images','videos'])
            ->where('status','Disponível')
            ->orderByDesc('views')
            ->limit(8)
            ->get();

        $list = Property::with(['type','images','videos'])
            ->where('status','Disponível')
            ->when(!empty($filters['city']), fn($q)=>$q->where('city','like','%'.$filters['city'].'%'))
            ->when(!empty($filters['max_price']), fn($q)=>$q->where('price','<=',(float)$filters['max_price']))
            ->when(!empty($filters['type']), fn($q)=>$q->whereHas('type', fn($t)=>$t->where('slug',$filters['type'])->orWhere('id',$filters['type'])))
            ->when(!empty($filters['bedrooms']), fn($q)=>$q->where('bedrooms','>=',(int)$filters['bedrooms']))
            ->when(!empty($filters['bathrooms']), fn($q)=>$q->where('bathrooms','>=',(int)$filters['bathrooms']))
            ->when(!empty($filters['garages']), fn($q)=>$q->where('garages','>=',(int)$filters['garages']))
            ->when(!empty($filters['min_area']), fn($q)=>$q->where('area','>=',(int)$filters['min_area']))
            ->latest()
            ->limit(16)
            ->get();

        return view('home', compact('types','mostViewed','list','filters'));
    }
}


