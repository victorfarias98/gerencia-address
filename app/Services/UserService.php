<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Models\User;

readonly class UserService implements UserServiceInterface
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function create(array $data): User
    {
        return $this->userRepository->create($data);
    }

    public function findByEmail(string $email): array
    {
        return $this->userRepository->findByEmail($email);
    }

    public function findById(string $userId): array
    {
        return $this->userRepository->findById($userId);
    }

    public function update(string $userId, array $data): bool
    {
        return $this->userRepository->update($userId, $data);
    }

    public function delete(string $userId): bool
    {
        return $this->userRepository->delete($userId);
    }
}
