<?php

namespace Tests\Feature\Api\V1;

use App\Models\Agricultor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AgricultorCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_requests_are_rejected(): void
    {
        $this->getJson('/api/v1/agricultores')->assertStatus(401);
    }

    public function test_can_create_agricultor_when_authenticated(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $payload = Agricultor::factory()->make()->toArray();

        $response = $this->postJson('/api/v1/agricultores', $payload);
        $response->assertCreated()->assertJsonFragment([
            'documento' => $payload['documento'],
        ]);

        $this->assertDatabaseHas('agricultores', [
            'documento' => $payload['documento'],
        ]);
    }

    public function test_validation_errors_on_create(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson('/api/v1/agricultores', []);
        $response->assertStatus(422);
    }

    public function test_can_update_agricultor(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $agricultor = Agricultor::factory()->create();

        $response = $this->putJson('/api/v1/agricultores/' . $agricultor->id, [
            'telefono' => '555-000-999',
        ]);
        $response->assertOk()->assertJsonFragment(['telefono' => '555-000-999']);
    }

    public function test_can_delete_agricultor(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $agricultor = Agricultor::factory()->create();

        $this->deleteJson('/api/v1/agricultores/' . $agricultor->id)->assertNoContent();
        $this->getJson('/api/v1/agricultores/' . $agricultor->id)->assertNotFound();
    }
}


