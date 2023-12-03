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
use App\Models\Document;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class SupplierRequestController extends Controller
{
    function getStateId($stateName)
    {
        return DB::table('state_requests')->where('name', $stateName)->value('id');
    }
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
            $estadoPorAprobar = DB::table('state_requests')
                ->where('name', 'Por aprobar')
                ->first();
            $stateToApprove = $estadoPorAprobar->id;
            // Obtener el estado "Aprobada"
            $estadoAprobada = DB::table('state_requests')
                ->where('name', 'Aprobada')
                ->first();
            $stateApproved = $estadoAprobada->id;

            // Obtener el estado "Validada"
            $estadoValidada = DB::table('state_requests')
                ->where('name', 'Validada')
                ->first();
            $stateValidated = $estadoValidada->id;

            // Obtener el estado "Recibida"
            $estadoRecibida = DB::table('state_requests')
                ->where('name', 'Recibida')
                ->first();
            $stateReceived = $estadoRecibida->id;
            // Obtener el estado "Rechazada"
            $estadoReject = DB::table('state_requests')
                ->where('name', 'Desaprobada')
                ->first();
            $stateRejected = $estadoReject->id;
            // Obtener el estado "Cancelada"
            $estadoCancelada = DB::table('state_requests')
                ->where('name', 'Cancelada')
                ->first();
            $stateCanceled = $estadoCancelada->id;

            $supplierRequestsWithTransitions = $supplierRequests->filter(function ($supplierRequest) use ($stateToApprove, $stateToReceive, $stateToValidate, $stateApproved, $stateValidated, $stateReceived, $stateRejected, $stateCanceled) {
                $latestTransition = DB::table('transitions_state_requests')
                    ->where('id_supplier_request', $supplierRequest->id)
                    ->orderBy('id', 'desc')
                    ->first();

                if ($latestTransition && in_array($latestTransition->to_state_id, [$stateToApprove, $stateToReceive, $stateToValidate, $stateApproved, $stateValidated, $stateReceived, $stateRejected, $stateCanceled])) {
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
                }
            });

            $sp = $supplierRequestsWithTransitions->values();

            return response()->json($sp);

        } elseif ($user->role->name === "contabilidad") {
            $supplierRequests = SupplierRequest::with(
                'user',
                'typePayment',
                'methodPayment',
                'documents',
                'questions'
            )->get();

            // Obtener el estado "Por aprobar"
            $estadoPorAprobar = DB::table('state_requests')
                ->where('name', 'Por aprobar')
                ->first();
            $stateToApprove = $estadoPorAprobar->id;

            // Obtener el estado "Aprobada"
            $estadoAprobada = DB::table('state_requests')
                ->where('name', 'Aprobada')
                ->first();
            $stateApproved = $estadoAprobada->id;

            $estadoPorValidar = DB::table('state_requests')
                ->where('name', 'Por validar')
                ->first();
            $stateToValidate = $estadoPorValidar->id;

            // Obtener el estado "Validada"
            $estadoValidada = DB::table('state_requests')
                ->where('name', 'Validada')
                ->first();
            $stateValidated = $estadoValidada->id;

            // Obtener el estado "Recibida"
            $estadoRecibida = DB::table('state_requests')
                ->where('name', 'Recibida')
                ->first();
            $stateReceived = $estadoRecibida->id;
            // Obtener el estado "Rechazada"
            $estadoReject = DB::table('state_requests')
                ->where('name', 'Desaprobada')
                ->first();
            $stateRejected = $estadoReject->id;
            // Obtener el estado "Cancelada"
            $estadoCancelada = DB::table('state_requests')
                ->where('name', 'Cancelada')
                ->first();
            $stateCanceled = $estadoCancelada->id;

            // Filtrar las solicitudes de proveedores con las transiciones específicas
            $supplierRequestsWithTransitions = $supplierRequests->filter(function ($supplierRequest) use ($stateToValidate, $stateToApprove, $stateApproved, $stateValidated, $stateReceived, $stateRejected, $stateCanceled) {
                // Obtener la última transición para la solicitud de proveedor
                $latestTransition = DB::table('transitions_state_requests')
                    ->where('id_supplier_request', $supplierRequest->id)
                    ->orderByDesc('id')
                    ->first();

                if ($latestTransition && in_array($latestTransition->to_state_id, [$stateToValidate, $stateToApprove, $stateApproved, $stateValidated, $stateReceived, $stateRejected, $stateCanceled ])) {
                    // Obtener todas las transiciones para la solicitud de proveedor
                    $transitions = DB::table('transitions_state_requests')
                        ->select('from_state_id', 'to_state_id', 'id_reviewer')
                        ->where('id_supplier_request', $supplierRequest->id)
                        ->get();

                    // Asignar a cada transición el estado de origen, el estado de destino y el revisor
                    $transitions->each(function ($transition) {
                        $transition->fromState = StateRequest::find($transition->from_state_id);
                        $transition->toState = StateRequest::find($transition->to_state_id);
                        $transition->reviewer = User::find($transition->id_reviewer);
                    });

                    // Asignar las transiciones al objeto $supplierRequest
                    $supplierRequest->stateTransitions = $transitions;

                    // Devolver la solicitud de proveedor modificada
                    return $supplierRequest;
                }
            });

            // Reindexar el resultado para asegurar claves numéricas consecutivas
            $supplierRequestsWithTransitions = $supplierRequestsWithTransitions->values();

            // Devolver la respuesta JSON
            return response()->json($supplierRequestsWithTransitions);


        } elseif ($user->role->name === "admin") {
            $supplierRequests = SupplierRequest::with(
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

    public function uploadFiles(Request $request)
    {
        $user = Auth::guard('api')->user();

        // Obtén el proveedor asociado al usuario
        $supplier = $user->supplier;

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $titles = $request->input('titles');

            // Obtén la última solicitud del usuario
            $lastRequest = $user->supplierRequests()->latest()->first();

            foreach ($files as $index => $file) {
                $title = $titles[$index];
                $originalFileName = $file->getClientOriginalName();

                // Limpia el nombre del usuario de espacios en blancos y símbolos
                $cleanedUserName = Str::slug($user->name);

                // Genera una URI amigable para el nombre del archivo
                $cleanedFileName = Str::slug(pathinfo($originalFileName, PATHINFO_FILENAME));

                // Construye la ruta de almacenamiento
                $storagePath = "public/documents/{$cleanedUserName}/{$cleanedFileName}.{$file->getClientOriginalExtension()}";

                // Verifica si el archivo ya existe en storage
                $counter = 1;
                while (Storage::exists($storagePath)) {
                    // Si el archivo ya existe, cambia el nombre agregando un contador
                    $cleanedFileName = $cleanedFileName . '_' . $counter;
                    $storagePath = "public/documents/{$cleanedUserName}/{$cleanedFileName}.{$file->getClientOriginalExtension()}";
                    $counter++;
                }

                // Almacena el archivo en storage/app/public
                $path = $file->storeAs("public/documents/{$cleanedUserName}", "{$cleanedFileName}.{$file->getClientOriginalExtension()}");

                // Crea una nueva instancia del modelo Document
                $document = new Document;
                $document->title = $title;
                $document->name = $originalFileName;
                $document->uri = Storage::url($path);
                $document->id_supplier = $supplier->id;

                // Guarda el documento en la base de datos
                $document->save();

                // Registra el documento en la tabla intermedia usando DB
                if ($lastRequest) {
                    DB::table('supplier_requests_documents')->insert([
                        'id_supplier_request' => $lastRequest->id,
                        'id_document' => $document->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            return response()->json(['message' => 'Archivos almacenados y registrados exitosamente']);
        } else {
            return response()->json(['error' => 'No se ha proporcionado ningún archivo'], 400);
        }
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

    public function uploadFilesUpdated(Request $request, $id)
    {
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $titles = $request->input('titles');

            // Obtén la última solicitud del usuario
            $sr = SupplierRequest::find($id);
            $user = $sr->user;
            $supplier = $sr->user->supplier;

            foreach ($titles as $index => $title) {
                // Verifica si el índice existe en el array $files
                if (array_key_exists($index, $files)) {
                    $file = $files[$index];
                    $originalFileName = $file->getClientOriginalName();

                    // Limpia el nombre del usuario de espacios en blancos y símbolos
                    $cleanedUserName = Str::slug($user->name);

                    // Genera una URI amigable para el nombre del archivo
                    $cleanedFileName = Str::slug(pathinfo($originalFileName, PATHINFO_FILENAME));

                    // Actualiza el archivo en storage/app/public
                    $path = $file->storeAs("public/documents/{$cleanedUserName}", "{$cleanedFileName}.{$file->getClientOriginalExtension()}");

                    // Busca el documento existente por título e ID de proveedor
                    $existingDocument = Document::where('id_supplier', $supplier->id)
                        ->where('title', $title)
                        ->first();

                    // Si el documento existe, actualiza la información del documento
                    if ($existingDocument) {
                        $existingDocument->name = $originalFileName;
                        $existingDocument->uri = Storage::url($path);
                        $existingDocument->save();

                        // Registra el documento en la tabla intermedia usando DB
                        if ($sr) {
                            DB::table('supplier_requests_documents')->updateOrInsert(
                                [
                                    'id_supplier_request' => $sr->id,
                                    'id_document' => $existingDocument->id,
                                ],
                                ['created_at' => now(), 'updated_at' => now()]
                            );
                        }
                    }
                }
            }

            return response()->json(['message' => 'Archivos almacenados y actualizados exitosamente']);
        }

        return response()->json(['error' => 'No se ha proporcionado ningún archivo'], 400);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
