<?php

namespace App\Repositories;

use App\Models\Address;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

readonly class AddressRepository implements AddressRepositoryInterface
{
    public function __construct(private Address $addressModel)
    {
    }

    public function create(array $data): Address
    {
        return $this->addressModel->create($data);
    }

    public function findById(string $addressId): array
    {
        $address = $this->addressModel->find($addressId);

        if (! $address) {
            return [];
        }

        return $address->toArray();
    }

    public function update(string $addressId, array $data): bool
    {
        return $this->addressModel->find($addressId)->update($data);
    }

    public function delete(string $addressId): bool
    {
       return $this->addressModel->find($addressId)->delete();
    }

    public function findByUserId(string $userId): Collection|array
    {
        return $this->addressModel->where('user_id', $userId)->get();
    }
}
