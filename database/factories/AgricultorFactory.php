<?php

namespace Database\Factories;

use App\Models\Agricultor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Agricultor>
 */
class AgricultorFactory extends Factory
{
    protected $model = Agricultor::class;

    public function definition(): array
    {
        return [
            'nombres' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'telefono' => $this->faker->phoneNumber(),
            'imagen' => $this->faker->imageUrl(640, 480, 'people', true),
            'documento' => $this->faker->unique()->bothify('DOC-########'),
        ];
    }
}


