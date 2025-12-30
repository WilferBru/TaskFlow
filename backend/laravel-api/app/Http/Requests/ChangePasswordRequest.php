<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required'], // contraseña actual
            'password'         => ['required', 'string', 'min:8', 'confirmed'], // contraseñs nuevas
        ];
    }

    public function messages(): array
    {
        return [
            'password.required'  => 'La contraseña es obligatoria',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'current_password'   => 'La contraseña es obligatoria',
        ];
    }
}
