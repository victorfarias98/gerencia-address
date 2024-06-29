<?php

namespace App\Repositories\Interfaces;

use App\Models\Address;

interface AddressRepositoryInterface
{
    public function create(array $data): Address;
    public function findById(string $addressId): array;
    public function update(string $addressId, array $data): bool;
    public function delete(string $addressId): bool;
    public function findByUserId(string $userId);
}
