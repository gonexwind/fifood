<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Laravel\Fortify\Rules\Password;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'string', new Password],
            'address' => 'required|string',
            'roles' => 'required|string|max:255|in:USER,ADMIN',
            'houseNumber' =>'required|string',
            'phoneNumber' =>'required|string',
            'city' =>'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
