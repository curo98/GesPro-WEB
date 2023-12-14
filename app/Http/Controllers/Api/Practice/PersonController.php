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
        $person = Person::find($id);

        if (!$person) {
            return response()->json(['error' => 'Person not found'], 404);
        }

        $data = $request->only(['first_name', 'last_name']);

        $person->fill($data);
        $person->save();

        return response()->json(['message' => 'Person updated successfully'], 200);
    }

    public function destroyPerson($id) {
        $user = Person::find($id);

        if ($user) {
            $user->delete();
            return response()->json(['message' => 'Person eliminado correctamente'], 200);
        } else {
            return response()->json(['message' => 'Person no encontrado'], 404);
        }
    }
}
