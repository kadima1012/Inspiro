<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'user_first_name' => 'required|string|max:255',
            'user_last_name' => 'required|string|max:255',
            'user_username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'user_birthdate' => 'required|date',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,editor,user,artist',
        ];
    }
}
