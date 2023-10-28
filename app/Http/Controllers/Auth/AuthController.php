<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Traits\ValidateAndCreateUser;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    use ValidateAndCreateUser;

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('api')->attempt($credentials)) {
            $user = Auth::guard('api')->user();
            $jwt = JWTAuth::attempt($credentials);
            $success = true;

            return compact('success', 'user', 'jwt');
        } else {
            $success = false;
            $message = "Credenciales incorrectas";
            return compact('success', 'message');
        }
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        $success = true;

        return compact('success');
    }

    public function register(Request $request){
    $this->validator($request->all())->validate();
    $user = $this->create($request->all());
    event(new Registered($user));

    $credentials = $request->only('email', 'password');
        if ($token = JWTAuth::attempt($credentials)) {
            $success = true;
        } else {
            $success = false;
        }

        return compact('success', 'user', 'token');
    }
}
