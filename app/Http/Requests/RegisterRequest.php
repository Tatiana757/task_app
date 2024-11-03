<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:20',
            'login' => 'required|string|unique:users,login|max:15',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
    
    public function messages(): array
    {
        return [
            'name.required' => 'Имя обязательно для заполнения.',
            'name.string' => 'Имя должно быть строкой.',
            'name.max' => 'Имя не должно превышать 20 символов.',

            'login.required' => 'Логин обязателен для заполнения.',
            'login.string' => 'Логин должен быть строкой.',
            'login.unique' => 'Этот логин уже занят.',
            'login.max' => 'Логин не должен превышать 15 символов.',

            'password.required' => 'Пароль обязателен для заполнения.',
            'password.string' => 'Пароль должен быть строкой.',
            'password.min' => 'Пароль должен быть не менее 8 символов.',
            'password.confirmed' => 'Пароли не совпадают.',
        ];
    }
}
