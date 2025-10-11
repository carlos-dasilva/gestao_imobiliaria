<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        $typeId = $this->route('type')?->id ?? null;
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:property_types,slug,'.$typeId],
            'description' => ['nullable', 'string'],
        ];
    }
}

