<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Berikan nama!',
            'name.min' => 'Nama minimal 3 karakter!',
            'email.required' => 'Berikan email!',
            'email.email' => 'Email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.required' => 'Berikan password!',
            'password.min' => 'Password minimal 8 karakter!',
            'password.confirmed' => 'Password tidak sama!',
        ];
    }
}
