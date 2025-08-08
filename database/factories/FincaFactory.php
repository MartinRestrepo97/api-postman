<?php

namespace Database\Factories;

use App\Models\Finca;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Finca>
 */
class FincaFactory extends Factory
{
    protected $model = Finca::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company(),
            'ubicacion' => $this->faker->city(),
            'propietario' => $this->faker->name(),
            'imagen' => $this->faker->imageUrl(640, 480, 'nature', true),
        ];
    }
}


