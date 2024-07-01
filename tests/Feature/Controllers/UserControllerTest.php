<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery;
use PHPUnit\Framework\MockObject\Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        $this->user = User::factory()->create($this->userData);
        $this->actingAs($this->user, 'api');

        $this->userService = $this->createMock(UserServiceInterface::class);
        $this->app->instance(UserServiceInterface::class, $this->userService);

    }

    public function testShow(): void
    {
        $this->userService->expects($this->once())
            ->method('findById')
            ->with($this->user->user_id)
            ->willReturn($this->user->toArray());

        $response = $this->getJson('/api/user/show');

        $response->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson(['user' => $this->user->toArray()]);
    }

    public function testStore(): void
    {
        $this->userService->expects($this->once())
            ->method('create')
            ->with([])
            ->willReturn($this->user);

        $response = $this->postJson('/api/user', $this->user->toArray());

        $response->assertStatus(ResponseAlias::HTTP_CREATED)->assertJson(['user' => $this->user->toArray()]);
    }

    public function testUpdate(): void
    {
        $updatedData = [
            'name' => 'João Doe',
        ];

        $this->userService->expects($this->once())
            ->method('update')
            ->with($this->user->user_id, $updatedData)
            ->willReturn(true);

        $response = $this->putJson(route('user.update', ['user' => $this->user->user_id]), $updatedData);

        $response->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson([
                'status' => 'success',
                'message' => 'User updated successfully',
                'user' => true
            ]);
    }

    public function testDestroy(): void
    {
        $this->userService->expects($this->once())
            ->method('delete')
            ->with($this->user->user_id)
            ->willReturn(true);

        $response = $this->deleteJson(route('user.destroy', ['user' => $this->user->user_id]));

        $response->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson([
                'status' => 'success',
                'message' => 'User deleted successfully',
            ]);
    }
}
