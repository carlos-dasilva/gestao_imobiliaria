<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        // Evita sobrescrever configurações já existentes
        if (!SiteSetting::query()->exists()) {
            SiteSetting::factory()->create();
        }
    }
}

