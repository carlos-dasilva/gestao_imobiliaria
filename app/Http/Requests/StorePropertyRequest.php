<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'property_type_id' => ['required', 'exists:property_types,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:properties,slug'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'area' => ['required', 'integer', 'min:0'],
            'bedrooms' => ['required', 'integer', 'min:0'],
            'bathrooms' => ['required', 'integer', 'min:0'],
            'garages' => ['required', 'integer', 'min:0'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'size:2'],
            'address' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:Disponível,Indisponível,Alugado,Vendido'],
            'images.*' => ['nullable', 'image', 'max:5120'],
        ];
    }
}

