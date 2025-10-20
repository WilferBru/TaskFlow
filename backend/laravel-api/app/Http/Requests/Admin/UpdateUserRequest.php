<?php

namespace App\Http\Requests\Admin;

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
            'name' => 'sometimes|string|max:255',
            'role' => 'sometimes|string|in:admin,user'
        ];
    }

    public function messages(): array
    {
        return [
            'role' => 'El rol solo debe ser user o admin'
        ];
    }
}
