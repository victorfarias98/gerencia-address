<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Services\AddressService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function __construct(private readonly AddressService $addressService)
    {
    }

    public function index(): JsonResponse
    {
        try {
            $addresses = $this->addressService->getUserId(Auth::user()->user_id);

            return response()->json($addresses);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreAddressRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        try {
            $address = $this->addressService->create($validatedData);
            return response()->json($address, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show(string $addressId): JsonResponse
    {
        try {
            $address = $this->addressService->getById($addressId);
            return response()->json($address);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function update(string $addressId, UpdateAddressRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        try {
            $success = $this->addressService->update($addressId, $validatedData);
            return response()->json(['success' => $success]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function destroy(string $addressId): JsonResponse
    {
        try {
            $success = $this->addressService->delete($addressId);
            return response()->json(['success' => $success]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
