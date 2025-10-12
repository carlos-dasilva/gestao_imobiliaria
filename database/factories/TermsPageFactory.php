<?php

namespace Database\Factories;

use App\Models\TermsPage;
use Illuminate\Database\Eloquent\Factories\Factory;

class TermsPageFactory extends Factory
{
    protected $model = TermsPage::class;

    public function definition(): array
    {
        return [
            'terms_intro' => 'Ao acessar este site, você concorda com os termos abaixo. Leia atentamente.',
            'services' => 'Este site divulga imóveis e oferece atendimento prestado por uma corretora de imóveis autônoma. As informações podem ser fornecidas por proprietários e parceiros e estão sujeitas à verificação.',
            'intellectual_property' => 'Textos, logotipos, imagens e conteúdos são protegidos por direitos autorais e marcas. É vedada a reprodução sem autorização.',
            'communications' => 'Você poderá receber e-mails ou mensagens transacionais relacionadas às suas solicitações e propostas.',
            'privacy' => 'O tratamento de dados pessoais segue a Política de Privacidade.',
            'forum' => 'Fica eleito o foro da comarca de sua sede para dirimir eventuais controvérsias, com renúncia a qualquer outro.',
        ];
    }
}

