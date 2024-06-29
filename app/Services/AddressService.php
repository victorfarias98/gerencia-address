<?php

namespace App\Services;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\Interfaces\AddressServiceInterface;

readonly class AddressService implements AddressServiceInterface
{
    public function __construct(private AddressRepositoryInterface $addressRepository)
    {
    }

    public function create(array $data): array
    {
        $address = $this->addressRepository->create($data);

        return $address->toArray();
    }

    public function getById(string $addressId): array
    {
        return $this->addressRepository->findById($addressId);
    }

    public function update(string $addressId, array $data): bool
    {
        return $this->addressRepository->update($addressId, $data);
    }

    public function delete(string $addressId): bool
    {
       return $this->addressRepository->delete($addressId);
    }

    public function getUserId(string $userId): array
    {
        $address = $this->addressRepository->findByUserId($userId);

        return $address->toArray();
    }
}
