<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view("admin.auth.login");
    }

    public function registerForm()
    {
        return view("admin.auth.register");
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "login" => ["required"],
            "password" =>  ["required"],
        ]);
        
        if(auth("admin")->attempt($data))
        {
            return redirect(route("admin.tasks.index"));
        }

        return redirect(route("admin.login"))->withErrors(["error" => "Данные введены неверно"]);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'login' => $request->input('login'),
            'password' => Hash::make($request->input('password')),
        ]);

        auth("admin")->login($user);

        return redirect(route("admin.tasks.index"));
    }

    public function logout()
    {
        auth("admin")->logout();

        return redirect(route("admin.login"));
    }
}