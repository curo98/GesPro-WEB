<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\StateRequest;

class StateRequestController extends Controller
{
    public function index(){

        $stateRequests = StateRequest::all();

        return response()->json($stateRequests);
    }

    public function receive($id)
    {
        $sr = SupplierRequest::findOrFail($id);

        $estadoRecibido = DB::table('state_requests')
            ->where('name', 'Recibida')
            ->first();
        $to_state_id = $estadoRecibido->id;

        $ultimoEstado = DB::table('transitions_state_requests')
            ->where('id_supplier_request', $id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($ultimoEstado) {
            DB::table('transitions_state_requests')
                ->where('id_supplier_request', $id)
                ->update(['id_reviewer' => auth()->user()->id]);

            $estadoActual = $ultimoEstado->to_state_id ?? $ultimoEstado->from_state_id;

            DB::table('transitions_state_requests')->insert([
                'id_supplier_request' => $id,
                'from_state_id' => $estadoActual,
                'to_state_id' => $to_state_id,
                'id_reviewer' => auth()->user()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $transitionId = DB::table('transitions_state_requests')
                ->where('id_supplier_request', $id)
                ->orderBy('id', 'desc')
                ->value('to_state_id');

            $estadoPorValidar = DB::table('state_requests')
                ->where('name', 'Por validar')
                ->first();
            $stateToValidate = $estadoPorValidar->id;

            DB::table('transitions_state_requests')->insert([
                'id_supplier_request' => $id,
                'from_state_id' => $transitionId,
                'to_state_id' => $stateToValidate,
                'id_reviewer' => auth()->user()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $sr->user->sendFCM('Su solicitud ha sido recibida y ha pasado a un estado para revisión');

            $notification = 'Solicitud recibida satisfactoriamente';

            return response()->json(['success' => true, 'notification' => $notification]);
        }

        return response()->json(['success' => false, 'error' => 'No se encontró la última transición']);
    }
}
