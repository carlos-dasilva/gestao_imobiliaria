<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrivacyPolicyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->is_admin ?? false);
    }

    public function rules(): array
    {
        return [
            'policy_intro' => ['nullable','string'],
            'bases_legais' => ['nullable','string'],
            'compartilhamento' => ['nullable','string'],
            'retencao' => ['nullable','string'],
            'direitos_titular' => ['nullable','string'],
            'seguranca' => ['nullable','string'],
            'cookies' => ['nullable','string'],
            'atualizacoes' => ['nullable','string'],
            'col_titles' => ['nullable','array'],
            'col_descriptions' => ['nullable','array'],
            'purposes' => ['nullable','array'],
            'col_titles.*' => ['nullable','string','max:120'],
            'col_descriptions.*' => ['nullable','string'],
            'purposes.*' => ['nullable','string','max:255'],
        ];
    }
}

