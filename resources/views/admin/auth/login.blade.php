@extends('layouts.app')

@section('title')
    Авторизация
@endsection

@section('content')
    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5">

            <h1 class="text-3xl font-medium text-gray-800 text-center">Вход</h1>

            <form method="POST" action="{{route('admin.login_process')}}" class="space-y-5 mt-3">
                @csrf

                <input name="login" id="login" type="text" class="w-full h-12 border border-red-500 rounded px-3" placeholder="Логин" />
                <input name ="password"  type="password" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Пароль" />
                    
                @error('error')
                    <p class="text-red-500">{{$message}}</p>
                @enderror

                <button type="submit" class="text-center w-full bg-gray-800 rounded-md text-white py-3 font-medium">Войти</button>
            </form>
            
            <p class="text-center mt-5 text-gray-600">
                Нет аккаунта?
                <a href="{{ route('admin.register') }}" class="text-blue-500 hover:underline">Регистрация</a>
            </p>
        </div>
    </div>
@endsection