<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email',
            'password' => 'nullable|string|min:8',
            'password_salt' => 'nullable|string|max:255',
        ];
    }
}
