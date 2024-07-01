<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected UserRepository $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepository(new User);
    }

    public function testCreateUser(): void
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ];

        $user = $this->userRepository->create($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($data['email'], $user->email);
    }

    public function testFindUserById(): void
    {
        $user = User::factory()->create();

        $foundUser = $this->userRepository->findById($user->user_id);

        $this->assertIsArray($foundUser);
        $this->assertEquals($user->name, $foundUser['name']);
        $this->assertEquals($user->email, $foundUser['email']);
    }

    public function testUpdateUser(): void
    {
        $user = User::factory()->create();
        $data = ['name' => 'Updated Name'];

        $updated = $this->userRepository->update($user->user_id, $data);

        $this->assertTrue($updated);
        $this->assertEquals('Updated Name', $user->fresh()->name);
    }

    public function testDeleteUser(): void
    {
        $user = User::factory()->create();
        $deleted = $this->userRepository->delete($user->user_id);

        $this->assertTrue($deleted);
        $this->assertNull(User::find($user->user_id));
    }
}
