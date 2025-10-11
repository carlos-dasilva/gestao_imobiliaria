<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
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
    }
}
