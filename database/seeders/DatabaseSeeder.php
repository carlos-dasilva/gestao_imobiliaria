<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin padrão (altere a senha depois!)
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrador',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );

        // Tipos de imóvel básicos
        foreach ([
            ['name' => 'Apartamento', 'slug' => 'apartamento'],
            ['name' => 'Casa', 'slug' => 'casa'],
            ['name' => 'Cobertura', 'slug' => 'cobertura'],
            ['name' => 'Studio', 'slug' => 'studio'],
        ] as $t) {
            PropertyType::updateOrCreate(['slug' => $t['slug']], $t);
        }

        // Configurações padrão (se não existir)
        $this->call(\Database\Seeders\SiteSettingSeeder::class);

        // Conteúdo padrão de Quem Somos (se não existir)
        $this->call(\Database\Seeders\AboutPageSeeder::class);

        // Política de Privacidade padrão (se não existir)
        $this->call(\Database\Seeders\PrivacyPolicySeeder::class);

        // Termos de Uso padrão (se não existir)
        $this->call(\Database\Seeders\TermsPageSeeder::class);
    }
}
