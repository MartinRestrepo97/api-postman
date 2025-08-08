<?php

namespace Database\Factories;

use App\Models\Preparado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Preparado>
 */
class PreparadoFactory extends Factory
{
    protected $model = Preparado::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->words(2, true),
            'preparacion' => $this->faker->sentence(6),
            'observaciones' => $this->faker->optional()->sentence(6),
            'imagen' => $this->faker->imageUrl(640, 480, 'food', true),
        ];
    }
}


