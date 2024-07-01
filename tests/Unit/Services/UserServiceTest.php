<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\UserService;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    private UserRepositoryInterface $userRepository;
    private UserService $userService;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->userService = new UserService($this->userRepository);
    }

    public function testCreate(): void
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
        ];

        $createdUser = new User($userData);
        $createdUser->user_id = 'user-123';

        $this->userRepository->expects($this->once())
            ->method('create')
            ->with($userData)
            ->willReturn($createdUser);

        $result = $this->userService->create($userData);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($createdUser, $result);
    }

    public function testFindByEmail(): void
    {
        $email = 'john@example.com';
        $userData = [
            'user_id' => 'user-123',
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ];

        $this->userRepository->expects($this->once())
            ->method('findByEmail')
            ->with($email)
            ->willReturn($userData);

        $result = $this->userService->findByEmail($email);

        $this->assertEquals($userData, $result);
    }

    public function testFindById(): void
    {
        $userId = 'user-123';
        $userData = [
            'user_id' => 'user-123',
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ];

        $this->userRepository->expects($this->once())
            ->method('findById')
            ->with($userId)
            ->willReturn($userData);

        $result = $this->userService->findById($userId);

        $this->assertEquals($userData, $result);
    }

    public function testUpdate(): void
    {
        $userId = 'user-123';
        $updateData = [
            'name' => 'John Doe Updated',
            'email' => 'johnupdated@example.com',
        ];

        $this->userRepository->expects($this->once())
            ->method('update')
            ->with($userId, $updateData)
            ->willReturn(true);

        $result = $this->userService->update($userId, $updateData);

        $this->assertTrue($result);
    }

    public function testDelete(): void
    {
        $userId = 'user-123';

        $this->userRepository->expects($this->once())
            ->method('delete')
            ->with($userId)
            ->willReturn(true);

        $result = $this->userService->delete($userId);

        $this->assertTrue($result);
    }
}
