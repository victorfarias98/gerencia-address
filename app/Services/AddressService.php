<?php

namespace App\Services;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Interfaces\AddressServiceInterface;

readonly class AddressService implements AddressServiceInterface
{
    public function __construct(private AddressRepositoryInterface $addressRepository)
    {
    }

    public function create(string $userId, array $data): array
    {
        return $this->addressRepository->create($userId, $data);
    }

    public function getById(string $addressId): array
    {
        return $this->addressRepository->findById($addressId);
    }

    public function update(string $userId, string $addressId, array $data): bool
    {
        return $this->addressRepository->update($userId, $addressId, $data);
    }

    public function delete(string $userId, string $addressId): bool
    {
       return $this->addressRepository->delete($userId, $addressId);
    }

    public function getByUserId(string $userId): array
    {
        return $this->addressRepository->findByUserId($userId);
    }
}
