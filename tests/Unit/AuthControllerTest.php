<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function invalid_user()
    {
        $controller = new AuthController();
        $request = new Request([
            'email' => 'invalid@gmail.com',
            'password' => 'aaaaa',
        ]);

        $response = $controller->login($request);

        $response->assertJson(['error' => 'Invalid credentials']);
        $response->assertStatus(401);
    }
    public function test_login_with_invalid_password(){
        $controller = new AuthController();
        $request = new Request([
            'email' => 'aicha@gmail.com',
            'password' => 'hola',
        ]);

        $response = $controller->login($request);

        $response->assertJson(['error' => 'Invalid credentials']);
        $response->assertStatus(401);
    }




}
