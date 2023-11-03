<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit(){

        return Auth::guard('api')->user();
    }

    public function update(Request $request){

        $user = Auth::guard('api')->user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        JwtAuth::ClearCache($user);
    }

}
