<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index() {
        $users = User::with('role')->get();
        return $users;
    }

    public function store(Request $request) {

        // Crear el usuario con el rol asociado
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'photo' =>'/avatar/incognito.png',
            'password' => bcrypt('1234556'), // Utilizar bcrypt para hashear la contraseña
            'id_role' => $request->input('id_role')
            // Agrega otros campos de usuario si es necesario
        ]);

        return response()->json(['message' => 'Usuario creado con éxito'], 200);
    }

    //Profile
    public function edit(){

        return Auth::guard('api')->user();
    }
    // end Profile

    public function updatePhoto(Request $request)
    {
        $user = Auth::guard('api')->user();

        $file = $request->file('file');

        // Limpia el nombre del usuario de espacios en blancos y símbolos
        $cleanedUserName = Str::slug($user->name);

        // Genera una URI amigable para el nombre del archivo
        $cleanedFileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

        // Construye la ruta de almacenamiento
        $storagePath = "public/profiles/{$cleanedUserName}/{$cleanedFileName}.{$file->getClientOriginalExtension()}";

        // Almacenar la foto en el directorio correcto
        $file->storeAs("profiles/{$cleanedUserName}", "{$cleanedFileName}.{$file->getClientOriginalExtension()}", 'public');

        // Actualizar el campo 'photo' en la tabla de usuarios
        $user->photo = $storagePath;
        $user->save();

        return response()->json(['message' => 'Foto de perfil actualizada'], 200);
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
        $user = User::with('role')->find($id);

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
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
        $id_role = $request->input('id_role'); // Asegúrate de tener este campo en tu formulario

        // Busca el rol por su id
        $role = Role::find($id_role);

        // Verifica si el rol existe
        if (!$role) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        // Ejecuta una consulta SQL para actualizar los campos en la base de datos
        DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'email' => $email,
                'id_role' => $role->id
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
