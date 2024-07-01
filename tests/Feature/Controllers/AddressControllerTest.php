<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Address;
use App\Services\AddressService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use PHPUnit\Framework\MockObject\Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class AddressControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected AddressService $addressService;
    protected array $data;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user, 'api');

        $this->addressService = $this->createMock(AddressService::class);
        $this->app->instance(AddressService::class, $this->addressService);

        $this->data = [
            'user_id' => $this->user->user_id,
            'street' => 'Rua das Flores',
            'city' => 'Recife',
            'state' => 'PE',
            'country' => 'Brasil',
            'postal_code' => '50000-000',
            'number' => '123',
            'complement' => 'Apartamento 456',
        ];

    }

    public function testIndex(): void
    {
        $this->addressService
            ->expects($this->once())
            ->method('getByUserId')
            ->with($this->user->user_id)
            ->willReturn([new Address()]);

        $response = $this->getJson(route('address.index'));

        $response->assertStatus(ResponseAlias::HTTP_OK);
    }

    public function testStore(): void
    {
        $addressData = Address::factory()->make($this->data)->toArray();

        $this->addressService
            ->expects($this->once())
            ->method('create')
            ->with($this->user->user_id, $addressData)
            ->willReturn($addressData);

        $response = $this->postJson(route('address.store'), $addressData);

        $response->assertStatus(ResponseAlias::HTTP_CREATED)
            ->assertJson($addressData);
    }

    public function testShow(): void
    {
        $address = Address::factory()->create($this->data);

        $this->addressService
            ->expects($this->once())
            ->method('getById')
            ->with($address->address_id)
            ->willReturn($address->toArray());

        $response = $this->getJson(route('address.show', ['address' => $address->address_id]));

        $response->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson($address->toArray());
    }

    public function testUpdate(): void
    {
        $address = Address::factory()->create($this->data);

        $updatedData = $this->data;
        $updatedData['street'] = 'Updated Street';

        $this->addressService
            ->expects($this->once())
            ->method('update')
            ->willReturn(true);


        $response = $this->putJson(route('address.update', ['address' => $address->address_id]), $updatedData);

        $response->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson(['success' => true]);
    }

    public function testDestroy(): void
    {
        $address = Address::factory()->create($this->data);

        $this->addressService
            ->expects($this->once())
            ->method('delete')
            ->with($this->user->user_id, $address->address_id)
            ->willReturn(true);

        $response = $this->deleteJson(route('address.destroy', ['address' => $address->address_id]));

        $response->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson(['success' => true]);
    }
}
