<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Permite que cualquier apueda usar esta request
        return true;
    }

    public function rules(): array
    {
        // Reglas de validacion
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'El correo es obligatorio',
            'email.email'       => 'Debe ingresar un correo válido',
            'email.unique'      => 'El correo ingresado ya es existente',
            'password.required' => 'La contraseña es obligatoria',
            'password.min'      => 'La contraseña Debe tener al menos 8 caracteres',
        ];
    }
}
