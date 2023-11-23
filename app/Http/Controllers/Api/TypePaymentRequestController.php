<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypePayment;

class TypePaymentRequestController extends Controller
{
    public function index()
    {
        $typePayments = TypePayment::all();

        return response()->json($typePayments);
    }
    public function store(Request $request) {
        $cp = TypePayment::create($request->all());

        return response()->json(['message' => 'Condicion de pago creado con éxito'], 200);
    }
    public function edit($id)
    {
        $cp = TypePayment::find($id);
        return $cp;
        if ($cp) {
            return response()->json($cp);
        } else {
            return response()->json(['message' => 'Condicion de pago no encontrado'], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $cp = TypePayment::findOrFail($id);

        // Actualiza solo el campo 'description' con el dato del request
        $cp->update($request->all());

        return response()->json(['message' => 'Condicion de pago actualizado']);
    }
}
