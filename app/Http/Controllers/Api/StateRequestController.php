<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\StateRequest;
use Illuminate\Support\Facades\DB;
use App\Models\SupplierRequest;

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

    public function validate($id)
    {
        $sr = SupplierRequest::findOrFail($id);

        $estadoValidado = DB::table('state_requests')
            ->where('name', 'Validada')
            ->first();
        $nuevoEstadoId = $estadoValidado->id;

        $ultimoEstado = DB::table('transitions_state_requests')
            ->select('from_state_id', 'to_state_id')
            ->where('id_supplier_request', $id)
            ->orderBy('id', 'desc')
            ->first();

        if ($ultimoEstado) {
            $estadoActual = $ultimoEstado->to_state_id ?? $ultimoEstado->from_state_id;
            // Inserta un nuevo registro en la tabla intermedia con el último estado en from_state_id y el nuevo estado en to_state_id
            DB::table('transitions_state_requests')->insert([
                'id_supplier_request' => $id,
                'from_state_id' => $estadoActual,
                'to_state_id' => $nuevoEstadoId,
                'id_reviewer' => auth()->user()->id, // El ID del revisor, ajústalo según tus necesidades
                'created_at' => now(), // Fecha actual de creación
                'updated_at' => now(), // Fecha actual de actualización
            ]);

            $transitionId = DB::table('transitions_state_requests')
            ->where('id_supplier_request', $id)
            ->orderBy('id', 'desc')
            ->value('to_state_id');

            //siguiente estado
            $estadoPorValidar = DB::table('state_requests')
                ->where('name', 'Por aprobar')
                ->first();
            $stateToValidate = $estadoPorValidar->id;

            DB::table('transitions_state_requests')->insert([
                'id_supplier_request' => $id,
                'from_state_id' => $transitionId,
                'to_state_id' => $stateToValidate,
                'id_reviewer' => auth()->user()->id, // El ID del revisor, ajústalo según tus necesidades
                'created_at' => now(), // Fecha actual de creación
                'updated_at' => now(), // Fecha actual de actualización
            ]);

            $sr->user->sendFCM('Su solicitud ha sido validada por el analista de compras');

            $notification = 'Solicitud validad satisfactoriamente';

            return response()->json(['success' => true, 'notification' => $notification]);
        }

        return response()->json(['success' => false, 'error' => 'No se encontró la última transición']);
    }

    public function approve($id)
    {
        $sr = SupplierRequest::findOrFail($id);

        $estadoRecibido = DB::table('state_requests')
            ->where('name', 'Aprobada')
            ->first();
        $to_state_id = $estadoRecibido->id;

        $ultimoEstado = DB::table('transitions_state_requests')
            ->select('from_state_id', 'to_state_id')
            ->where('id_supplier_request', $id)
            ->orderBy('id', 'desc')
            ->first();

        if ($ultimoEstado) {
            $estadoActual = $ultimoEstado->to_state_id ?? $ultimoEstado->from_state_id;
            // Inserta un nuevo registro en la tabla intermedia con el último estado en from_state_id y el nuevo estado en to_state_id
            DB::table('transitions_state_requests')->insert([
                'id_supplier_request' => $id,
                'from_state_id' => $estadoActual,
                'to_state_id' => $to_state_id,
                'id_reviewer' => auth()->user()->id, // El ID del revisor, ajústalo según tus necesidades
                'created_at' => now(), // Fecha actual de creación
                'updated_at' => now(), // Fecha actual de actualización
            ]);

            $sr->user->supplier->update(['state' => 'activo']);

            $sr->user->sendFCM('Su solicitud ha sido aprobada, felicidades!');

            $notification = 'La solicitud ha sido aprobada satisfactoriamente';

            return response()->json(['success' => true, 'notification' => $notification]);
        }

        return response()->json(['success' => false, 'error' => 'No se encontró la última transición']);
    }
}
