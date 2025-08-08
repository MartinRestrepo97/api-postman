<?php

namespace Tests\Feature\Api\V1;

use App\Models\Preparado;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PreparadoCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_requests_are_rejected(): void
    {
        $this->getJson('/api/v1/preparados')->assertStatus(401);
    }

    public function test_can_create_preparado_when_authenticated(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $payload = Preparado::factory()->make()->toArray();

        $response = $this->postJson('/api/v1/preparados', $payload);
        $response->assertCreated()->assertJsonFragment([
            'nombre' => $payload['nombre'],
        ]);

        $this->assertDatabaseHas('preparados', [
            'nombre' => $payload['nombre'],
        ]);
    }

    public function test_validation_errors_on_create(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson('/api/v1/preparados', []);
        $response->assertStatus(422);
    }

    public function test_can_update_preparado(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $preparado = Preparado::factory()->create();

        $response = $this->putJson('/api/v1/preparados/' . $preparado->id, [
            'preparacion' => 'Actualizada',
        ]);

        $response->assertOk()->assertJsonFragment(['preparacion' => 'Actualizada']);
        $this->assertDatabaseHas('preparados', [
            'id' => $preparado->id,
            'preparacion' => 'Actualizada',
        ]);
    }

    public function test_can_delete_preparado(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $preparado = Preparado::factory()->create();

        $this->deleteJson('/api/v1/preparados/' . $preparado->id)->assertNoContent();
        $this->assertDatabaseMissing('preparados', ['id' => $preparado->id]);
    }
}


