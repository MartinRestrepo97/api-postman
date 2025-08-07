<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_api_agricultores_index_returns_json(): void
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user, 'sanctum');
        $response = $this->get('/api/v1/agricultores');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
    }

    public function test_api_agricultores_store_creates_agricultor(): void
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user, 'sanctum');
        $payload = [
            'nombres' => 'Test',
            'apellidos' => 'User',
            'telefono' => '123456789',
            'imagen' => 'test.jpg',
            'documento' => uniqid('doc_'),
        ];
        $response = $this->postJson('/api/v1/agricultores', $payload);
        $response->assertStatus(201);
        $response->assertJsonFragment([
            'nombres' => 'Test',
            'apellidos' => 'User',
            'telefono' => '123456789',
            'imagen' => 'test.jpg',
        ]);
    }
    public function test_api_agricultores_store_validation_error(): void
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user, 'sanctum');
        $response = $this->postJson('/api/v1/agricultores', []);
        $response->assertStatus(422);
        $response->assertJsonStructure(['errors']);
    }
}
