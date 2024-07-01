<?php

namespace App\Repositories\Interfaces;

interface AddressRepositoryInterface
{
    public function create(string $userId, array $data): array;
    public function findById(string $addressId): array;
    public function update(string $userId, string $addressId, array $data): bool;
    public function delete(string $userId, string $addressId): bool;
    public function findByUserId(string $userId): array;
}
