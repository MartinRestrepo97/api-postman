<?php

namespace Tests\Feature\Api\V1;

use App\Models\User;
use App\Models\Vegetal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class VegetalCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_requests_are_rejected(): void
    {
        $this->getJson('/api/v1/vegetales')->assertStatus(401);
    }

    public function test_can_create_vegetal_when_authenticated(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $payload = Vegetal::factory()->make()->toArray();

        $response = $this->postJson('/api/v1/vegetales', $payload);
        $response->assertCreated()->assertJsonFragment([
            'especie' => $payload['especie'],
            'cultivo' => $payload['cultivo'],
        ]);

        $this->assertDatabaseHas('vegetales', [
            'especie' => $payload['especie'],
            'cultivo' => $payload['cultivo'],
        ]);
    }

    public function test_validation_errors_on_create(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson('/api/v1/vegetales', []);
        $response->assertStatus(422);
    }

    public function test_can_update_vegetal(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $vegetal = Vegetal::factory()->create();

        $response = $this->putJson('/api/v1/vegetales/' . $vegetal->id, [
            'cultivo' => 'Actualizado',
        ]);
        $response->assertOk()->assertJsonFragment(['cultivo' => 'Actualizado']);
    }

    public function test_can_delete_vegetal(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $vegetal = Vegetal::factory()->create();

        $this->deleteJson('/api/v1/vegetales/' . $vegetal->id)->assertNoContent();
        $this->getJson('/api/v1/vegetales/' . $vegetal->id)->assertNotFound();
    }
}


