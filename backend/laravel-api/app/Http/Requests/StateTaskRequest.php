<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StateTaskRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'state' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'state.required' => 'El campo estado es obligatorio',
            'state.max'      => 'el campo acepta maximo 255 caracteres'
        ];
    }
}
