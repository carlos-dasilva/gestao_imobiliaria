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
            'creci' => ['nullable','string','max:50'],
            'logo' => ['nullable','mimes:png,jpg,jpeg,svg,webp','max:4096'],
            'favicon' => ['nullable','mimes:ico,png,svg','max:1024'],
            'facebook_url' => ['nullable','url','max:255'],
            'instagram_url' => ['nullable','url','max:255'],
            'linkedin_url' => ['nullable','url','max:255'],
            'youtube_url' => ['nullable','url','max:255'],
            'whatsapp_url' => ['nullable','url','max:255'],
            'system_log_enabled' => ['sometimes','boolean'],
        ];
    }
}
