<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index() {
        $questions = Question::all();
        return $questions;
    }

    public function store(Request $request) {
        $question = Question::create($request->all());

        return response()->json(['message' => 'Pregunta creada con éxito'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Question::find($id);
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
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $question->update($request->all());

        return response()->json(['message' => 'Pregunta actualizada']);
    }

}
