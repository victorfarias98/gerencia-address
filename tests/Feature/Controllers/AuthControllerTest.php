<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testRegister()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        $response = $this->postJson('/api/register', $data);
        $response->assertStatus(201)
            ->assertJsonStructure(['user', 'authorization']);
    }

    public function testLogin()
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $data = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $response = $this->postJson('/api/login', $data);

        $response->assertStatus(200)
            ->assertJsonStructure(['authorization']);
    }
}
