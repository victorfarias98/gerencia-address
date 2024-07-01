<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Models\Address;
use App\Models\User;
use App\Repositories\AddressRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected AddressRepository $addressRepository;
    protected array $data;

    protected function setUp(): void
    {
        parent::setUp();

        $this->addressRepository = new AddressRepository(new Address);

        $user = User::factory()->create();

        $this->data = [
            'user_id' => $user->user_id,
            'street' => 'Rua das Flores',
            'city' => 'Recife',
            'state' => 'PE',
            'country' => 'Brasil',
            'postal_code' => '50000-000',
            'number' => '123',
            'complement' => 'Apartamento 456',
        ];
    }

    public function testCreateAddress()
    {


        $address = $this->addressRepository->create($this->data['user_id'], $this->data);

        $this->assertIsArray($address);
        $this->assertEquals($this->data['street'], $address['street']);
    }

    public function testFindAddressById()
    {
        $address = Address::factory()->create($this->data);
        $foundAddress = $this->addressRepository->findById($address->address_id);

        $this->assertIsArray($foundAddress);
        $this->assertEquals($this->data['street'], $foundAddress['street']);
    }

    public function testUpdateAddress()
    {
        $address = Address::factory()->create($this->data);
        $updatedData = ['street' => 'Updated Street'];

        $updated = $this->addressRepository->update($this->data['user_id'], $address->address_id, $updatedData);

        $this->assertTrue($updated);
        $this->assertEquals('Updated Street', $address->fresh()->street);
    }

}
