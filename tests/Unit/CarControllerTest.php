<?php

namespace Tests\Unit\Controllers;

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_index_returns_all_cars()
    {
        Car::factory()->count(5)->create();

        $response = $this->getJson('/api/cars');

        $response->assertStatus(200)
            ->assertJsonCount(5)
            ->assertJsonStructure([
                '*' => ['id', 'brand', 'model', 'registration_date'],
            ]);
    }

    /** @test */
    public function test_destroy_deletes_car()
    {
        $car = Car::factory()->create();
        $response = $this->deleteJson("/api/cars/{$car->id}");
        $response->assertStatus(204);
        $this->assertSoftDeleted($car);
    }
}
