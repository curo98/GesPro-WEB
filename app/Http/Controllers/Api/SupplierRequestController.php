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
        // return "LLegue";
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
        } elseif ($user->role->name === "compras") {
            $supplierRequests = SupplierRequest::with(
                'user',
                'typePayment',
                'methodPayment',
                'documents',
                'questions'
            )->get();

            $estadoPorRecibir = DB::table('state_requests')
                ->where('name', 'Por recibir')
                ->first();
            $stateToReceive = $estadoPorRecibir->id;

            $estadoPorValidar = DB::table('state_requests')
                ->where('name', 'Por validar')
                ->first();
            $stateToValidate = $estadoPorValidar->id;

            $supplierRequestsWithTransitions = $supplierRequests->filter(function ($supplierRequest) use ($stateToReceive, $stateToValidate) {
                $latestTransition = DB::table('transitions_state_requests')
                    ->select('from_state_id', 'to_state_id', 'id_reviewer')
                    ->where('id_supplier_request', $supplierRequest->id)
                    ->latest('created_at')
                    ->first();

                if ($latestTransition && in_array($latestTransition->to_state_id, [$stateToReceive, $stateToValidate])) {
                    $latestTransition->fromState = StateRequest::find($latestTransition->from_state_id);
                    $latestTransition->toState = StateRequest::find($latestTransition->to_state_id);
                    $latestTransition->reviewer = User::find($latestTransition->id_reviewer);

                    $supplierRequest->stateTransitions = $latestTransition;
                    return true;
                }

                return false;
            });

            return response()->json($supplierRequestsWithTransitions);

        } elseif ($user->role->name === "contabilidad") {
            $supplierRequests = SupplierRequest::with(
                'user',
                'typePayment',
                'methodPayment',
                'documents',
                'questions'
            )->get();

            $estadoPorValidar = DB::table('state_requests')
                ->where('name', 'Por aprobar')
                ->first();
            $stateToApprove = $estadoPorValidar->id;

            $supplierRequestsWithTransitions = $supplierRequests->map(function ($supplierRequest) use ($stateToApprove) {
                $transitions = DB::table('transitions_state_requests')
                    ->select('from_state_id', 'to_state_id', 'id_reviewer')
                    ->where('id_supplier_request', $supplierRequest->id)
                    ->where('to_state_id', $stateToApprove)
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

        } elseif ($user->role->name === "admin") {
            $supplierRequests = SupplierRequest::with(
                'user',
                'typePayment',
                'methodPayment',
                'documents',
                'questions'
            )->get();

            $supplierRequestsWithTransitions = $supplierRequests->map(function ($supplierRequest){
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
        $selectedPolicies = $request->input('selectedPolicies');
        $user->id_role = Role::where('name', 'proveedor')->first()->id;
        $user->save();

        $typePaymentName = $request->input('typePayment');
        $methodPaymentName = $request->input('methodPayment');

        $typePayment = TypePayment::where('name', $typePaymentName)->first();
        $methodPayment = MethodPayment::where('name', $methodPaymentName)->first();

        if (!$typePayment || !$methodPayment) {
            return response()->json(['message' => 'Tipo de pago o método de pago no válido'], 400);
        }

        // Verificar si el usuario ya tiene un proveedor asociado
        $existingSupplier = Supplier::where('id_user', $user->id)->first();

        if ($existingSupplier) {
            // Si el proveedor existe, actualizar los campos
            $existingSupplier->update([
                'nacionality' => $request->input('nacionality'),
                'nic_ruc' => $request->input('nic_ruc'),
                'locality' => $request->input('locality'),
                'street_and_number' => $request->input('street_and_number'),
            ]);
        } else {
            // Si el proveedor no existe, crear uno nuevo
            $supplier = new Supplier([
                'nacionality' => $request->input('nacionality'),
                'nic_ruc' => $request->input('nic_ruc'),
                'locality' => $request->input('locality'),
                'street_and_number' => $request->input('street_and_number'),
                'id_user' => $user->id,
            ]);
            $supplier->save();
        }

        $supplierRequest = new SupplierRequest([
            'id_user' => $user->id,
            'id_type_payment' => $typePayment->id,
            'id_method_payment' => $methodPayment->id,
        ]);

        $saved = $supplierRequest->save();
        $id_supplier_request = $supplierRequest->id;

        $estadoInicial = DB::table('state_requests')
            ->where('name', 'Enviado')
            ->first();
        $from_state_id = $estadoInicial->id;
        $estadoPost = DB::table('state_requests')
            ->where('name', 'Por recibir')
            ->first();
        $to_state_id = $estadoPost->id;

        DB::table('transitions_state_requests')->insert([
                'id_supplier_request' => $id_supplier_request,
                'from_state_id' => $from_state_id,
                'to_state_id' => $to_state_id,
                'created_at' => now(), // Fecha actual de creación
                'updated_at' => now(), // Fecha actual de actualización
            ]);

        $data = $request->json()->all();
        $selectedPoliciesRequest = $data['selectedPolicies'];
        $questionResponses = $data['questionResponses'];

        foreach ($selectedPoliciesRequest as $policy) {
            DB::table('supplier_requests_policies')->insert([
                'id_supplier_request' => $id_supplier_request,
                'id_policie' => $policy['id'],
                'accepted' => $policy['isChecked'],
            ]);
        }

        //implementar envio de mensajes tambien para otros casos
        foreach ($questionResponses as $qr) {
            $responseValue = $qr['respuesta'] ? 1 : 0;

            DB::table('supplier_requests_questions')->insert([
                'id_supplier_request' => $id_supplier_request,
                'id_question' => $qr['preguntaId'],
                'response' => $responseValue,
            ]);
        }
        if ($saved) {
            $supplierRequest->user->sendFCM('Su solicitud se ha enviado correctamente!');
        }

        return response()->json(['message' => 'Registro exitoso como proveedor'], 201);
    }






    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $supplierRequest = SupplierRequest::with(
            'user',
            'typePayment',
            'methodPayment',
            'documents',
            'questions',
            'observations.user',
            'policies'
        )->find($id);

        if ($supplierRequest) {
            $transitions = DB::table('transitions_state_requests')
                ->select('from_state_id', 'to_state_id', 'id_reviewer', 'created_at')
                ->where('id_supplier_request', $supplierRequest->id)
                ->get();

            $transitions->each(function ($transition) {
                $transition->fromState = StateRequest::find($transition->from_state_id);
                $transition->toState = StateRequest::find($transition->to_state_id);
                $transition->reviewer = User::find($transition->id_reviewer);
            });

            $supplierRequest->stateTransitions = $transitions;

            // Devuelve el objeto en formato JSON
            return response()->json($supplierRequest);
        } else {
            // Manejar el caso en el que no se encontró un SupplierRequest con el ID dado.
            // Puedes lanzar una excepción, devolver una respuesta de error, etc.
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Assuming $id is the ID of the SupplierRequest you want to edit
        $supplierRequest = SupplierRequest::find($id);

        if ($supplierRequest) {
            // Assuming you want to load related data as well
            $supplierRequest->load(
                'user.supplier',
                'typePayment',
                'methodPayment',
                'documents',
                'questions',
                'observations.user',
                'policies'
            );

            // You may need to load additional data depending on your requirements

            // Return the SupplierRequest data as JSON
            return response()->json($supplierRequest);
        } else {
            // Handle the case where the SupplierRequest with the given ID was not found.
            // You can return a JSON response with an error message.
            return response()->json(['error' => 'Solicitud no encontrada'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::guard('api')->user();
        // Obtener los datos del formulario
        $data = $request->all();

        // Buscar el ID del TypePayment basándose en el nombre
        $typePayment = TypePayment::where('name', $data['typePayment'])->first();

        // Buscar el ID del MethodPayment basándose en el nombre
        $methodPayment = MethodPayment::where('name', $data['methodPayment'])->first();

        // Actualizar los campos básicos en la tabla supplier_requests
        $supplierRequest = SupplierRequest::find($id);
        $supplierRequest->update([
            'id_type_payment' => $typePayment->id,
            'id_method_payment' => $methodPayment->id,
        ]);

        // Asociar el TypePayment y MethodPayment al SupplierRequest
        $supplierRequest->typePayment()->associate($typePayment);
        $supplierRequest->methodPayment()->associate($methodPayment);

        $supplier = Supplier::where('id_user', $user->id)->first();
        $supplier->update([
            'nacionality' => $data['nacionality'],
            'nic_ruc' => $data['nic_ruc'],
            'locality' => $data['locality'],
            'street_and_number' => $data['street_and_number'],
        ]);

        $selectedPoliciesRequest = $data['selectedPolicies'];
        foreach ($selectedPoliciesRequest as $policy) {
            DB::table('supplier_requests_policies')
                ->where('id_supplier_request', $id)
                ->where('id_policie', $policy['id'])
                ->update(['accepted' => $policy['isChecked']]);
        }

        $selectedQuestionsRequest = $data['questionResponses'];
        foreach ($selectedQuestionsRequest as $questionResponse) {
            DB::table('supplier_requests_questions')
                ->where('id_supplier_request', $id)
                ->where('id_question', $questionResponse['preguntaId'])
                ->update(['response' => $questionResponse['respuesta']]);
        }

        // Devolver una respuesta exitosa o algún otro tipo de respuesta según tu lógica de la aplicación
        return response()->json(['message' => 'Supplier request updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
