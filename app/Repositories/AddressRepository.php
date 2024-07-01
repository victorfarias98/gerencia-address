<?php

namespace App\Repositories;

use App\Models\Address;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use Illuminate\Support\Facades\Auth;

readonly class AddressRepository implements AddressRepositoryInterface
{
    public function __construct(private Address $addressModel)
    {
    }

    public function create(string $userId, array $data): array
    {
        if ($userId = '') {
            return [];
        }

        $data['user_id'] = $userId;

        return $this->addressModel->create($data)->toArray();
    }

    public function findById(string $addressId): array
    {
        $address = $this->addressModel->find($addressId);

        if (! $address) {
            return [];
        }

        return $address->toArray();
    }

    public function update(string $userId, string $addressId, array $data): bool
    {
        $address = $this->addressModel->find($addressId);

        if (! $address) {
            return false;
        }

        return $address->update($data);
    }

    public function delete(string $userId, string $addressId): bool
    {
        $address = $this->addressModel->find($addressId);

        if (! $address) {
            return false;
        }

       return $address->delete();
    }

    public function findByUserId(string $userId): array
    {
        $address = $this->addressModel->where('user_id', $userId)->get();

        if (! $address){
            return [];
        }

        return $address->toArray();
    }
}
