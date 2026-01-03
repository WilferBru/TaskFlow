<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'state_id'    => 'required|exists:state_tasks,id_state',
            'category_id' => 'required|exists:categories,id_category',
            'title'       => 'required|string|max:255',
            'priority'    => 'in:alta,media,baja',
            'description' => 'nullable|string',
            'metadata'    => 'nullable|array|max:10',
            'metadata.*'  => 'nullable|string|max:255',
            'due_date'    => 'nullable|date|after_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'state_id.required'       => 'El estado es obligatorio.',
            'category_id.required'    => 'La categoría es obligatoria.',
            'title.required'          => 'El título de la tarea es obligatorio.',
            'priority.in'             => 'La prioridad debe ser alta, media o baja.',
            'metadata.array'          => 'El campo metadata debe ser un arreglo.',
            'metadata.max'            => 'No puedes agregar más de 10 atributos en metadata.',
            'due_date.after_or_equal' => 'La fecha de vencimiento no puede ser anterior a hoy.',
        ];
    }
}
