<?php

namespace Database\Seeders;

use App\Models\AboutPage;
use App\Models\AboutValue;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        if (!AboutPage::first()) {
            $page = AboutPage::factory()->create();
            $defaults = [
                'Transparência e ética em todas as relações',
                'Foco na sua necessidade e experiência',
                'Agilidade e boa comunicação',
                'Respeito à legislação (incluindo LGPD) e boas práticas do mercado',
            ];
            foreach ($defaults as $i => $text) {
                AboutValue::create([
                    'about_page_id' => $page->id,
                    'value' => $text,
                    'position' => $i,
                ]);
            }
        }
    }
}

