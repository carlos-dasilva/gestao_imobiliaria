<?php

namespace Database\Factories;

use App\Models\PrivacyPolicy;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrivacyPolicyFactory extends Factory
{
    protected $model = PrivacyPolicy::class;

    public function definition(): array
    {
        return [
            'policy_intro' => 'Valorizo sua privacidade. Este documento descreve como trato seus dados pessoais em conformidade com a Lei Geral de Proteção de Dados (LGPD – Lei 13.709/2018). Este site não possui área de login nem formulários de cadastro; você apenas navega pelos imóveis e entra em contato se desejar.',
            'bases_legais' => 'Legítimo interesse (divulgação de imóveis e atendimento), consentimento (quando aplicável) e cumprimento de obrigações legais.',
            'compartilhamento' => 'Se necessário, dados podem ser compartilhados com parceiros diretamente envolvidos no atendimento (ex.: proprietários, correspondentes, cartórios), sempre com medidas de segurança adequadas.',
            'retencao' => 'Os dados são mantidos pelo tempo necessário ao atendimento e conforme prazos legais aplicáveis.',
            'direitos_titular' => 'Você pode solicitar confirmação de tratamento, acesso, correção, portabilidade, anonimização, eliminação e informações sobre compartilhamento pelo e-mail privacidade@gestaoimobiliaria.local.',
            'seguranca' => 'Adoto medidas técnicas e administrativas para proteger seus dados (criptografia em trânsito, controles de acesso e registros de auditoria).',
            'cookies' => 'Utilizo apenas cookies essenciais ao funcionamento. Você pode gerenciar cookies no seu navegador.',
            'atualizacoes' => 'Esta política pode ser atualizada periodicamente. A versão vigente será publicada nesta página.',
        ];
    }
}

