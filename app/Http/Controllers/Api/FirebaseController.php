<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class FirebaseController extends Controller
{
    public function sendAll(Request $request)
    {
        // Obtén el usuario actual autenticado
        $user = Auth::guard('api')->user();

        // Obtén los tokens de dispositivo de todos los usuarios excepto el usuario actual
        $recipients = User::whereNotNull('device_token')->where('id', '!=', $user->id)->pluck('device_token')->toArray();

        // Envía la notificación a los destinatarios
        fcm()
            ->to($recipients)
            ->notification([
                'title' => $request->input('title'),
                'body' => $request->input('body')
            ])
            ->send();

        // Respuesta JSON indicando que la notificación fue enviada
        $notification = 'Notificación enviada a todos los usuarios (Android), excepto a ti.';
        return response()->json(['notification' => $notification]);
    }
    /**
     * Display a listing of the resource.
     */
    public function postToken(Request $request)
    {
        // $request->validate($rules);
        $user = Auth::guard('api')->user();
        if ($request->has('device_token')) {
            $user->device_token = $request->input('device_token');
            $user->save();
        }

    }

    public function deviceToken(Request $request)
    {
        // Valida la solicitud (puedes agregar más validaciones según tus necesidades)
        $request->validate([
            'device_token' => 'required|string',
        ]);

        // Recupera el usuario autenticado
        $user = auth()->user();

        if ($user) {
            // Almacena el token del dispositivo en el campo "device_token" de la tabla "users"
            $user->update(['device_token' => $request->input('device_token')]);

            return response()->json(['message' => 'Token del dispositivo registrado correctamente'], 200);
        } else {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
