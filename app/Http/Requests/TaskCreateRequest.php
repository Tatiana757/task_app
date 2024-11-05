<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
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
            'start_datetime' => 'required|date|after_or_equal:today|before_or_equal:end_datetime',
            'end_datetime' => 'required|date|after_or_equal:today|after_or_equal:start_datetime',
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
            
            'start_datetime.required' => 'Необходимо указать дату и время начала задачи.',
            'start_datetime.date' => 'Дата и время начала должны быть в корректном формате.',
            'start_datetime.after_or_equal' => 'Дата и время начала не могут быть в прошедшем времени.',
            'start_datetime.before_or_equal' => 'Дата и время начала должны быть раньше или совпадать с датой и временем конца.',
            
            'end_datetime.required' => 'Необходимо указать дату и время конца задачи.',
            'end_datetime.date' => 'Дата и время конца должны быть в корректном формате.',
            'end_datetime.after_or_equal' => 'Дата и время конца должны быть позже или совпадать с датой и временем начала.',
        ];
    }
}