<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrivacyPolicy;
use App\Models\PrivacyCollectedItem;
use App\Models\PrivacyPurposeItem;

class PrivacyPolicySeeder extends Seeder
{
    public function run(): void
    {
        if (!PrivacyPolicy::query()->exists()) {
            $policy = PrivacyPolicy::factory()->create();

            $col = [
                ['title' => 'Dados técnicos de navegação', 'description' => 'endereço IP, user-agent e páginas visitadas gerados automaticamente pelo servidor web para segurança, estatística agregada e melhoria do site.'],
                ['title' => 'Cookies', 'description' => 'apenas cookies essenciais ao funcionamento (ex.: sessão). Não utilizo cookies analíticos nem de marketing neste momento. Se forem ativados no futuro, exibirei um aviso de consentimento.'],
                ['title' => 'Dados de contato', 'description' => 'caso você opte por falar comigo por e-mail/telefone/WhatsApp, tratarei as informações que você enviar na mensagem (ex.: nome, telefone, preferência de imóvel) para retornar o contato.'],
            ];
            foreach ($col as $i => $it) {
                PrivacyCollectedItem::create([
                    'privacy_policy_id' => $policy->id,
                    'title' => $it['title'],
                    'description' => $it['description'],
                    'position' => $i,
                ]);
            }

            $purposes = [
                'Garantir segurança operacional do site (logs técnicos e prevenção a fraudes).',
                'Responder solicitações, retornar contato e conduzir o atendimento quando você me contatar.',
                'Propor imóveis alinhados ao seu interesse e agendar visitas.',
            ];
            foreach ($purposes as $i => $p) {
                PrivacyPurposeItem::create([
                    'privacy_policy_id' => $policy->id,
                    'text' => $p,
                    'position' => $i,
                ]);
            }
        }
    }
}

