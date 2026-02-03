<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'completed' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O título da tarefa é obrigatório.',
            'completed.boolean' => 'O campo concluído deve ser verdadeiro ou falso.',
        ];
    }
}
