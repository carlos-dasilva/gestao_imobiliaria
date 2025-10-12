<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutPageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->is_admin ?? false);
    }

    public function rules(): array
    {
        return [
            'who_i_am' => ['nullable','string'],
            'purpose' => ['nullable','string'],
            'how_i_work' => ['nullable','string'],
            'values' => ['nullable','array'],
            'values.*' => ['nullable','string','max:255'],
        ];
    }
}

