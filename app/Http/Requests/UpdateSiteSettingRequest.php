<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->is_admin ?? false);
    }

    public function rules(): array
    {
        return [
            'site_name' => ['nullable','string','max:35'],
            'email' => ['nullable','email','max:255'],
            'phone' => ['nullable','string','max:50'],
            'facebook_url' => ['nullable','url','max:255'],
            'instagram_url' => ['nullable','url','max:255'],
            'linkedin_url' => ['nullable','url','max:255'],
            'youtube_url' => ['nullable','url','max:255'],
            'whatsapp_url' => ['nullable','url','max:255'],
            'system_log_enabled' => ['sometimes','boolean'],
        ];
    }
}
