<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    public function up(): void
    {
        // Garante que existam tipos básicos se o seeder não tiver sido executado
        if (DB::table('property_types')->count() === 0) {
            DB::table('property_types')->insert([
                ['name' => 'Apartamento', 'slug' => 'apartamento', 'description' => null, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Casa',        'slug' => 'casa',        'description' => null, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Cobertura',   'slug' => 'cobertura',   'description' => null, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Studio',      'slug' => 'studio',      'description' => null, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        $typeIds = DB::table('property_types')->pluck('id')->all();
        if (empty($typeIds)) {
            return; // sem tipos, não é possível criar imóveis
        }

        $cities = [
            ['city' => 'São Paulo',       'state' => 'SP'],
            ['city' => 'Rio de Janeiro',  'state' => 'RJ'],
            ['city' => 'Belo Horizonte',  'state' => 'MG'],
            ['city' => 'Curitiba',        'state' => 'PR'],
            ['city' => 'Porto Alegre',    'state' => 'RS'],
            ['city' => 'Salvador',        'state' => 'BA'],
            ['city' => 'Brasília',        'state' => 'DF'],
            ['city' => 'Fortaleza',       'state' => 'CE'],
            ['city' => 'Recife',          'state' => 'PE'],
            ['city' => 'Florianópolis',   'state' => 'SC'],
        ];

        $now = now();
        $rows = [];

        for ($i = 1; $i <= 20; $i++) {
            $typeId = $typeIds[array_rand($typeIds)];
            $place  = $cities[array_rand($cities)];

            $title = "Imóvel Exemplo {$i} em {$place['city']}";
            $slug  = Str::slug('imovel-exemplo-'.$i.'-seed');

            // Distribui status (mais 'Disponível' para testar parte pública)
            $status = 'Disponível';
            if ($i % 7 === 0) { $status = 'Indisponível'; }
            if ($i % 9 === 0) { $status = 'Alugado'; }
            if ($i % 11 === 0) { $status = 'Vendido'; }

            $rows[] = [
                'property_type_id' => $typeId,
                'title' => $title,
                'slug' => $slug,
                'description' => "Imóvel de teste gerado por migration para fins de validação do portal. Item #{$i}.",
                'price' => random_int(150000, 1500000),
                'area' => random_int(35, 280),
                'bedrooms' => random_int(1, 5),
                'bathrooms' => random_int(1, 4),
                'garages' => random_int(0, 3),
                'city' => $place['city'],
                'state' => $place['state'],
                'address' => 'Endereço de exemplo, ' . random_int(10, 999),
                'status' => $status,
                'views' => random_int(0, 1200),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('properties')->insert($rows);
    }

    public function down(): void
    {
        // Remove apenas os imóveis de exemplo
        DB::table('properties')->where('slug', 'like', 'imovel-exemplo-%-seed')->delete();
    }
};

