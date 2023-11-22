<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::all();
        return $roles;
    }

    public function store(Request $request) {
        $Role = Role::create([
            'description' => $request->input('description'),
        ]);

        return response()->json(['message' => 'Rol creado con éxito'], 200);
    }

    public function edit($id){

        return Role::find($id);
    }

    public function show($id)
    {
        $role = Role::find($id);

        if ($role) {
            return response()->json($role);
        } else {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editRole($id)
    {
        $role = Role::find($id);
        return $role;
        if ($role) {
            return response()->json($role);
        } else {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateRole(Request $request, $id)
    {
        $description = $request->input('description');

        // Ejecuta una consulta SQL para actualizar los campos en la base de datos
        DB::table('roles')
            ->where('id', $id)
            ->update([
                'description' => $description
            ]);

        return response()->json(['message' => 'Rol actualizado']);
    }
}
