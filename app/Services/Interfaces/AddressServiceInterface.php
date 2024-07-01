<?php

namespace App\Services\Interfaces;

interface AddressServiceInterface
{
    public function create(string $userId, array $data): array;
    public function getById(string $addressId): array;
    public function getByUserId(string $userId): array;
    public function update(string $userId, string $addressId, array $data): bool;
    public function delete(string $userId, string $addressId): bool;
}
