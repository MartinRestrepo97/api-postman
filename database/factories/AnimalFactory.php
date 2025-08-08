<?php

namespace Database\Factories;

use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Animal>
 */
class AnimalFactory extends Factory
{
    protected $model = Animal::class;

    public function definition(): array
    {
        return [
            'especie' => $this->faker->randomElement(['Bovino','Porcino','Ovino','Caprino','Aviar']),
            'raza' => $this->faker->word(),
            'alimentacion' => $this->faker->sentence(8),
            'cuidados' => $this->faker->sentence(10),
            'reproduccion' => $this->faker->sentence(8),
            'observaciones' => $this->faker->optional()->sentence(6),
            'imagen' => $this->faker->imageUrl(640, 480, 'animals', true),
        ];
    }
}


