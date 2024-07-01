<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

readonly class UserRepository implements UserRepositoryInterface
{
    public function __construct(private User $userModel)
    {
    }

    public function create(array $data): User
    {
        return $this->userModel->create($data);
    }

    public function findByEmail(string $email): array
    {
        $user = $this->userModel->where('email', $email);

        if (! $user) {
            return [];
        }

        return $user->toArray();
    }

    public function findById(string $userId): array
    {
        $user = $this->userModel->find($userId);

        if (! $user) {
            return [];
        }

        return $user->toArray();
    }

    public function update(string $userId, array $data): bool
    {
        $user = $this->userModel->find($userId);

        if (! $user) {
            return false;
        }

        return $user->update($data);
    }

    public function delete(string $userId): bool
    {
        $user = $this->userModel->find($userId);

        if (! $user) {
            return false;
        }

        return $user->delete();
    }
}
