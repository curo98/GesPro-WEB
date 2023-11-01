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
    public function receive(String $id)
    {
        $sr = SupplierRequest::findOrFail($id);

        $estadoRecibido = DB::table('state_requests')
            ->where('name', 'Recibido')
            ->first();
        $to_state_id = $estadoRecibido->id;

        $ultimoEstado = DB::table('transitions_state_requests')
            ->select('from_state_id', 'to_state_id')
            ->where('id_supplier_request', $id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($ultimoEstado) {

            //Agregar revisor al estado inicial
            DB::table('transitions_state_requests')
            ->where('id_supplier_request', $id)
            ->update(['id_reviewer' => auth()->user()->id]);

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

            $transitionId = DB::table('transitions_state_requests')
            ->where('id_supplier_request', $id)
            ->orderBy('id', 'desc')
            ->value('to_state_id');

            //siguiente estado
            $estadoPorValidar = DB::table('state_requests')
                ->where('name', 'Por validar')
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

            $sr->user->sendFCM('Su solicitud ha sido recibida y ha pasado a un estado para para revision');

            $notification = 'Su solicitud ha sido recibida por el analista de compras';

            return back()->with(compact('notification'));
        }

        return back();
    }

    public function check(String $id)
    {
        $sr = SupplierRequest::findOrFail($id);

        $estadoValidado = DB::table('state_requests')
            ->where('name', 'Validado')
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

            $sr->user->sendFCM('Su solicitud ha sido validada');

            $notification = 'Su solicitud ha sido validada por el analista de compras';

            return back()->with(compact('notification'));
        }

        return back();
    }

    public function approve()
    {
        $sr = SupplierRequest::findOrFail($id);

        $estadoRecibido = DB::table('state_requests')
            ->where('name', 'Recibido')
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

            $sr->user->sendFCM('Su solicitud ha sido recibida');

            $notification = 'Su solicitud ha sido recibida por el analista de compras';

            return back()->with(compact('notification'));
        }
    }

    public function reject()
    {

    }

    public function cancel()
    {

    }
}
