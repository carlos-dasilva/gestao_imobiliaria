<?php

namespace Database\Factories;

use App\Models\AboutValue;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutValueFactory extends Factory
{
    protected $model = AboutValue::class;

    public function definition(): array
    {
        return [
            'value' => $this->faker->sentence(6),
            'position' => 0,
        ];
    }
}

