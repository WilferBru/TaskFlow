<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterTaskRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'nullable|string',
            'state_id'    => 'nullable|string',
            'priority'    => 'nullable|string',
            'keyword'     => 'nullable|string',
        ];
    }
}
