<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    use InteractsWithDatabase;

    /** @test */
    public function test_add()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
        ];

        $controller = new UserController();
        $request = new Request($userData);

        $response = $controller->store($request);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    /** @test */
    public function test_display()
    {
        $user = User::factory()->create();

        $controller = new UserController();
        $response = $controller->show($user->id);

        $response->assertJson($user->toArray());
    }

    /** @test */
    public function test_update()
    {
        $user = User::factory()->create();
        $userData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'password' => 'newpassword',
        ];

        $controller = new UserController();
        $request = new Request($userData);

        $response = $controller->update($request, $user->id);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['email' => 'updated@example.com']);
    }

    /** @test */
    public function test_delete()
    {
        $user = User::factory()->create();

        $controller = new UserController();
        $response = $controller->destroy($user->id);
        $response->assertStatus(204);
        $this->assertSoftDeleted($user);    }
}
