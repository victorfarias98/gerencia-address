<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data): User;
    public function findByEmail(string $email): array;
    public function findById(string $userId): array;
    public function update(string $userId, array $data): bool;
    public function delete(string $userId): bool;
}
