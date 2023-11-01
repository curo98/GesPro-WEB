<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\SupplierRequest;
use App\Models\StateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StateRequestController extends Controller
{

    public function check(String $id)
    {
        $sr = SupplierRequest::findOrFail($id);

        $estadoValidado = DB::table('state_requests')
            ->where('name', 'Validado')
            ->first();
        $nuevoEstadoId = $estadoValidado->id;

        $ultimoEstado = DB::table('transitions_state_requests')
            ->select('to_state_id')
            ->where('id_supplier_request', $id)
            ->orderBy('id', 'desc')
            ->first();

        if ($ultimoEstado) {
            // Inserta un nuevo registro en la tabla intermedia con el último estado en from_state_id y el nuevo estado en to_state_id
            DB::table('transitions_state_requests')->insert([
                'id_supplier_request' => $id,
                'from_state_id' => $ultimoEstado->to_state_id,
                'to_state_id' => $nuevoEstadoId,
                'id_reviewer' => auth()->user()->id, // El ID del revisor, ajústalo según tus necesidades
                'created_at' => now(), // Fecha actual de creación
                'updated_at' => now(), // Fecha actual de actualización
            ]);

            $sr->user->sendFCM('Solicitud validad');

            $notification = 'Su solicitud ha sido validada por el analista de compras';

            return back()->with(compact('notification'));
        }

        return back();
    }
}
