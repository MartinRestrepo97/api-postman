<?php

namespace Tests\Feature\Api\V1;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AnimalCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_requests_are_rejected(): void
    {
        $this->getJson('/api/v1/animales')->assertStatus(401);
    }

    public function test_can_create_animal_when_authenticated(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $payload = Animal::factory()->make()->toArray();

        $response = $this->postJson('/api/v1/animales', $payload);
        $response->assertCreated()->assertJsonFragment([
            'especie' => $payload['especie'],
            'raza' => $payload['raza'],
        ]);

        $this->assertDatabaseHas('animales', [
            'especie' => $payload['especie'],
            'raza' => $payload['raza'],
        ]);
    }

    public function test_validation_errors_on_create(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson('/api/v1/animales', []);
        $response->assertStatus(422);
    }

    public function test_can_update_animal(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $animal = Animal::factory()->create();

        $response = $this->putJson('/api/v1/animales/' . $animal->id, [
            'raza' => 'Actualizada',
        ]);
        $response->assertOk()->assertJsonFragment(['raza' => 'Actualizada']);
    }

    public function test_can_delete_animal(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $animal = Animal::factory()->create();

        $this->deleteJson('/api/v1/animales/' . $animal->id)->assertNoContent();
        $this->getJson('/api/v1/animales/' . $animal->id)->assertNotFound();
    }
}


