<?php

namespace Tests\Unit\Controllers;

use App\Models\Car;
use App\Models\Voiture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_show_cars(): void
    {
        $voiture = Voiture::create([
            'marque' => 'marque',
            'modele' => 'modele',
            'annee' => 2023,
            'kilometrage' => 10000,
            'prix' => 20000,
            'puissance' => 150,
            'motorisation' => 'Essence',
            'carburant' => 'Essence',
            'options' => 'options',
        ]);

        $response = $this->getJson('/api/cars');
        $response->assertStatus(Response::HTTP_OK);
        $cars = Voiture::all();
        $this->assertNotEmpty($cars);
    }

    /** @test */
    public function testEstimationPrix()
    {
        $data = [
            'marque' => 'Toyota',
            'modele' => 'Corolla',
            'kilometrage' => 100000,
            'date_mise_en_circulation' => '2018-01-01',
            'puissance' => 150,
            'carburant' => 'Essence',
            'motorisation' => 'Automatique',
            'options' => 'Climatisation, GPS',
        ];

        $response = $this->json('POST', '/api/estimatePrix', $data);

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonStructure(['prix_estime']);

       
        $response->assertJson(['prix_estime' => $response->json('prix_estime')]);
    }
}
