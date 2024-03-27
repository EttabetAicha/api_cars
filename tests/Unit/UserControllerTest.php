<?php

namespace Tests\Unit\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'roles' => 'user',
        ]);

        $response->assertStatus(200);
        $this->assertCount(1, User::all());
    }

    public function test_update_user()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        $response = $this->putJson('/api/users/' . $user->id, [
            "name" => "Test2 User",
            'email' => 'updated' . $user->id . '@example.com',
            'password' => 'password',
            'roles' => 'user',
        ]);
        $response->assertStatus(200);
        $user->refresh();
        $this->assertEquals("Test2 User", $user->name);
    }


    public function test_delete_user(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response = $this->deleteJson('/api/users/' . $user->id);

        $response->assertStatus(200);
        $this->assertEmpty(User::find($user->id));
    }



}
