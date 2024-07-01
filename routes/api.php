<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
    Route::resource('user', UserController::class)->except('create', 'edit');
    Route::resource('address', AddressController::class)->except('create', 'edit');
});
