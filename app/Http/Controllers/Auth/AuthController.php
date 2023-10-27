<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // public function register(Request $request){
    //     $this->validate($request, [
    //         'email' => 'required'
    //     ]);
    // }

    // public function login(Request $request){
    //     //return 'Hola';

    //     $credentials = $request->only('email', 'password');
    //     // return 'publkico';

    //     // $credentials = request(['email', 'password']);

    //     // if (! $token = auth()->attempt($credentials)) {
    //     //     return response()->json(['error' => 'No autorizado'], 401);
    //     // }

    //     // return $this->respondWithToken($token);

    //     if(Auth::guard('api')->attemp($credentials)){
    //         $user = Auth::guard('api')->user();

    //         $jwt = JwtAuth::generateToken($user);

    //         $error = false;

    //         $data = compact('user', 'jwt');
    //         return compact('error', 'data');
    //     } else {
    //         $error = true;

    //         $message = 'Credenciales incorrectas';
    //         return compact('error', 'message');
    //     }
    // }

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



}
