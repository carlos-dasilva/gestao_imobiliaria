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
            'video_urls' => ['array'],
            'video_urls.*' => ['nullable', 'string', 'url', 'max:512', 'regex:/^https?:\\/\\/(www\\.)?(youtube\\.com|youtu\\.be)\\//i'],
        ];
    }

    public function messages(): array
    {
        return [
            'images.*.uploaded' => 'Falha no upload da imagem. Verifique o tamanho (máx. 5 MB) e tente novamente.',
            'images.*.max' => 'Cada imagem deve ter no máximo 5 MB.',
            'images.*.image' => 'Envie apenas arquivos de imagem (JPG, PNG, WEBP).',
            'video_urls.*.url' => 'Informe um link válido do YouTube.',
            'video_urls.*.regex' => 'Apenas links do YouTube são aceitos.',
        ];
    }
}
