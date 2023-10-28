<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupplierRequest;
use App\Models\StateRequest;
use App\Models\User;
use App\Models\TypePayment;
use App\Models\MethodPayment;
use App\Models\Role;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SupplierRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard('api')->user();
        if ($user->role->name === "proveedor") {
            $supplierRequests = SupplierRequest::where('id_user', $user->id)
                ->with(
                    'user',
                    'typePayment',
                    'methodPayment',
                    'documents',
                    'questions'
                    )
                ->get();

            // Obtener las transiciones de estado para cada solicitud
            $supplierRequestsWithTransitions = $supplierRequests->map(function ($supplierRequest) {
                // Resto del código para obtener transiciones
                $transitions = DB::table('transitions_state_requests')
                    ->select('from_state_id', 'to_state_id', 'id_reviewer')
                    ->where('id_supplier_request', $supplierRequest->id)
                    ->get();

                $transitions->each(function ($transition) {
                    $transition->fromState = StateRequest::find($transition->from_state_id);
                    $transition->toState = StateRequest::find($transition->to_state_id);
                    $transition->reviewer = User::find($transition->id_reviewer);
                });

                $supplierRequest->stateTransitions = $transitions;

                return $supplierRequest;
            });

            return response()->json($supplierRequestsWithTransitions);
        } elseif ($user->role->name === "Administrador" || $user->role->name === "analista" || $user->role->name === "validador") {
            // El usuario tiene el rol de proveedor, obtén todas las solicitudes de proveedor
            $supplierRequests = SupplierRequest::with(
                'user',
                'typePayment',
                'methodPayment',
                'documents',
                'questions'
            )->get();

            // Obtener las transiciones de estado para cada solicitud
            $supplierRequestsWithTransitions = $supplierRequests->map(function ($supplierRequest) {
                $transitions = DB::table('transitions_state_requests')
                    ->select('from_state_id', 'to_state_id', 'id_reviewer')
                    ->where('id_supplier_request', $supplierRequest->id)
                    ->get();

                $transitions->each(function ($transition) {
                    $transition->fromState = StateRequest::find($transition->from_state_id);
                    $transition->toState = StateRequest::find($transition->to_state_id);
                    $transition->reviewer = User::find($transition->id_reviewer);
                });

                $supplierRequest->stateTransitions = $transitions;

                return $supplierRequest;
            });

            return response()->json($supplierRequestsWithTransitions);
        } else {
            // El usuario no tiene el rol de proveedor, puedes manejar esto como desees
            return response()->json(['message' => 'No tienes permiso para ver las solicitudes de proveedor'], 403);
        }

        // $user = Auth::guard('api')->user();
        // return $user->supplierRequests()->with(
        //     'user',
        //     'typePayment',
        //     'methodPayment',
        //     'documents',
        //     'questions')->get();

        // //Obtener las transiciones de estado para cada solicitud
        // $supplierRequestsWithTransitions = $supplierRequests->map(function ($supplierRequest) {
        //     $transitions = DB::table('transitions_state_requests')
        //         ->select('from_state_id', 'to_state_id', 'id_reviewer')
        //         ->where('id_supplier_request', $supplierRequest->id)
        //         ->get();

        //     $transitions->each(function ($transition) {
        //         $transition->fromState = StateRequest::find($transition->from_state_id);
        //         $transition->toState = StateRequest::find($transition->to_state_id);
        //         $transition->reviewer = User::find($transition->id_reviewer);
        //     });

        //     $supplierRequest->stateTransitions = $transitions;

        //     return $supplierRequest;
        // });

        // return response()->json($supplierRequestsWithTransitions);
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
        $user = Auth::guard('api')->user();

        $newName = $request->input('nameSupplier');
        $newEmail = $request->input('emailSupplier');

        // Verifica si el nombre o el correo electrónico son diferentes de los actuales
        if ($newName !== $user->name) {
            $user->name = $newName;
        }

        if ($newEmail && $newEmail !== $user->email) {
            $user->email = $newEmail;
        }

        // Guarda el usuario actualizado
        $user->save();

        // Cambia el rol del usuario a "proveedor"
        $user->id_role = Role::where('name', 'proveedor')->first()->id;
        $user->save();

        // Obtén el país desde la solicitud, asumiendo que se encuentra en un campo llamado 'country'
        $country = $request->input('nacionality');

        // Si el país no es Perú, establece 'Extranjero' como nacionalidad, de lo contrario, establece 'Nacional'
        $nacionality = ($country !== 'Perú') ? 'Extranjero' : 'Nacional';

        $typePaymentName = $request->input('typePayment');
        $methodPaymentName = $request->input('methodPayment');

        $typePayment = TypePayment::where('name', $typePaymentName)->first();
        $methodPayment = MethodPayment::where('name', $methodPaymentName)->first();

        if (!$typePayment || !$methodPayment) {
            return response()->json(['message' => 'Tipo de pago o método de pago no válido'], 400);
        }

        $supplier = new Supplier([
            'nacionality' => $nacionality,
            'nic_ruc' => $request->input('nic_ruc'),
            'state' => 'inactivo',
            'id_user' => $user->id
        ]);
        $supplier->save();

        return response()->json(['message' => 'Registro exitoso como proveedor'], 201);
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
