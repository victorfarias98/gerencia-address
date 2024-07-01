<?php

namespace App\Services\Interfaces;

use App\Models\User;

interface UserServiceInterface
{
    public function create(array $data): User;
    public function findById(string $userId): array;
    public function findByEmail(string $email): array;
    public function update(string $userId, array $data): bool;
    public function delete(string $userId): bool;
}
