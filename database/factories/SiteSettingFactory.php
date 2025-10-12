<?php

namespace Database\Factories;

use App\Models\SiteSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteSettingFactory extends Factory
{
    protected $model = SiteSetting::class;

    public function definition(): array
    {
        return [
            'site_name' => 'Imobiliária Legal',
            'email' => 'contato@imobiliaria.com',
            'phone' => '51987654321',
            'creci' => '12345f',
            'facebook_url' => 'https://www.facebook.com',
            'instagram_url' => 'https://www.instagram.com',
            'linkedin_url' => 'https://www.linkedin.com',
            'youtube_url' => 'https://www.youtube.com',
            'whatsapp_url' => 'https://wa.me/5551987654321',
            'system_log_enabled' => false,
            'primary_color' => '#CA1919',
            'secondary_color' => '#D9D9D9',
            'background_color' => '#FFFFFF',
        ];
    }
}
