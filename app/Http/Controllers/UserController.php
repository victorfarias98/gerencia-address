<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    public function __construct(private readonly UserServiceInterface $userService)
    {
    }

    public function show(): JsonResponse
    {
        try {
            $user = $this->userService->findById(Auth::user()->user_id);

            return response()->json([
                'user' => $user,
            ], ResponseAlias::HTTP_OK);
        } catch (Exception $exception){
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->create($request->validated());

            $token = Auth::login($user);

            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ], ResponseAlias::HTTP_CREATED);
        } catch (Exception $exception){
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    public function update(User $user, UpdateUserRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->update($user->user_id, $request->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully',
                'user' => $user,
            ], ResponseAlias::HTTP_OK);
        } catch (Exception $exception){
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    public function destroy(User $user): JsonResponse
    {
        try {
            $response = $this->userService->delete($user->user_id);

            if(! $response){
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not deleted, try again later',
                ], ResponseAlias::HTTP_BAD_REQUEST);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'User deleted successfully',
            ], ResponseAlias::HTTP_OK);
        } catch (Exception $exception){
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage(),
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }
}

