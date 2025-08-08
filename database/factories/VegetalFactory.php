<?php

namespace Database\Factories;

use App\Models\Vegetal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vegetal>
 */
class VegetalFactory extends Factory
{
    protected $model = Vegetal::class;

    public function definition(): array
    {
        return [
            'especie' => $this->faker->randomElement(['Tomate','Maíz','Trigo','Lechuga','Papa']),
            'cultivo' => $this->faker->word(),
            'observaciones' => $this->faker->optional()->sentence(6),
            'imagen' => $this->faker->imageUrl(640, 480, 'plants', true),
        ];
    }
}


