<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupplierRequest;
use App\Models\StateRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SupplierRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplierRequests = SupplierRequest::with(
            'user',
            'typePayment',
            'methodPayment',
            'documents',
            'questions')->get();

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
