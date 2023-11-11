<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\User;

use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index(){
        return $users = User::all();
    }

    public function store(Request $request){
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make('1234556'),
            'id_role' => 1
            // Agrega otros campos de usuario si es necesario
        ]);

        if ($user->save()) {
            return response()->json(['message' => 'Usuario creado con éxito'], 200);
        } else {
            return response()->json(['message' => 'Error al crear el usuario'], 500);
        }
    }

    public function edit(){

        return Auth::guard('api')->user();
    }

    public function update(Request $request){

        $user = Auth::guard('api')->user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($user->save()) {
            $user->sendFCM("Hola {$user->name}, tus datos se han actualizado correctamente!");
        }
    }


}
