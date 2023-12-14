<?php

namespace App\Http\Controllers\Api\Practice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use \App\Models\Practice\Person;


class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Person::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only(['first_name', 'last_name']);

        $person = new Person();
        $person->fill($data);
        $person->save();

        return response()->json(['message' => 'Person created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function editPerson($id)
    {
        $user = Person::find($id);

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'Persona no encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePerson(Request $request, $id)
    {
        // Obtén los datos del request
        $name = $request->input('name');
        $email = $request->input('email');

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

    public function destroyPerson($id) {
        $user = Person::find($id);

        if ($user) {
            $user->delete();
            return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }
}
