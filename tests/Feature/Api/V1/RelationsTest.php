<?php

namespace Tests\Feature\Api\V1;

use App\Models\Agricultor;
use App\Models\Finca;
use App\Models\Animal;
use App\Models\Vegetal;
use App\Models\Preparado;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RelationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_attach_and_detach_finca_to_agricultor(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $agricultor = Agricultor::factory()->create();
        $finca = Finca::factory()->create();

        $this->postJson('/api/v1/agricultores/' . $agricultor->id . '/fincas/' . $finca->id)
            ->assertOk();

        $this->assertDatabaseHas('agricultores_fincas', [
            'id_agricultor' => $agricultor->id,
            'id_finca' => $finca->id,
        ]);

        $this->deleteJson('/api/v1/agricultores/' . $agricultor->id . '/fincas/' . $finca->id)
            ->assertOk();

        $this->assertDatabaseMissing('agricultores_fincas', [
            'id_agricultor' => $agricultor->id,
            'id_finca' => $finca->id,
        ]);
    }

    public function test_can_attach_and_detach_animal_to_agricultor(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $agricultor = Agricultor::factory()->create();
        $animal = Animal::factory()->create();

        $this->postJson('/api/v1/agricultores/' . $agricultor->id . '/animales/' . $animal->id)
            ->assertOk();

        $this->assertDatabaseHas('agricultores_animales', [
            'id_agricultor' => $agricultor->id,
            'id_animal' => $animal->id,
        ]);

        $this->deleteJson('/api/v1/agricultores/' . $agricultor->id . '/animales/' . $animal->id)
            ->assertOk();

        $this->assertDatabaseMissing('agricultores_animales', [
            'id_agricultor' => $agricultor->id,
            'id_animal' => $animal->id,
        ]);
    }

    public function test_can_attach_and_detach_vegetal_to_agricultor(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $agricultor = Agricultor::factory()->create();
        $vegetal = Vegetal::factory()->create();

        $this->postJson('/api/v1/agricultores/' . $agricultor->id . '/vegetales/' . $vegetal->id)
            ->assertOk();

        $this->assertDatabaseHas('agricultores_vegetales', [
            'id_agricultor' => $agricultor->id,
            'id_vegetal' => $vegetal->id,
        ]);

        $this->deleteJson('/api/v1/agricultores/' . $agricultor->id . '/vegetales/' . $vegetal->id)
            ->assertOk();

        $this->assertDatabaseMissing('agricultores_vegetales', [
            'id_agricultor' => $agricultor->id,
            'id_vegetal' => $vegetal->id,
        ]);
    }

    public function test_can_attach_and_detach_preparado_to_agricultor(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $agricultor = Agricultor::factory()->create();
        $preparado = Preparado::factory()->create();

        $this->postJson('/api/v1/agricultores/' . $agricultor->id . '/preparados/' . $preparado->id)
            ->assertOk();

        $this->assertDatabaseHas('agricultores_preparados', [
            'id_agricultor' => $agricultor->id,
            'id_preparado' => $preparado->id,
        ]);

        $this->deleteJson('/api/v1/agricultores/' . $agricultor->id . '/preparados/' . $preparado->id)
            ->assertOk();

        $this->assertDatabaseMissing('agricultores_preparados', [
            'id_agricultor' => $agricultor->id,
            'id_preparado' => $preparado->id,
        ]);
    }
}


