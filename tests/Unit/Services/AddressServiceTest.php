<?php

namespace Tests\Unit\Services;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Services\AddressService;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class AddressServiceTest extends TestCase
{
    private AddressRepositoryInterface $addressRepository;
    private AddressService $addressService;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->addressRepository = $this->createMock(AddressRepositoryInterface::class);
        $this->addressService = new AddressService($this->addressRepository);
    }

    public function testCreate(): void
    {
        $userId = 'user-123';
        $addressData = ['street' => '123 Main St'];
        $createdAddress = ['id' => 'address-123', 'street' => '123 Main St'];

        $this->addressRepository->expects($this->once())
            ->method('create')
            ->with($userId, $addressData)
            ->willReturn($createdAddress);

        $result = $this->addressService->create($userId, $addressData);

        $this->assertEquals($createdAddress, $result);
    }

    public function testGetById(): void
    {
        $addressId = 'address-123';
        $addressData = ['id' => 'address-123', 'street' => '123 Main St'];

        $this->addressRepository->expects($this->once())
            ->method('findById')
            ->with($addressId)
            ->willReturn($addressData);

        $result = $this->addressService->getById($addressId);

        $this->assertEquals($addressData, $result);
    }

    public function testUpdate(): void
    {
        $userId = 'user-123';
        $addressId = 'address-123';
        $addressData = ['street' => '456 Main St'];

        $this->addressRepository->expects($this->once())
            ->method('update')
            ->with($userId, $addressId, $addressData)
            ->willReturn(true);

        $result = $this->addressService->update($userId, $addressId, $addressData);

        $this->assertTrue($result);
    }

    public function testDelete(): void
    {
        $userId = 'user-123';
        $addressId = 'address-123';

        $this->addressRepository->expects($this->once())
            ->method('delete')
            ->with($userId, $addressId)
            ->willReturn(true);

        $result = $this->addressService->delete($userId, $addressId);

        $this->assertTrue($result);
    }

    public function testGetByUserId(): void
    {
        $userId = 'user-123';
        $addressData = [
            ['id' => 'address-123', 'street' => '123 Main St'],
            ['id' => 'address-456', 'street' => '456 Main St']
        ];

        $this->addressRepository->expects($this->once())
            ->method('findByUserId')
            ->with($userId)
            ->willReturn($addressData);

        $result = $this->addressService->getByUserId($userId);

        $this->assertEquals($addressData, $result);
    }
}
