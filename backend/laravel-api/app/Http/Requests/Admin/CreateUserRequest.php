<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        // Reglas de validacion
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users,email',
            'role'     => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'El correo es obligatorio',
            'email.email'       => 'Debe ingresar un correo válido',
            'email.unique'      => 'El correo ingresado ya es existente',
            'email.required'    => 'El rol es obligatorio',
            'password.required' => 'La contraseña es obligatoria',
            'password.min'      => 'La contraseña Debe tener al menos 8 caracteres',
        ];
    }
}
