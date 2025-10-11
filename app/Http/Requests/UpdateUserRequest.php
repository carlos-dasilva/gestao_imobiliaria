<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        $userId = $this->route('user')?->id ?? null;
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,'.$userId],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email,'.$userId],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'is_admin' => ['required', 'boolean'],
        ];
    }
}

