<?php

namespace Database\Factories;

use App\Models\AboutPage;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutPageFactory extends Factory
{
    protected $model = AboutPage::class;

    public function definition(): array
    {
        return [
            'who_i_am' => 'Corretor de imóveis autônomo, focado em atender de forma humana e consultiva quem busca comprar, vender ou alugar um imóvel. Meu compromisso é oferecer informações claras, transparência em cada etapa e agilidade no atendimento.',
            'purpose' => 'Guiar você com segurança e serenidade na jornada do seu imóvel, do primeiro contato ao fechamento.',
            'how_i_work' => 'Atendimento personalizado, curadoria de imóveis alinhados ao seu perfil, agendamento de visitas e suporte na negociação e documentação.',
        ];
    }
}
