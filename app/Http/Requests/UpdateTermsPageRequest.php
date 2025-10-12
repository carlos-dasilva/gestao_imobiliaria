<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTermsPageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->is_admin ?? false);
    }

    public function rules(): array
    {
        return [
            'terms_intro' => ['nullable','string'],
            'services' => ['nullable','string'],
            'intellectual_property' => ['nullable','string'],
            'communications' => ['nullable','string'],
            'privacy' => ['nullable','string'],
            'forum' => ['nullable','string'],
            'responsibilities' => ['nullable','array'],
            'responsibilities.*' => ['nullable','string','max:255'],
        ];
    }
}

