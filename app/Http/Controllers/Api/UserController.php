<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index() {
        $users = User::orderBy('created_at', 'desc')->get();
        return $users;
    }

    public function store(Request $request) {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make('1234556'),
            'id_role' => 1
            // Agrega otros campos de usuario si es necesario
        ]);

        return response()->json(['message' => 'Usuario creado con éxito'], 200);
    }

    public function edit(){

        return Auth::guard('api')->user();
    }

    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editUser($id)
    {
        $user = User::find($id);
        return $user;
        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'Proveedor no encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateUser(Request $request, $id)
    {
        // Obtén los datos del request
        $name = $request->input('name');
        $email = $request->input('email');

        // Ejecuta una consulta SQL para actualizar los campos en la base de datos
        DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'email' => $email
            ]);

        return response()->json(['message' => 'Usuario actualizado']);
    }

    public function destroyUser($id) {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
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
