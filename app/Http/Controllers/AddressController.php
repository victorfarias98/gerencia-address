<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Services\Interfaces\AddressServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AddressController extends Controller
{
    public function __construct(private readonly AddressServiceInterface $addressService)
    {
    }

    public function index(): JsonResponse
    {
        try {
            $addresses = $this->addressService->getByUserId(Auth::user()->user_id);

            return response()->json($addresses, ResponseAlias::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreAddressRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        try {
            $address = $this->addressService->create(Auth::user()->user_id, $validatedData);

            return response()->json($address, ResponseAlias::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    public function show(string $addressId): JsonResponse
    {
        try {
            $address = $this->addressService->getById($addressId);

            return response()->json($address, ResponseAlias::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], ResponseAlias::HTTP_NOT_FOUND);
        }
    }

    public function update(string $addressId, UpdateAddressRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $success = $this->addressService->update(Auth::user()->user_id, $addressId, $validatedData);

            return response()->json(['success' => $success], ResponseAlias::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    public function destroy(string $addressId): JsonResponse
    {
        try {
            $success = $this->addressService->delete(Auth::user()->user_id, $addressId);
            return response()->json(['success' => $success]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
