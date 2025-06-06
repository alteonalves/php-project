<?php

namespace Tests\Feature;

use App\Models\Vehicles;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testando a criação de um veículo com successo.
     */
    public function test_create_vehicle_success(): void
    {
        $response = $this->postJson('/api/vehicles', [
            'brand' => 'Chevrolet',
            'vehicle' => 'Astra',
            'year' => 2010,
            'sold' => false,

        ]);

        $response->assertStatus(200);
    }


    /**
     * Testando a criação de um veículo com error.
     */
    public function test_create_vehicle_error(): void
    {
        $response = $this->postJson('/api/vehicles', [
            'vehicle' => 'Astra',
            'year' => 2010,

        ]);

        $response->assertStatus(422);
    }

    /**
     * Testando a atualização de um veículo com successo.
     */
    public function test_update_full_vehicle_success(): void
    {
        // Arrange: cria um registro fake no banco
        $vehicle = Vehicles::factory()->create([
            'vehicle' => 'Hilux',
            'brand' => 'Toyota',
            'year' => 2022,
            'sold' => true

        ]);
        $response = $this->putJson("/api/vehicles/{$vehicle->id}", [
            'vehicle' => 'Ranger',
            'brand' => 'Ford',
            'year' => 2022,
            'sold' => true
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('vehicles', [
                'id' => $vehicle->id,
                'vehicle' => 'Ranger',
                'brand' => 'Ford',
            ]);
    }

    /**
     * Testando a atualização de um veículo com erro.
     */
    public function test_update_full_vehicle_error(): void
    {

        // Arrange: cria um registro fake no banco
        $vehicle = Vehicles::factory()->create([
            'vehicle' => 'Hilux',
            'brand' => 'Toyota',
            'year' => 2022,
            'sold' => true
        ]);
        $response = $this->putJson("/api/vehicles/{$vehicle->id}", [
            'vehicle' => 'Ranger',
            'year' => 2024,
            'brand' => 'FORD',

        ]);

        $response->assertStatus(422);
    }

    /**
     * Testando a deleção de um veículo.
     */
    public function test_delete_success(): void
    {
        // Arrange: cria um registro fake no banco
        $vehicle = Vehicles::factory()->create();
        $response = $this->deleteJson("/api/vehicles/{$vehicle->id}");

        $response->assertNoContent();
    }

    /**
     * Testando a deleção de um veículo inexistente.
     */
    public function test_delete_error(): void
    {
        // Arrange: cria um registro fake no banco
        $vehicle = Vehicles::factory()->create();
        $response = $this->deleteJson("/api/vehicles/1000");

        $response->assertNotFound();
    }

    public function test_it_can_list_vehicles(): void
    {
        Vehicles::factory()->count(3)->create();

        $response = $this->getJson('/api/vehicles');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_it_can_filter_vehicles_by_brand(): void
    {
        Vehicles::factory()->create(['brand' => 'Toyota']);
        Vehicles::factory()->create(['brand' => 'Ford']);

        $response = $this->getJson('/api/vehicles?brand=Toyota');

        $response->assertStatus(200);
    }

    public function test_it_can_create_a_vehicle(): void
    {
        $data = [
            'vehicle' => 'Corolla',
            'brand' => 'Toyota',
            'year' => 2022,
            'sold' => true
        ];

        $response = $this->postJson('/api/vehicles', $data);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'veiculo criado com sucesso']);

        $this->assertDatabaseHas('vehicles', $data);
    }

    public function test_it_validates_on_create(): void
    {
        $response = $this->postJson('/api/vehicles', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['vehicle', 'brand', 'year']);
    }

    public function test_it_can_update_a_vehicle(): void
    {
        $vehicle = Vehicles::factory()->create();

        $data = [
            'vehicle' => 'Ranger',
            'brand' => 'Ford',
            'year' => 2024,
        ];

        $response = $this->putJson("/api/vehicles/{$vehicle->id}", $data);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'veiculo atualizado com sucesso']);

        $this->assertDatabaseHas('vehicles', array_merge(['id' => $vehicle->id], $data));
    }

    public function test_it_returns_404_when_updating_nonexistent_vehicle(): void
    {
        $data = [
            'vehicle' => 'Ranger',
            'brand' => 'Ford',
            'year' => 2024,
        ];

        $response = $this->putJson('/api/vehicles/999', $data);

        $response->assertStatus(404);
    }

    public function test_it_can_delete_a_vehicle(): void
    {
        $vehicle = Vehicles::factory()->create();

        $response = $this->deleteJson("/api/vehicles/{$vehicle->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('vehicles', ['id' => $vehicle->id]);
    }

    public function test_it_returns_404_when_deleting_nonexistent_vehicle(): void
    {
        $response = $this->deleteJson('/api/vehicles/999');

        $response->assertStatus(404);
    }
}
