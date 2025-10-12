<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TermsPage;
use App\Models\TermsResponsibility;

class TermsPageSeeder extends Seeder
{
    public function run(): void
    {
        if (!TermsPage::query()->exists()) {
            $page = TermsPage::factory()->create();

            $responsibilities = [
                'O usuário deve fornecer dados verdadeiros e atualizados ao entrar em contato.',
                'Não me responsabilizo por indisponibilidades temporárias por manutenção ou força maior.',
                'Reservo-me o direito de atualizar conteúdo, preços e disponibilidade sem aviso prévio.',
            ];
            foreach ($responsibilities as $i => $text) {
                TermsResponsibility::create([
                    'terms_page_id' => $page->id,
                    'text' => $text,
                    'position' => $i,
                ]);
            }
        }
    }
}

