<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try{
            $creditials = $request->only(['login', 'password']);
            if (!$token = auth('api')->attempt($creditials)) {
                return response()->json(null, 401);
            }
            
            return (new UserResource(auth('api')->user(), $token))->response()->setStatusCode(200);
        }catch(\Exception $error){
            return response()->json(null, 500);
        }
    }

    public function logout()
    {
        try{
            auth('api')->logout();

            return response()->json(null, 200);
        }catch(\Exception $error){
            return response()->json(null, 500);
        }
    }
}