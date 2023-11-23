<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MethodPayment;

class MethodPaymentRequestController extends Controller
{
    public function index()
    {
        $mps = MethodPayment::all();

        return response()->json($mps);
    }
    public function store(Request $request) {
        $mp = MethodPayment::create($request->all());

        return response()->json(['message' => 'Metodo de pago creado con éxito'], 200);
    }
    public function edit($id)
    {
        $mp = MethodPayment::find($id);
        return $mp;
        if ($mp) {
            return response()->json($mp);
        } else {
            return response()->json(['message' => 'Metodo de pago no encontrado'], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $mp = MethodPayment::findOrFail($id);

        // Actualiza solo el campo 'description' con el dato del request
        $mp->update($request->all());

        return response()->json(['message' => 'Metodo de pago actualizado']);
    }
}
