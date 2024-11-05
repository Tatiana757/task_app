<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'status_id' => 'required|exists:task_statuses,id',
        ];
    }
    
    public function messages(): array
    {
        return [
            'title.required' => 'Необходимо заполнить заголовок.',
            'title.string' => 'Заголовок должен быть строкой.',
            'title.max' => 'Заголовок не должен превышать 50 символов.',
            
            'description.required' => 'Необходимо заполнить описание.',
            'description.string' => 'Описание должно быть строкой.',
            'description.max' => 'Описание не должен превышать 255 символов.',
            
            'status_id.required' => 'Необходимо указать статус задачи.',
            'status_id.exists' => 'Указанный статус задачи не существует.',
        ];
    }
}