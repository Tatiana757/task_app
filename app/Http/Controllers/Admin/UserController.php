<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy("id","ASC")->paginate(20);

        return view("admin.user.index",[
            "users" => $users,
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        
        return redirect(route("admin.users.index"));
    }
}