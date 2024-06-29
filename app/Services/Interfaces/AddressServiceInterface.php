<?php

namespace App\Services\Interfaces;

interface AddressServiceInterface
{
    public function create(array $data): array;
    public function getById(string $addressId): array;
    public function getUserId(string $userId): array;
    public function update(string $addressId, array $data): bool;
    public function delete(string $addressId): bool;
}
