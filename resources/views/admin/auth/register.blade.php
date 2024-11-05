@extends('layouts.app')

@section('title')
    Регистрация
@endsection

@section('content')
    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h1 class="text-3xl font-medium text-gray-800 text-center">Регистрация</h1>

            <form method="POST" action="{{ route('admin.register_process') }}" class="space-y-5 mt-3">
                @csrf

                <input name="name" id="name" type="text" class="w-full h-12 border border-gray-300 rounded px-3" placeholder="Имя" />
                <input name="login" id="login" type="text" class="w-full h-12 border border-gray-300 rounded px-3" placeholder="Логин" />
                <input name="password" type="password" class="w-full h-12 border border-gray-300 rounded px-3" placeholder="Пароль" />
                <input name="password_confirmation" type="password" class="w-full h-12 border border-gray-300 rounded px-3" placeholder="Подтвердите пароль" />

                <button type="submit" class="text-center w-full bg-gray-800 rounded-md text-white py-3 font-medium">Зарегистрироваться</button>
            </form>

            <p class="text-center mt-5 text-gray-600">
                Уже есть аккаунт?
                <a href="{{ route('admin.login') }}" class="text-blue-500 hover:underline">Войти</a>
            </p>
        </div>
    </div>
@endsection